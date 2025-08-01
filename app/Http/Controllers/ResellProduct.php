<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Seller\Services\ProductService;
use Modules\Seller\Services\ProductService as SellerProductService;
use Modules\Product\Services\ProductService as mainProductService;
use App\Services\OrderService;
use Modules\OrderManage\Repositories\CancelReasonRepository;
use Exception;
use Brian2694\Toastr\Facades\Toastr;
use Modules\UserActivityLog\Traits\LogActivity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Modules\Reseller\Entities\ResellRequest;


class ResellProduct extends Controller
{   
    protected $orderService;
    protected $productService;

    public function __construct(OrderService $orderService, SellerProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->middleware('maintenance_mode');
    }

    public function my_purchase_order_index(Request $request)
    {
        if ($request->has('rn')) {
            $data['orders'] = $this->orderService->myPurchaseOrderListwithRN($request->rn);
            $data['rn'] = $request->rn;
        } else {
            $data['orders'] = $this->orderService->myPurchaseOrderList();
        }
        $cancelReasonRepo = new CancelReasonRepository;
        $data['cancel_reasons'] = $cancelReasonRepo->getAll();
        $data['no_paid_orders'] = $this->orderService->myPurchaseOrderListNotPaid();
        $data['to_shippeds'] = $this->orderService->myPurchaseOrderPackageListShipped();
        $data['to_recieves'] = $this->orderService->myPurchaseOrderPackageListRecieved();

        if (auth()->user()->role->type != 'customer') {
            return view('backEnd.pages.customer_data.order', $data);
        } else {
            return view(theme('pages.profile.order'), $data);
        }
    }

    public function resellProductList(Request $request)
    {
        try {
            // Get resell products created by current user (duplicated products marked for resale)
            $resellProducts = \Modules\Product\Entities\Product::where('reseller_id', auth()->user()->id)
                ->where('resell_product', 1)
                ->latest()
                ->paginate(10);

            $data['resellProducts'] = $resellProducts;

            if (auth()->user()->role->type != 'customer') {
                return view('backEnd.pages.customer_data.resell_products', $data);
            } else {
                return view(theme('pages.profile.resell_product_list'), $data);
            }
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error('Failed to load resell products.', 'Error');
            return back();
        }
    }

