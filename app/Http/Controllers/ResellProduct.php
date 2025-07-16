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
            // Get resell requests for current user
            $resellRequests = ResellRequest::where('customer_id', auth()->user()->id)
                ->with(['product', 'sellerProductSku'])
                ->latest()
                ->paginate(10);

            $data['resellRequests'] = $resellRequests;

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
            $data['product'] = $this->productService->findBySellerProductId($id);
            $data['skus'] = $this->productService->getThisSKUProduct($id);
            $totalWholesalePrice = '';
            
            // Get the purchase price from customer's order history
            $purchasePrice = null;
            $customerId = auth()->user()->id;
            
            // Find the most recent order for this customer that contains this product
            $orderProduct = \App\Models\OrderProductDetail::whereHas('package.order', function($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })->where('product_sku_id', $id)->latest()->first();
            
            if ($orderProduct) {
                $purchasePrice = $orderProduct->price;
            }
            
            $data['purchasePrice'] = $purchasePrice;
            
            if(isModuleActive('WholeSale') && class_exists('Modules\WholeSale\Entities\WholesalePrice')){
                if (@$data['product']->product->product_type == 1){
                    $totalWholesalePrice = \Modules\WholeSale\Entities\WholesalePrice::where('product_id', $id)->get();
                }
            }
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
        ]);

        try {
            DB::beginTransaction();
            
            // Get the original product
            $originalProduct = \Modules\Product\Entities\Product::findOrFail($request->product_id);
            
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
            $reseller_id = auth()->user()->id;
            $resellProduct->reseller_id = $reseller_id;
            $resellProduct->created_by = $reseller_id; // Set the reseller as creator
            $resellProduct->created_at = now();
            $resellProduct->updated_at = now();
            $resellProduct->save();

            // Also add to resell table for tracking
            \DB::table('resell')->insert([
                'user_id' => auth()->user()->id,
                'product_id' => $resellProduct->id, // Use the new product ID
                'price' => $request->new_price,
                'quantity' => 1, // Default quantity
                'status' => '1', // Active
                'product_condition' => 'new', // Default condition
                'description' => 'Product marked for resale',
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
            Toastr::error(__('common.error_message'), __('common.error'));
            return back()->withInput();
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
