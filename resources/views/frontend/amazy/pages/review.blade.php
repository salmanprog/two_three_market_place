@extends('frontend.amazy.layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset(asset_path('frontend/amazy/css/page_css/review.css'))}}" />
@endpush
@section('title')
    {{ __('defaultTheme.write_review') }}
@endsection

@section('content')

<!--  dashboard part css here -->
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>

            <div class="col-lg-8 col-xl-9">
                <form action="{{route('frontend.profile.review.store')}}" method="POST" enctype="multipart/form-data" id="main_form">
                    @csrf
                    <div class="customer_review_wrapper">
                        <div class="customer_review_wrapper_inner">
                            <!-- customer_review_lefts  -->
                            
                            <div class="customer_review_right">
                                <div class="review_seller_box">
                                    @if(isModuleActive('MultiVendor'))
                                        <p>
                                            @if (@$package->seller->slug)
                                                <a href="{{route('frontend.seller',@$package->seller->slug)}}">
                                                    @if(@$package->seller->id == 1)
                                                        {{ app('general_setting')->company_name }}
                                                    @else
                                                        {{@$package->seller->first_name}}
                                                    @endif
                                                </a>
                                            @else
                                                <a href="{{route('frontend.seller',base64_encode(@$package->seller->id))}}">{{ app('general_setting')->company_name }}</a>
                                            @endif
                                        </p>
                                    @endif
                                    <input type="hidden" name="seller_id" value="{{ request()->get('seller_id') }}">
                                    <input type="hidden" name="order_id" value="{{@$package->order->id}}">
                                    <input type="hidden" name="package_id" value="{{@$package->id}}">
                                    <h5 class="font_14 f_w_700">@if(isModuleActive('MultiVendor')){{ __('defaultTheme.rate_and_review_your_seller') }}@else {{__('common.company_rating_review')}} @endif</h5>
                                    <div class="star_icon d-flex align-items-center">
                                        <a class="rating">
                                        <input type="radio" id="seller_star5" name="seller_rating" checked value="5" class="rating"><label class="full rate_to_seller" for="seller_star5" id="star5" title="Delightful - 5 stars" data-rating="5"></label>
                                        <input type="radio" id="seller_star4" name="seller_rating" value="4" class="rating"><label class="full rate_to_seller" for="seller_star4" title="Satisfactory - 4 stars" data-rating="4"></label>
                                        <input type="radio" id="seller_star3" name="seller_rating" value="3" class="rating"><label class="full rate_to_seller" for="seller_star3" title="Neutral - 3 stars" data-rating="3"></label>
                                        <input type="radio" id="seller_star2" name="seller_rating" value="2" class="rating"><label class="full rate_to_seller" for="seller_star2" title="Poor - 2 stars" data-rating="2"></label>
                                        <input type="radio" id="seller_star1" name="seller_rating" value="1" class="rating"><label class="full rate_to_seller" for="seller_star1" title="Very Poor - 1 star" data-rating="1"></label>
                                        </a>
                                    </div>
                                    <div class="send_query mt-3">
                                        <div class="form-group">
                                            <label for="textarea" class="font_14">{{ __('defaultTheme.review_details') }}</label>
                                            <textarea class="primary_textarea4 radius_5px mb_25" name="seller_review" id="seller_review_field" placeholder="{{ __('How over all experience with artist?') }}" spellcheck="false"></textarea>
                                            <span class="text-danger" id="error_seller_review_field"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="customer_review_bottom">
                            <div class="row justify-content-end">
                                <div class="col-xl-4">
                                <div class="customer_review_as mb_20 mt_20">
                                    @php
                                        $user = auth()->user();
                                    @endphp
                                    <span class="font_14 f_w_500">{{__('review.review_as')}} {{$user->first_name}}.</span>
                                    <label class="switch_toggle" for="checkbox">
                                        <input type="checkbox" name="is_anonymous" value="1" id="checkbox">
                                        <div class="slider round"></div>
                                    </label>
                                    <span class="Anonymous" >{{ __('defaultTheme.anonymous') }}</span>
                                </div>
                                    <button type="submit" class="amaz_primary_btn min_200 style2 w-100 text-center" id="submit_btn">{{ __('common.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
    <script>

        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click', '.product_rating', function(event){
                    let rate = $(this).data('rate');
                    $('#product_rating').val(val);
                });
                $(document).on('click', '.rate_to_seller', function(event){
                    let rate = $(this).data('rating');
                    $('#seller_rating').val(val);
                });
                $(document).on('change', '.upload_img_for_product', function(event){
                    let upload_div = $(this).data('upload_div');
                    let count = $(this).data('count');
                    uploadImage($(this)[0], upload_div, count);
                });
                function uploadImage(data, divId, count) {
                    if (data.files) {
                        if(data.files.length>6){
                            toastr.error("{{__('defaultTheme.maximum_6_image_can_upload')}}","{{__('common.error')}}");
                            data.value = '';
                        }
                        else{
                            $.each(data.files, function(key, value) {
                            $(divId).empty();
                            $(count).text(data.files.length+'/6');
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $(divId).append(
                                    `<div class="single_img">
                                        <img src="` +e.target.result + `" alt="">
                                    </div>`);
                            };
                            reader.readAsDataURL(value);
                        });
                        }
                    }
                }
            });
        })(jQuery);

    </script>
@endpush
