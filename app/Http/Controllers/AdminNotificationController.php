<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Order;
use Modules\Product\Entities\Product;

class AdminNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin', 'maintenance_mode']);
    }

    public function index()
    {
        AdminNotification::query()
            ->visibleInAdminPanel()
            ->where('is_read', '0')
            ->update(['is_read' => '1']);

        $items = AdminNotification::query()
            ->visibleInAdminPanel()
            ->with(['user.role'])
            ->latest()
            ->paginate(25);

        $this->attachChatReceiverUserIds($items);

        return view('backEnd.pages.admin_notifications.index', compact('items'));
    }

    /**
     * @param  \Illuminate\Contracts\Pagination\LengthAwarePaginator  $paginator
     */
    private function attachChatReceiverUserIds($paginator): void
    {
        $productIds = [];
        foreach ($paginator->getCollection() as $n) {
            if ($n->refrence_id && (
                str_starts_with((string) ($n->slug ?? ''), 'product-resell-request-')
                || str_starts_with((string) ($n->slug ?? ''), 'seller-product-request-')
            )) {
                $productIds[(int) $n->refrence_id] = true;
            }
        }

        $resellerByProductId = [];
        $creatorByProductId = [];
        if ($productIds !== []) {
            $products = Product::query()
                ->whereIn('id', array_keys($productIds))
                ->get(['id', 'reseller_id', 'created_by']);
            foreach ($products as $product) {
                $resellerByProductId[(int) $product->id] = $product->reseller_id;
                $creatorByProductId[(int) $product->id] = $product->created_by;
            }
        }

        foreach ($paginator->getCollection() as $n) {
            $chatReceiverUserId = null;

            if ($n->user_id && $n->user && $n->user->role) {
                $type = $n->user->role->type ?? '';
                if ($type !== '' && ! in_array($type, ['superadmin', 'admin', 'staff'], true)) {
                    $chatReceiverUserId = (int) $n->user_id;
                }
            }

            if ($chatReceiverUserId === null && $n->refrence_id) {
                $pid = (int) $n->refrence_id;

                if (str_contains((string) ($n->slug ?? ''), '-signup-')) {
                    $chatReceiverUserId = $pid;
                } elseif (str_starts_with((string) ($n->slug ?? ''), 'new-order-')) {
                    $order = Order::query()->find($pid);
                    if ($order && $order->customer_id) {
                        $chatReceiverUserId = (int) $order->customer_id;
                    }
                } elseif (str_starts_with((string) ($n->slug ?? ''), 'seller-product-request-')) {
                    $creator = $creatorByProductId[$pid] ?? null;
                    if ($creator) {
                        $chatReceiverUserId = (int) $creator;
                    }
                } else {
                    $reseller = $resellerByProductId[$pid] ?? null;
                    if ($reseller) {
                        $chatReceiverUserId = (int) $reseller;
                    }
                }
            }

            $n->setAttribute('chat_receiver_user_id', $chatReceiverUserId > 0 ? $chatReceiverUserId : null);
        }
    }
}
