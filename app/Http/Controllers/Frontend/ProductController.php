<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Traits\GoogleAnalytics4;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Modules\Product\Entities\ProductReport;
use Modules\Product\Services\ReportReasonService;
use Modules\CheckPincode\Entities\PinCodeConfigurations;
use Modules\Product\Entities\Product;
use Modules\UserActivityLog\Traits\LogActivity;

class ProductController extends Controller
{
    use GoogleAnalytics4;

    protected $productService, $reason;
    public function __construct(ProductService $productService, ReportReasonService $reportReasonService)
    {
        $this->productService = $productService;
        $this->reason = $reportReasonService;
        $this->middleware('maintenance_mode');
    }

    public function show($seller, $slug = null)
    {

        session()->forget('item_details');
        if ($slug) {
            $product =  $this->productService->getActiveSellerProductBySlug($slug, $seller);
        } else {
            $product =  $this->productService->getActiveSellerProductBySlug($seller);
        }
        if ($product->status == 0 || $product->product->status == 0) {
            return abort(404);
        }
        if (auth()->check()) {
            $this->productService->recentViewStore($product->id);
        } else {
            $recentViwedData = [];
            $recentViwedData['product_id'] = $product->id;
            if (session()->has('recent_viewed_products')) {
                $recent_viewed_products = collect();
                foreach (session()->get('recent_viewed_products') as $key => $recentViwedItem) {
                    $recent_viewed_products->push($recentViwedItem);
                }
                $recent_viewed_products->push($recentViwedData);
                session()->put('recent_viewed_products', $recent_viewed_products);
            } else {
                $recent_viewed_products = collect([$recentViwedData]);
                session()->put('recent_viewed_products', $recent_viewed_products);
            }
        }
        $this->productService->recentViewIncrease($product->id);
        $item_details = session()->get('item_details');
        $options = array();
        $data = array();
        if ($product->product->product_type == 2 && $product->variant_details != '') {
            $item_detail = [];
            foreach ($product->variant_details as $key => $v) {
                $item_detail[$key] = [
                    'name' => $v->name,
                    'attr_id' => $v->attr_id,
                    'code' => $v->code,
                    'value' => $v->value,
                    'id' => $v->attr_val_id,
                ];
                array_push($data, $v->value);
            }
            if (!empty($item_details)) {
                session()->put('item_details', $item_details + $item_detail);
            } else {
                session()->put('item_details', $item_detail);
            }
        }
        $reviews = $product->reviews->where('status', 1)->pluck('rating');
        if (count($reviews) > 0) {
            $value = 0;
            $rating = 0;
            foreach ($reviews as $review) {
                $value += $review;
            }
            $rating = $value / count($reviews);
            $total_review = count($reviews);
        } else {
            $rating = 0;
            $total_review = 0;
        }
        //ga4
        if (app('business_settings')->where('type', 'google_analytics')->first()->status == 1) {
            $eData = [
                'name' => 'view_item',
                'params' => [
                    "currency" => currencyCode(),
                    "value" => 1,
                    "items" => [
                        [
                            "item_id" => $product->product->skus[0]->sku,
                            "item_name" => $product->product_name,
                            "currency" => currencyCode(),
                            "price" => $product->product->skus[0]->selling_price
                        ]
                    ],
                ],
            ];
            $this->postEvent($eData);
        }
        //end ga4
        $recent_viewed_products = $this->productService->recentViewedLast3Product($product->id);
        $reasons = $this->reason->get();
        if (isModuleActive('CheckPincode')) {
            $pincodeConfig = PinCodeConfigurations::first();
            return view(theme('pages.product_details'), compact('product', 'rating', 'total_review', 'recent_viewed_products', 'pincodeConfig', 'reasons'));
        }
        return view(theme('pages.product_details'), compact('product', 'rating', 'total_review', 'recent_viewed_products', 'reasons'));
    }

