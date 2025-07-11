<?php

namespace Modules\Reseller\Integration;

use App\Models\Order;
use Modules\Reseller\Services\ResaleCheckoutService;
use Illuminate\Support\Facades\Log;

/**
 * Integration class to hook into existing AmazCart checkout process
 * This file shows how to integrate the resale commission calculation
 * into the existing order processing workflow.
 */
class CheckoutIntegration
{
    protected $resaleCheckoutService;

    public function __construct(ResaleCheckoutService $resaleCheckoutService)
    {
        $this->resaleCheckoutService = $resaleCheckoutService;
    }

    /**
     * Hook into order completion process
     * This method should be called after an order is successfully created and paid
     */
    public function processOrderCommission(Order $order)
    {
        try {
            // Check if the order contains any resale products
            $hasResaleProducts = $this->checkForResaleProducts($order);
            
            if ($hasResaleProducts) {
                // Process resale commission
                $this->resaleCheckoutService->processResaleCommission($order);
                
                // Get commission summary for logging
                $summary = $this->resaleCheckoutService->getResaleCommissionSummary($order);
                
                Log::info('Resale commission processed', [
                    'order_id' => $order->id,
                    'total_reseller_commission' => $summary['total_reseller_commission'],
                    'total_admin_commission' => $summary['total_admin_commission'],
                    'resale_products_count' => count($summary['resale_products']),
                ]);
            }
            
            return true;
            
        } catch (\Exception $e) {
            Log::error('Error processing resale commission', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
            
            throw $e;
        }
    }

    /**
     * Check if order contains resale products
     */
    protected function checkForResaleProducts(Order $order)
    {
        foreach ($order->packages as $package) {
            foreach ($package->products as $orderProduct) {
                if ($orderProduct->product && $orderProduct->product->is_resale_enabled) {
                    return true;
                }
            }
        }
        
        return false;
    }

    /**
     * Get resale commission summary for order display
     */
    public function getOrderCommissionSummary(Order $order)
    {
        return $this->resaleCheckoutService->getResaleCommissionSummary($order);
    }

    /**
     * Hook into order confirmation process
     * This can be called when admin confirms an order
     */
    public function onOrderConfirmation(Order $order)
    {
        // Additional processing when order is confirmed
        // This could include notifications, reporting, etc.
        
        $summary = $this->resaleCheckoutService->getResaleCommissionSummary($order);
        
        if ($summary['has_resale_products']) {
            // Send notifications to resellers
            $this->notifyResellers($order, $summary);
            
            // Update admin reports
            $this->updateAdminReports($order, $summary);
        }
    }

    /**
     * Notify resellers about their commission
     */
    protected function notifyResellers(Order $order, $summary)
    {
        // Implementation would depend on your notification system
        // For now, just log the notification
        Log::info('Reseller commission notification', [
            'order_id' => $order->id,
            'resale_products' => $summary['resale_products'],
        ]);
    }

    /**
     * Update admin reports with resale commission data
     */
    protected function updateAdminReports(Order $order, $summary)
    {
        // Implementation would depend on your reporting system
        // For now, just log the report update
        Log::info('Admin resale commission report update', [
            'order_id' => $order->id,
            'total_admin_commission' => $summary['total_admin_commission'],
        ]);
    }
}

/**
 * USAGE INSTRUCTIONS:
 * 
 * 1. Add this to your existing order processing workflow:
 * 
 * // In your OrderRepository or OrderService
 * public function orderStore($data)
 * {
 *     // ... existing order creation code ...
 *     
 *     $order = Order::create($orderData);
 *     
 *     // ... existing order processing code ...
 *     
 *     // Add this line to process resale commission
 *     if (isModuleActive('Reseller')) {
 *         $checkoutIntegration = app(CheckoutIntegration::class);
 *         $checkoutIntegration->processOrderCommission($order);
 *     }
 *     
 *     return $order;
 * }
 * 
 * 2. Add to order confirmation process:
 * 
 * public function confirmOrder($orderId)
 * {
 *     $order = Order::findOrFail($orderId);
 *     
 *     // ... existing confirmation code ...
 *     
 *     // Add this line to process resale commission on confirmation
 *     if (isModuleActive('Reseller')) {
 *         $checkoutIntegration = app(CheckoutIntegration::class);
 *         $checkoutIntegration->onOrderConfirmation($order);
 *     }
 * }
 * 
 * 3. Display commission information in order details:
 * 
 * public function showOrder($orderId)
 * {
 *     $order = Order::with('packages.products')->findOrFail($orderId);
 *     
 *     $commissionSummary = null;
 *     if (isModuleActive('Reseller')) {
 *         $checkoutIntegration = app(CheckoutIntegration::class);
 *         $commissionSummary = $checkoutIntegration->getOrderCommissionSummary($order);
 *     }
 *     
 *     return view('orders.show', compact('order', 'commissionSummary'));
 * }
 */ 