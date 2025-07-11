<?php

namespace Modules\Reseller\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reseller\Services\ResellerService;
use Modules\Reseller\Repositories\ResellRequestRepository;
use Modules\Product\Entities\Product;
use Modules\Seller\Entities\SellerProductSKU;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class ResellRequestController extends Controller
{
    protected $resellerService;
    protected $resellRequestRepository;

    public function __construct(
        ResellerService $resellerService,
        ResellRequestRepository $resellRequestRepository
    ) {
        $this->resellerService = $resellerService;
        $this->resellRequestRepository = $resellRequestRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of customer's resell requests
     */
    public function index(Request $request)
    {
        try {
            $customerId = auth()->id();
            $perPage = $request->get('per_page', 15);
            
            $requests = $this->resellRequestRepository->getRequestsByCustomer($customerId, $perPage);
            $statistics = $this->resellerService->getCustomerStatistics($customerId);

            return view('reseller::customer.resell-requests.index', compact('requests', 'statistics'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resell request
     */
    public function create(Request $request)
    {
        try {
            $productId = $request->get('product_id');
            $sellerProductSkuId = $request->get('seller_product_sku_id');

            if ($productId && $sellerProductSkuId) {
                $product = Product::with(['skus', 'categories', 'brand'])->findOrFail($productId);
                $sellerProductSku = SellerProductSKU::findOrFail($sellerProductSkuId);
                
                return view('reseller::customer.resell-requests.create', compact('product', 'sellerProductSku'));
            }

            // Show product selection page
            $products = $this->resellerService->getAvailableProductsForCustomer(auth()->id(), 15);
            return view('reseller::customer.resell-requests.select-product', compact('products'));

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->route('customer.resell-requests.index');
        }
    }

    /**
     * Store a newly created resell request in storage
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'seller_product_sku_id' => 'required|exists:seller_product_s_k_us,id',
                'product_condition' => 'required|in:new,used',
                'selling_price' => 'required|numeric|min:0',
                'customer_note' => 'nullable|string|max:1000',
            ]);

            $resellRequest = $this->resellerService->submitResellRequest($validated);

            Toastr::success('Resell request submitted successfully. It will be reviewed by admin.');
            return redirect()->route('customer.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resell request
     */
    public function show($id)
    {
        try {
            $resellRequest = $this->resellRequestRepository->findById($id);
            
            // Check if the request belongs to the authenticated customer
            if ($resellRequest->customer_id !== auth()->id()) {
                Toastr::error('You are not authorized to view this request.');
                return redirect()->route('customer.resell-requests.index');
            }

            return view('reseller::customer.resell-requests.show', compact('resellRequest'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resell request
     */
    public function edit($id)
    {
        try {
            $resellRequest = $this->resellRequestRepository->findById($id);
            
            // Check if the request belongs to the authenticated customer
            if ($resellRequest->customer_id !== auth()->id()) {
                Toastr::error('You are not authorized to edit this request.');
                return redirect()->route('customer.resell-requests.index');
            }

            // Only allow editing if request is pending
            if (!$resellRequest->isPending()) {
                Toastr::error('You can only edit pending requests.');
                return redirect()->route('customer.resell-requests.index');
            }

            return view('reseller::customer.resell-requests.edit', compact('resellRequest'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resell request in storage
     */
    public function update(Request $request, $id)
    {
        try {
            $resellRequest = $this->resellRequestRepository->findById($id);
            
            // Check if the request belongs to the authenticated customer
            if ($resellRequest->customer_id !== auth()->id()) {
                Toastr::error('You are not authorized to update this request.');
                return redirect()->route('customer.resell-requests.index');
            }

            // Only allow updating if request is pending
            if (!$resellRequest->isPending()) {
                Toastr::error('You can only update pending requests.');
                return redirect()->route('customer.resell-requests.index');
            }

            $validated = $request->validate([
                'product_condition' => 'required|in:new,used',
                'selling_price' => 'required|numeric|min:0',
                'customer_note' => 'nullable|string|max:1000',
            ]);

            $resellRequest->update($validated);

            Toastr::success('Resell request updated successfully.');
            return redirect()->route('customer.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resell request from storage
     */
    public function destroy($id)
    {
        try {
            $resellRequest = $this->resellRequestRepository->findById($id);
            
            // Check if the request belongs to the authenticated customer
            if ($resellRequest->customer_id !== auth()->id()) {
                Toastr::error('You are not authorized to delete this request.');
                return redirect()->route('customer.resell-requests.index');
            }

            // Only allow deleting if request is pending
            if (!$resellRequest->isPending()) {
                Toastr::error('You can only delete pending requests.');
                return redirect()->route('customer.resell-requests.index');
            }

            $resellRequest->delete();

            Toastr::success('Resell request deleted successfully.');
            return redirect()->route('customer.resell-requests.index');

        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display available products for resale
     */
    public function availableProducts(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $products = $this->resellerService->getAvailableProductsForCustomer(auth()->id(), $perPage);

            return view('reseller::customer.available-products.index', compact('products'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display resale products (products available for purchase)
     */
    public function resaleProducts(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $products = $this->resellerService->getResaleProductsForFrontend($perPage);

            return view('reseller::customer.resale-products.index', compact('products'));
        } catch (Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Get product details for resale form
     */
    public function getProductDetails(Request $request)
    {
        try {
            $productId = $request->get('product_id');
            $sellerProductSkuId = $request->get('seller_product_sku_id');

            $product = Product::with(['skus', 'categories', 'brand'])->findOrFail($productId);
            $sellerProductSku = SellerProductSKU::findOrFail($sellerProductSkuId);

            return response()->json([
                'success' => true,
                'product' => $product,
                'seller_product_sku' => $sellerProductSku,
                'actual_price' => $sellerProductSku->selling_price,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Calculate profit preview
     */
    public function calculateProfitPreview(Request $request)
    {
        try {
            $actualPrice = $request->get('actual_price');
            $sellingPrice = $request->get('selling_price');

            if ($sellingPrice <= $actualPrice) {
                return response()->json([
                    'success' => false,
                    'message' => 'Selling price must be higher than actual price.',
                ], 400);
            }

            $profit = $sellingPrice - $actualPrice;
            $profitShare = $profit * 0.5; // 50% of profit

            $customerProfit = $actualPrice + $profitShare;
            $adminProfit = $profitShare;

            return response()->json([
                'success' => true,
                'actual_price' => $actualPrice,
                'selling_price' => $sellingPrice,
                'profit' => $profit,
                'customer_profit' => $customerProfit,
                'admin_profit' => $adminProfit,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
} 