    public function show_in_modal(Request $request)
    {
        session()->forget('item_details');
        $product =  $this->productService->getProductByID($request->product_id);
        $this->productService->recentViewIncrease($request->product_id);
        $item_details = session()->get('item_details');
        $options = array();
        $data = array();
        if ($product->product->product_type == 2) {
            $item_detail = [];
            foreach ($product->variant_details as $key => $v) {
                $item_detail[$key] = [
                    'name' => $v->name,
                    'attr_id' => $v->attr_id,
                    'code' => $v->code,
                    'value' => $v->value,
                    'id' => $v->attr_val_id,
                ];
                array_push($data, $v->value);
            }

            if (!empty($item_details)) {
                session()->put('item_details', $item_details + $item_detail);
            } else {
                session()->put('item_details', $item_detail);
            }
        }
        $reviews = $product->reviews->where('status', 1)->pluck('rating');
        if (count($reviews) > 0) {
            $value = 0;
            $rating = 0;
            foreach ($reviews as $review) {
                $value += $review;
            }
            $rating = $value / count($reviews);
            $total_review = count($reviews);
        } else {
            $rating = 0;
            $total_review = 0;
        }
        return (string) view(theme('partials.product_add_to_cart_modal'), compact('product', 'rating', 'total_review'));
    }
    public function admin_show_in_modal(Request $request)
    {
        session()->forget('item_details');
        $product =  $this->productService->getProductByID($request->product_id);
        $this->productService->recentViewIncrease($request->product_id);
        $item_details = session()->get('item_details');
        $options = array();
        $data = array();
        if ($product->product->product_type == 2) {
            foreach ($product->variant_details as $key => $v) {
                $item_detail[$key] = [
                    'name' => $v->name,
                    'attr_id' => $v->attr_id,
                    'code' => $v->code,
                    'value' => $v->value,
                    'id' => $v->attr_val_id,
                ];
                array_push($data, $v->value);
            }

            if (!empty($item_details)) {
                session()->put('item_details', $item_details + $item_detail);
            } else {
                session()->put('item_details', $item_detail);
            }
        }
        $reviews = $product->reviews->where('status', 1)->pluck('rating');
        if (count($reviews) > 0) {
            $value = 0;
            $rating = 0;
            foreach ($reviews as $review) {
                $value += $review;
            }
            $rating = $value / count($reviews);
            $total_review = count($reviews);
        } else {
            $rating = 0;
            $total_review = 0;
        }
        return view('backEnd.pages.customer_data.product_add_to_cart_modal', compact('product', 'rating', 'total_review'));
    }

    public function getReviewByPage(Request $request)
    {
        $reviews = $this->productService->getReviewByPage($request->only('page', 'product_id'));
        $product = $this->productService->getProductByID($request->product_id);
        if ($product) {
            $all_reviews = $product->reviews;
        } else {
            $all_reviews = collect();
        }
        return view(theme('partials._product_review_with_paginate'), compact('reviews', 'all_reviews'));
    }

    public function getPickupByCity(Request $request)
    {
        $get_pickup_location_by_city = $this->productService->getPickupByCity($request->except('_token'));
        return $get_pickup_location_by_city;
    }

    public function getPickupInfo(Request $request)
    {
        $pickup = $this->productService->getPickupById($request->except('_token'));
        $shipping_method = $this->productService->getLowestShippingFromSeller($request->except('_token'));
        return response()->json([
            'pickup_location' => $pickup,
            'shipping' => $shipping_method
        ]);
    }

    public function submitReport(Request $request)
    {
        $data = $request->validate([
            "reason_id" => "nullable",
            "email" => "required",
            "comment" => "required",
            "product_id" => "required"
        ]);
        try {
            $create =  ProductReport::create($data);
            if ($create) {
                Toastr::success('product_reported', 'Success');
            } else {
                Toastr::error('Something went wrong', 'Error');
            }
            return back();
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return response()->json([
                "status" => 0,
            ]);
        }
    }

    public function newShopPage()
    {
        // Fetch all products or specific products
        $products = Product::paginate(12); // Aap yahan apne requirement ke mutabiq filter kar sakte hain

        // Return view with products
        return view('frontend.new-shop', compact('products'));
    }
}
