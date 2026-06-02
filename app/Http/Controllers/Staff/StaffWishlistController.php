<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Services\WishlistService;
use Exception;
use Modules\UserActivityLog\Traits\LogActivity;

class StaffWishlistController extends Controller
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
        $this->middleware(['maintenance_mode', 'auth']);
    }

    public function index()
    {
        try {
            $data['products'] = $this->wishlistService->myWishlist(auth()->user()->id);

            return view('backEnd.pages.staff_wishlist.wishlist', $data);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());

            return back();
        }
    }

    public function my_wish_list()
    {
        try {
            $page = null;
            $sort_by = $_GET['sort_by'] ?? null;
            $paginate = $_GET['paginate'] ?? null;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }
            if (isset($_GET['paginate'])) {
                $data['paginate'] = $_GET['paginate'];
            }
            if (isset($_GET['sort_by'])) {
                $data['sort_by'] = $_GET['sort_by'];
            }
            $data['products'] = $this->wishlistService->myWishlistWithPaginate([
                'page' => $page,
                'sort_by' => $sort_by,
                'paginate' => $paginate,
            ]);

            return view('backEnd.pages.customer_data._wishlist_with_paginate', $data);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());

            return $e->getMessage();
        }
    }
}
