<?php

namespace Modules\Reseller\Services;

use Modules\Reseller\Repositories\ResellRequestRepository;
use Modules\Product\Entities\Product;
use Modules\Seller\Entities\SellerProductSKU;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class ResellerService
{
    protected $resellRequestRepository;

    public function __construct(ResellRequestRepository $resellRequestRepository)
    {
        $this->resellRequestRepository = $resellRequestRepository;
    }

    /**
     * Submit a resell request
     */
    public function submitResellRequest($data)
    {
        // Validate the request data
        $this->validateResellRequestData($data);

        // Get the actual price from the seller product SKU
        $sellerProductSku = SellerProductSKU::findOrFail($data['seller_product_sku_id']);
        $data['actual_price'] = $sellerProductSku->selling_price;

        // Create the resell request
        return $this->resellRequestRepository->createRequest($data);
    }

    /**
     * Approve a resell request
     */
    public function approveResellRequest($id, $adminNote = null)
    {
        $resellRequest = $this->resellRequestRepository->approveRequest($id, $adminNote);

        // Send notification to customer
        $this->sendApprovalNotification($resellRequest);

        return $resellRequest;
    }

    /**
     * Reject a resell request
     */
    public function rejectResellRequest($id, $adminNote = null)
    {
        $resellRequest = $this->resellRequestRepository->rejectRequest($id, $adminNote);

        // Send notification to customer
        $this->sendRejectionNotification($resellRequest);

        return $resellRequest;
    }

    /**
     * Calculate commission for resale product
     */
    public function calculateResaleCommission($resellRequest, $orderAmount)
    {
        $profit = $resellRequest->selling_price - $resellRequest->actual_price;
        $profitShare = $profit * 0.5; // 50% of profit

        return [
            'customer_commission' => $resellRequest->actual_price + $profitShare,
            'admin_commission' => $profitShare,
            'total_profit' => $profit,
        ];
    }

    /**
     * Process resale order commission
     */
    public function processResaleOrderCommission($order, $orderProduct)
    {
        // Check if this is a resale product
        if (!$orderProduct->product->is_resale_enabled) {
            return null;
        }

        // Get the resell request
        $resellRequest = $orderProduct->product->resellRequest;
        if (!$resellRequest) {
            return null;
        }

        // Calculate commission
        $commission = $this->calculateResaleCommission($resellRequest, $orderProduct->total_price);

        // Add commission to order product details
        $orderProduct->update([
            'reseller_commission' => $commission['customer_commission'],
            'admin_commission' => $commission['admin_commission'],
        ]);

        return $commission;
    }

    /**
     * Get available products for customer to resell
     */
    public function getAvailableProductsForCustomer($customerId, $perPage = 15)
    {
        // Get products that the customer has purchased
        $purchasedProducts = $this->getCustomerPurchasedProducts($customerId);

        // Filter out products that already have pending or approved resell requests
        $availableProducts = $purchasedProducts->filter(function ($product) use ($customerId) {
            $hasRequest = \Modules\Reseller\Entities\ResellRequest::where('customer_id', $customerId)
                ->where('product_id', $product->id)
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            return !$hasRequest && !$product->is_resale_enabled;
        });

        return $availableProducts->paginate($perPage);
    }

    /**
     * Get products purchased by customer
     */
    private function getCustomerPurchasedProducts($customerId)
    {
        // This would need to be implemented based on your order structure
        // For now, returning all available products
        return Product::with(['skus', 'categories', 'brand'])
            ->where('status', 1)
            ->where('is_approved', 1)
            ->where('is_resale_enabled', false)
            ->get();
    }

    /**
     * Validate resell request data
     */
    private function validateResellRequestData($data)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'seller_product_sku_id' => 'required|exists:seller_product_s_k_us,id',
            'product_condition' => 'required|in:new,used',
            'selling_price' => 'required|numeric|min:0',
            'customer_note' => 'nullable|string|max:1000',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        // Additional validation
        $product = Product::findOrFail($data['product_id']);
        $sellerProductSku = SellerProductSKU::findOrFail($data['seller_product_sku_id']);

        if ($product->id !== $sellerProductSku->product->product_id) {
            throw new Exception('Product and SKU mismatch.');
        }

        if ($product->is_resale_enabled) {
            throw new Exception('This product is already available for resale.');
        }
    }

    /**
     * Send approval notification to customer
     */
    private function sendApprovalNotification($resellRequest)
    {
        // Implementation would depend on your notification system
        // For now, just log the notification
        Log::info('Resell request approved', [
            'request_id' => $resellRequest->id,
            'customer_id' => $resellRequest->customer_id,
            'product_id' => $resellRequest->product_id,
        ]);
    }

    /**
     * Send rejection notification to customer
     */
    private function sendRejectionNotification($resellRequest)
    {
        // Implementation would depend on your notification system
        // For now, just log the notification
        Log::info('Resell request rejected', [
            'request_id' => $resellRequest->id,
            'customer_id' => $resellRequest->customer_id,
            'product_id' => $resellRequest->product_id,
        ]);
    }

    /**
     * Get resale statistics for admin dashboard
     */
    public function getAdminStatistics()
    {
        return $this->resellRequestRepository->getStatistics();
    }

    /**
     * Get customer resale statistics
     */
    public function getCustomerStatistics($customerId)
    {
        return $this->resellRequestRepository->getCustomerStatistics($customerId);
    }

    /**
     * Get resale products for frontend display
     */
    public function getResaleProductsForFrontend($perPage = 15)
    {
        return Product::with(['skus', 'categories', 'brand'])
            ->where('status', 1)
            ->where('is_approved', 1)
            ->where('is_resale_enabled', true)
            ->latest()
            ->paginate($perPage);
    }
} 