<?php

namespace Modules\Reseller\Services;

use App\Models\Order;
use App\Models\OrderProductDetail;
use Modules\Reseller\Entities\ResellRequest;
use Modules\Wallet\Repositories\WalletRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ResaleCheckoutService
{
    protected $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * Process resale commission for an order
     */
    public function processResaleCommission(Order $order)
    {
        try {
            DB::beginTransaction();

            foreach ($order->packages as $package) {
                foreach ($package->products as $orderProduct) {
                    $this->processOrderProductCommission($orderProduct, $order);
                }
            }

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Process commission for a single order product
     */
    protected function processOrderProductCommission(OrderProductDetail $orderProduct, Order $order)
    {
        // Check if this is a resale product
        if (!$orderProduct->product || !$orderProduct->product->is_resale_enabled) {
            return;
        }

        // Get the resell request
        $resellRequest = $orderProduct->product->resellRequest;
        if (!$resellRequest) {
            return;
        }

        // Calculate commission
        $commission = $this->calculateResaleCommission($resellRequest, $orderProduct->total_price);

        // Update order product with commission details
        $orderProduct->update([
            'reseller_commission' => $commission['customer_commission'],
            'admin_commission' => $commission['admin_commission'],
            'resell_request_id' => $resellRequest->id,
        ]);

        // Add commission to reseller's wallet
        $this->addResellerCommission($resellRequest->customer_id, $commission['customer_commission'], $order, $resellRequest);

        // Log admin commission (will be handled by existing admin commission system)
        $this->logAdminCommission($order, $commission['admin_commission'], $resellRequest);
    }

    /**
     * Calculate commission for resale product
     */
    protected function calculateResaleCommission(ResellRequest $resellRequest, $orderAmount)
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
     * Add commission to reseller's wallet
     */
    protected function addResellerCommission($resellerId, $amount, Order $order, ResellRequest $resellRequest)
    {
        if ($amount > 0) {
            $this->walletRepository->walletSalePaymentAdd(
                $order->id,
                $amount,
                "Resale Commission - Product: " . $resellRequest->product->product_name,
                $resellerId
            );
        }
    }

    /**
     * Log admin commission
     */
    protected function logAdminCommission(Order $order, $amount, ResellRequest $resellRequest)
    {
        if ($amount > 0) {
            // This would integrate with your existing admin commission system
            // For now, just log it
            Log::info('Admin resale commission', [
                'order_id' => $order->id,
                'amount' => $amount,
                'resell_request_id' => $resellRequest->id,
                'product_name' => $resellRequest->product->product_name,
            ]);
        }
    }

    /**
     * Get resale commission summary for an order
     */
    public function getResaleCommissionSummary(Order $order)
    {
        $totalResellerCommission = 0;
        $totalAdminCommission = 0;
        $resaleProducts = [];

        foreach ($order->packages as $package) {
            foreach ($package->products as $orderProduct) {
                if ($orderProduct->reseller_commission > 0 || $orderProduct->admin_commission > 0) {
                    $totalResellerCommission += $orderProduct->reseller_commission;
                    $totalAdminCommission += $orderProduct->admin_commission;
                    
                    $resaleProducts[] = [
                        'product_name' => $orderProduct->product->product_name ?? 'Unknown Product',
                        'reseller_commission' => $orderProduct->reseller_commission,
                        'admin_commission' => $orderProduct->admin_commission,
                        'total_price' => $orderProduct->total_price,
                    ];
                }
            }
        }

        return [
            'total_reseller_commission' => $totalResellerCommission,
            'total_admin_commission' => $totalAdminCommission,
            'resale_products' => $resaleProducts,
            'has_resale_products' => count($resaleProducts) > 0,
        ];
    }

    /**
     * Get reseller earnings for a specific period
     */
    public function getResellerEarnings($resellerId, $startDate = null, $endDate = null)
    {
        $query = OrderProductDetail::where('reseller_commission', '>', 0)
            ->whereHas('package.order', function ($q) use ($resellerId) {
                $q->where('is_paid', 1);
            })
            ->whereHas('product', function ($q) use ($resellerId) {
                $q->where('reseller_id', $resellerId);
            });

        if ($startDate) {
            $query->whereHas('package.order', function ($q) use ($startDate) {
                $q->where('created_at', '>=', $startDate);
            });
        }

        if ($endDate) {
            $query->whereHas('package.order', function ($q) use ($endDate) {
                $q->where('created_at', '<=', $endDate);
            });
        }

        $earnings = $query->get();

        return [
            'total_earnings' => $earnings->sum('reseller_commission'),
            'total_orders' => $earnings->count(),
            'earnings_breakdown' => $earnings->groupBy(function ($item) {
                return $item->package->order->created_at->format('Y-m');
            }),
        ];
    }

    /**
     * Get admin resale earnings for a specific period
     */
    public function getAdminResaleEarnings($startDate = null, $endDate = null)
    {
        $query = OrderProductDetail::where('admin_commission', '>', 0)
            ->whereHas('package.order', function ($q) {
                $q->where('is_paid', 1);
            });

        if ($startDate) {
            $query->whereHas('package.order', function ($q) use ($startDate) {
                $q->where('created_at', '>=', $startDate);
            });
        }

        if ($endDate) {
            $query->whereHas('package.order', function ($q) use ($endDate) {
                $q->where('created_at', '<=', $endDate);
            });
        }

        $earnings = $query->get();

        return [
            'total_earnings' => $earnings->sum('admin_commission'),
            'total_orders' => $earnings->count(),
            'earnings_breakdown' => $earnings->groupBy(function ($item) {
                return $item->package->order->created_at->format('Y-m');
            }),
        ];
    }
} 