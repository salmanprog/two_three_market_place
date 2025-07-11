<?php

namespace Modules\Reseller\Repositories;

use Modules\Reseller\Entities\ResellRequest;
use Modules\Product\Entities\Product;
use Modules\Seller\Entities\SellerProductSKU;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class ResellRequestRepository
{
    /**
     * Get all resell requests with pagination
     */
    public function getAllRequests($perPage = 15)
    {
        return ResellRequest::with(['customer', 'product', 'sellerProductSku', 'approvedBy', 'rejectedBy'])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get pending resell requests
     */
    public function getPendingRequests($perPage = 15)
    {
        return ResellRequest::with(['customer', 'product', 'sellerProductSku'])
            ->pending()
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get approved resell requests
     */
    public function getApprovedRequests($perPage = 15)
    {
        return ResellRequest::with(['customer', 'product', 'sellerProductSku', 'approvedBy'])
            ->approved()
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get rejected resell requests
     */
    public function getRejectedRequests($perPage = 15)
    {
        return ResellRequest::with(['customer', 'product', 'sellerProductSku', 'rejectedBy'])
            ->rejected()
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get resell requests by customer
     */
    public function getRequestsByCustomer($customerId, $perPage = 15)
    {
        return ResellRequest::with(['product', 'sellerProductSku', 'approvedBy', 'rejectedBy'])
            ->byCustomer($customerId)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Find resell request by ID
     */
    public function findById($id)
    {
        return ResellRequest::with(['customer', 'product', 'sellerProductSku', 'approvedBy', 'rejectedBy'])
            ->findOrFail($id);
    }

    /**
     * Create a new resell request
     */
    public function createRequest($data)
    {
        try {
            DB::beginTransaction();

            // Validate that the product exists and is available for resale
            $product = Product::findOrFail($data['product_id']);
            $sellerProductSku = SellerProductSKU::findOrFail($data['seller_product_sku_id']);

            // Check if customer already has a pending request for this product
            $existingRequest = ResellRequest::where('customer_id', Auth::id())
                ->where('product_id', $data['product_id'])
                ->where('status', 'pending')
                ->first();

            if ($existingRequest) {
                throw new Exception('You already have a pending resell request for this product.');
            }

            // Validate selling price
            $this->validateSellingPrice($data['actual_price'], $data['selling_price']);

            $resellRequest = ResellRequest::create([
                'customer_id' => Auth::id(),
                'product_id' => $data['product_id'],
                'seller_product_sku_id' => $data['seller_product_sku_id'],
                'product_condition' => $data['product_condition'],
                'actual_price' => $data['actual_price'],
                'selling_price' => $data['selling_price'],
                'customer_note' => $data['customer_note'] ?? null,
            ]);

            DB::commit();
            return $resellRequest;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Approve a resell request
     */
    public function approveRequest($id, $adminNote = null)
    {
        try {
            DB::beginTransaction();

            $resellRequest = $this->findById($id);

            if (!$resellRequest->isPending()) {
                throw new Exception('This request cannot be approved.');
            }

            $resellRequest->approve($adminNote);

            DB::commit();
            return $resellRequest;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Reject a resell request
     */
    public function rejectRequest($id, $adminNote = null)
    {
        try {
            DB::beginTransaction();

            $resellRequest = $this->findById($id);

            if (!$resellRequest->isPending()) {
                throw new Exception('This request cannot be rejected.');
            }

            $resellRequest->reject($adminNote);

            DB::commit();
            return $resellRequest;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Get available products for resale
     */
    public function getAvailableProductsForResale($perPage = 15)
    {
        return Product::with(['skus', 'categories', 'brand'])
            ->where('status', 1)
            ->where('is_approved', 1)
            ->where('is_resale_enabled', false) // Only products not already enabled for resale
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get resale products (approved and enabled for resale)
     */
    public function getResaleProducts($perPage = 15)
    {
        return Product::with(['skus', 'categories', 'brand'])
            ->where('status', 1)
            ->where('is_approved', 1)
            ->where('is_resale_enabled', true)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Validate selling price against actual price
     */
    private function validateSellingPrice($actualPrice, $sellingPrice)
    {
        $minMultiplier = config('reseller.min_selling_price_multiplier', 1.1);
        $maxMultiplier = config('reseller.max_selling_price_multiplier', 5.0);

        $minPrice = $actualPrice * $minMultiplier;
        $maxPrice = $actualPrice * $maxMultiplier;

        if ($sellingPrice < $minPrice) {
            throw new Exception("Selling price must be at least " . number_format($minPrice, 2) . " (10% higher than actual price).");
        }

        if ($sellingPrice > $maxPrice) {
            throw new Exception("Selling price cannot exceed " . number_format($maxPrice, 2) . " (5x the actual price).");
        }

        if ($sellingPrice <= $actualPrice) {
            throw new Exception("Selling price must be higher than the actual price.");
        }
    }

    /**
     * Get statistics for dashboard
     */
    public function getStatistics()
    {
        return [
            'total_requests' => ResellRequest::count(),
            'pending_requests' => ResellRequest::pending()->count(),
            'approved_requests' => ResellRequest::approved()->count(),
            'rejected_requests' => ResellRequest::rejected()->count(),
            'total_resale_products' => Product::where('is_resale_enabled', true)->count(),
            'total_customer_profit' => ResellRequest::approved()->sum('customer_profit'),
            'total_admin_profit' => ResellRequest::approved()->sum('admin_profit'),
        ];
    }

    /**
     * Get customer statistics
     */
    public function getCustomerStatistics($customerId)
    {
        return [
            'total_requests' => ResellRequest::byCustomer($customerId)->count(),
            'pending_requests' => ResellRequest::byCustomer($customerId)->pending()->count(),
            'approved_requests' => ResellRequest::byCustomer($customerId)->approved()->count(),
            'rejected_requests' => ResellRequest::byCustomer($customerId)->rejected()->count(),
            'total_profit' => ResellRequest::byCustomer($customerId)->approved()->sum('customer_profit'),
        ];
    }
} 