    public function resellProduct($id){
        try {
            $data = [];
            
            // Now that the repository method is fixed, we can use it directly
            $data['product'] = $this->productService->findByResellProductId($id);
            $data['skus'] = $this->productService->getThisSKUProduct($id);
            $totalWholesalePrice = '';

            // Get the purchase price from customer's order history
            $purchasePrice = null;
            $customerId = auth()->user()->id;

            // Find the most recent order for this customer that contains this product
            // We need to check both seller_product_sku ID and product_sku_id depending on the product type
            $orderProduct = \App\Models\OrderProductDetail::whereHas('package.order', function($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })->where(function($query) use ($id, $data) {
                // For single products, check by seller_product_sku id
                // For variant products, check by product_sku_id
                if ($data['product']->product->product_type == 1) {
                    // Single product - find seller_product_sku for this seller_product
                    $sellerProductSku = \Modules\Seller\Entities\SellerProductSKU::where('product_id', $id)->first();
                    if ($sellerProductSku) {
                        $query->where('product_sku_id', $sellerProductSku->id);
                    }
                } else {
                    // Variant product - use the ID as is (it should be seller_product_sku id)
                    $query->where('product_sku_id', $id);
                }
            })->latest()->first();

            if ($orderProduct) {
                $purchasePrice = $orderProduct->price;
            }

            $data['purchasePrice'] = $purchasePrice;

            // if(isModuleActive('WholeSale') && class_exists('Modules\WholeSale\Entities\WholesalePrice')){
            //     if (@$data['product']->product->product_type == 1){
            //         $totalWholesalePrice = \Modules\WholeSale\Entities\WholesalePrice::where('product_id', $id)->get();
            //     }
            // }
            $data['totalWholesalePrice'] = $totalWholesalePrice;
            return view(theme('pages.profile.resell_product_form'), $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            LogActivity::errorLog('Product not found with ID: ' . $id);
            Toastr::error('Product not found or does not exist.', __('common.error'));
            return redirect()->route('frontend.resell_product_list');
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    public function addResellProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'new_price' => 'required|numeric|min:0',
            'customer_note' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Get the original product
            $old_price = floatval(str_replace(['$', ' '], '', $request->old_price));
            $originalProduct = \Modules\Product\Entities\Product::findOrFail($request->product_id);
            $product_sku = DB::table('product_sku')->where('product_id',$originalProduct->id)->first();
            
            // Check if this product is already marked for resale by this user
            $existingResell = \Modules\Product\Entities\Product::where('reseller_id', auth()->user()->id)
                ->where('resell_product', 1)
                ->where('product_name', $originalProduct->product_name . ' (Resell)')
                ->first();

            if ($existingResell) {
                Toastr::error('This product is already marked for resale.', __('common.error'));
                return back()->withInput();
            }
            // Create a duplicate product for resale
            $resellProduct = $originalProduct->replicate();
            $resellProduct->product_name = $originalProduct->product_name . ' (Resell)';
            $resellProduct->slug = $originalProduct->slug . '-resell-' . time(); // Make slug unique
            $resellProduct->resell_product = 1;
            $resellProduct->resell_price = $request->new_price;
            $resellProduct->resell_condition = 'new'; // Default condition
            $resellProduct->resell_description = $request->customer_note;
            $reseller_id = auth()->user()->id;
            $resellProduct->reseller_id = $reseller_id;
            $resellProduct->created_by = $reseller_id; // Set the reseller as creator
            $resellProduct->created_at = now();
            $resellProduct->updated_at = now();
            $resellProduct->save();

            //insert seller_products
            DB::table('seller_products')->insert([
                'user_id' => auth()->user()->id,
                'product_id' => $resellProduct->id, // Use the new product ID
                'tax' => 0,
                'tax_type' => 0, // Default quantity
                'discount' => 0, // Active
                'discount_type' => 1, // Default condition
                'discount_start_date' => NULL,
                'discount_end_date' => NULL,
                'product_name' => $resellProduct->product_name,
                'slug' => $resellProduct->slug,
                'thum_img' => NULL, // Default quantity
                'status' => '1', // Active
                'stock_manage' => 1, // Default condition
                'is_approved' => 1,
                'min_sell_price' => $resellProduct->resell_price,
                'max_sell_price' => $resellProduct->resell_price,
                'total_sale' => 0,
                'avg_rating' => 0.00, // Default condition
                'recent_view' =>now(),
                'subtitle_1' => NULL,
                'subtitle_2' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $seller_products = DB::table('seller_products')->where('product_id',$resellProduct->id)->first();
             //insert product_sku
             $sku_id = DB::table('product_sku')->insertGetId([
                'product_id' => $resellProduct->id,
                'sku' => $product_sku->sku,
                'purchase_price' => $old_price,
                'selling_price' => $resellProduct->resell_price,
                'additional_shipping' => $product_sku->additional_shipping,
                'variant_image' => NULL,
                'status' => '1',
                'product_stock' => $product_sku->product_stock,
                'track_sku' => $product_sku->track_sku,
                'weight' => $product_sku->weight,
                'length' => $product_sku->length,
                'breadth' => $product_sku->breadth,
                'height' => $product_sku->height,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $seller_product_s_k_us = DB::table('seller_product_s_k_us')->insertGetId([
                'user_id' => auth()->user()->id,
                'product_id' => $seller_products->id,
                'product_sku_id' => $sku_id,
                'product_stock' => '100',
                'purchase_price' => $old_price,
                'selling_price' => $resellProduct->resell_price,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Also add to resell table for tracking
            DB::table('resell')->insert([
                'user_id' => auth()->user()->id,
                'product_id' => $resellProduct->id, // Use the new product ID
                'price' => $request->new_price,
                'quantity' => 1, // Default quantity
                'status' => '1', // Active
                'product_condition' => 'new', // Default condition
                'description' => $request->customer_note ?? 'Product marked for resale',
                'images' => $originalProduct->thumbnail_image_source,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            
            LogActivity::successLog('Product resell request submitted successfully.');
            Toastr::success('Product has been marked for resale successfully!', __('common.success'));
            
            return redirect()->route('frontend.resell_product_list');
            
        } catch (Exception $e) {
            DB::rollback();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), $e->getMessage());
            return back()->withInput();
        }
    }
    
    

    public function updateResellPrice(Request $request, $id)
    {
        try {
            $request->validate([
                'new_price' => 'required|numeric|min:0.01',
            ]);

            DB::beginTransaction();

            // Find the resell product
            $resellProduct = \Modules\Product\Entities\Product::where('id', $id)
                ->where('reseller_id', auth()->user()->id)
                ->where('resell_product', 1)
                ->firstOrFail();

            // Update the resell price
            $resellProduct->resell_price = $request->new_price;
            $resellProduct->save();

            // Also update in resell table if exists
            DB::table('resell')
                ->where('product_id', $id)
                ->where('user_id', auth()->user()->id)
                ->update([
                    'price' => $request->new_price,
                    'updated_at' => now(),
                ]);

            DB::commit();

            LogActivity::successLog('Resell product price updated successfully for product ID: ' . $id);

            return response()->json([
                'success' => true,
                'message' => 'Price updated successfully!',
                'formatted_price' => single_price($request->new_price),
                'new_price' => $request->new_price
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
            LogActivity::errorLog('Resell product not found or unauthorized access for ID: ' . $id);
            return response()->json([
                'success' => false,
                'message' => 'Product not found or you do not have permission to edit this product.'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Invalid price. Please enter a valid amount greater than 0.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollback();
            LogActivity::errorLog('Error updating resell price: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the price. Please try again.'
            ], 500);
        }
    }

    public function myPurchaseHistories(Request $request)
    {
        // Get resell requests for the current user
        $resellRequests = ResellRequest::where('customer_id', auth()->user()->id)
            ->with(['product', 'sellerProductSku'])
            ->latest()
            ->paginate(10);

        return view(theme('pages.profile.purchase_histories'), compact('resellRequests'));
    }
}
