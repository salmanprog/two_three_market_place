@extends('frontend.amazy.layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/product/css/product_edit.css'))}}" />
<link rel="stylesheet" href="{{ asset(asset_path('backend/vendors/css/icon-picker.css')) }}" />
<link rel="stylesheet" href="{{ asset(asset_path('backend/vendors/font_awesome/css/all.min.css')) }}" />
<link rel="stylesheet" href="{{asset(asset_path('backend/vendors/themefy_icon/themify-icons.css'))}}" />
<link rel="stylesheet" href="{{ asset(asset_path('backend/vendors/css/toastr.min.css')) }}" />
<link rel="stylesheet" href="{{ asset(asset_path('backend/css/backend_static_style.css')) }}" />
<link rel="stylesheet" href="{{ asset(asset_path('backend/css/infix.css')) }}" />
<style>
    /* Admin product edit page styling */
    .input-right-icon button i {
        top: 0px;
        right: 12px;
    }

    .admin-visitor-area {
        padding: 20px 0;
    }

    .white_box {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        padding: 20px;
    }

    .white_box_50px {
        background: #fff;
        border-radius: 8px;
        padding: 50px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .box_shadow_white {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    }

    .box_header {
        margin-bottom: 30px;
    }

    .common_table_header {
        border-bottom: 1px solid #e4e6ea;
        padding-bottom: 15px;
    }

    .main-title h3 {
        color: #415094;
        font-weight: 600;
        margin: 0;
    }

    /* Form input styles */
    .primary_input {
        margin-bottom: 15px;
        position: relative;
        height: auto !important;
        border: none !important;
    }

    .primary_input_label {
        font-weight: 500;
        color: #415094;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
        line-height: 1.4;
    }

    .primary_input_field {
        width: 100%;
        border: 1px solid #e4e6ea;
        border-radius: 4px;
        padding: 10px 15px;
        font-size: 14px;
        background: #fff;
        transition: all 0.3s ease;
        line-height: 1.5;
    }

    .primary_input_field:focus {
        border-color: #415094;
        outline: none;
        box-shadow: 0 0 0 2px rgba(65, 80, 148, 0.1);
    }

    /* Toggle switch styles */
    .switch_toggle {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch_toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #415094;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    /* Select dropdown styles */
    .primary_select {
        width: 100%;
        border: 1px solid #e4e6ea;
        border-radius: 4px;
        padding: 10px 15px;
        font-size: 14px;
        background: #fff;
        transition: all 0.3s ease;
    }

    .primary_select:focus {
        border-color: #415094;
        outline: none;
        box-shadow: 0 0 0 2px rgba(65, 80, 148, 0.1);
    }

    /* Date picker styles */
    .primary_datepicker_input {
        position: relative;
    }

    .primary_datepicker_input input {
        width: 100%;
        border: 1px solid #e4e6ea;
        border-radius: 4px;
        padding: 10px 15px;
        font-size: 14px;
        background: #fff;
        transition: all 0.3s ease;
    }

    .primary_datepicker_input input:focus {
        border-color: #415094;
        outline: none;
        box-shadow: 0 0 0 2px rgba(65, 80, 148, 0.1);
    }

    .primary_datepicker_input button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        font-size: 16px;
    }

    .primary_datepicker_input button:hover {
        color: #415094;
    }

    /* File uploader styles */
    .primary_file_uploader {
        border: 2px dashed #e4e6ea;
        border-radius: 4px;
        padding: 20px;
        text-align: center;
        background: #f8f9fa;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .primary_file_uploader:hover {
        border-color: #415094;
        background: #f0f8ff;
    }

    .primary_file_uploader input[type="text"] {
        border: none;
        background: transparent;
        text-align: center;
        width: 100%;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .primary_file_uploader button {
        background: #415094;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .primary_file_uploader button:hover {
        background: #2c3e50;
    }

    /* Image display styles */
    .thumb_img_div {
        display: flex;
        height: 100px;
        width: 100px;
        align-items: center;
        justify-content: center;
        border: 1px solid #e4e6ea;
        margin-top: 10px;
    }

    .thumb_img_div img {
        max-width: 95%;
        max-height: 95px;
        border-radius: 4px;
    }

    /* Error message styles */
    .text-danger {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    /* Button styles */
    .primary_btn_2 {
        background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .primary_btn_2:hover {
        background: linear-gradient(90deg, #6a2ce8 0%, #b030c4 51%, #6a2ce8 100%);
        transform: translateY(-1px);
    }

    /* Margin utilities */
    .mb-15 {
        margin-bottom: 15px;
    }

    .mb-20 {
        margin-bottom: 20px;
    }

    .mb-30 {
        margin-bottom: 30px;
    }

    .mt-5 {
        margin-top: 5px;
    }

    /* Grid system compatibility */
    .row {
        margin-left: -15px;
        margin-right: -15px;
    }

    .col-lg-3,
    .col-lg-6,
    .col-lg-12 {
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .white_box_50px {
            padding: 30px 20px;
        }

        .primary_input_field,
        .primary_select {
            font-size: 16px;
        }
    }
</style>
@section('content')
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="admin-visitor-area">
                    <div class="white_box">
                        <form action="{{route('seller.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="box_header common_table_header">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('product.add_product') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- <div class="col-lg-12">
                                                <div class="main-title d-flex">
                                                    <h3 class="mb-2 mr-30">{{ __('product.product_information') }}</h3>
                                                </div>
                                            </div> -->

                                <!-- Stock Management Toggle -->
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="stock_manage">{{__("product.i_want_to_manage_stock_for_this_product")}}</label>
                                        <label class="switch_toggle" for="checkbox1">
                                            <input type="checkbox" id="checkbox1" name="stock_manage" @if ($product->stock_manage == 1) checked @endif value="1">
                                            <div class="slider round"></div>
                                        </label>
                                    </div>
                                </div>
                                <!-- Thumbnail Image -->
                                <div class="col-lg-6">
                                    <div class="single_p col-xl-12 upload_photo_div">
                                        <div id="sliderImgFileDiv">
                                            <div class="primary_input mb-25">
                                                <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="slider_image_media">
                                                    <input class="primary-input file_amount" type="text" id="image" placeholder="{{__('common.browse_image_file')}}" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="image">{{__("common.image")}} </label>
                                                        <input type="hidden" class="selected_files" value="">
                                                    </button>
                                                </div>
                                                <div class="product_image_all_div">
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error_image"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- Display Name -->
                                    <div class="primary_input  mb-15">
                                        <label class="primary_input_label d-flex align-items-center gap-2" for="product_name">{{__("product.display_name")}} <span class="text-danger">*</span></label>
                                        <input class="primary_input_field" id="product_name" name="product_name" placeholder="{{__("product.display_name")}}" type="text" value="{{old('product_name')?old('product_name'):$product->product_name}}" required>
                                        <span class="text-danger">{{$errors->first('product_name')}}</span>
                                    </div>
                                </div>

                                <!-- Purchase Price and New Price Fields -->
                                <!-- <div class="col-lg-6">
                                <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="purchase_price">{{__("product.purchase_price")}}</label>
                                            <input class="primary_input_field" id="purchase_price" name="purchase_price" placeholder="{{__("product.purchase_price")}}" type="text" value="{{$purchasePrice ? single_price($purchasePrice) : 'N/A'}}" readonly>
                                            <span class="text-muted">{{__("product.purchase_price_description")}}</span>
                                </div>
                                    </div> -->
                                                            <div class="col-lg-6">
                                <div class="primary_input mb-15">
                                        <label class="primary_input_label d-flex align-items-center gap-2" for="old_price">{{__("Old Price")}} <span class="text-danger">*</span></label>
                                        <input class="primary_input_field" id="old_price" name="old_price" placeholder="{{__("product.old_price")}}" type="number" min="0" step="{{step_decimal()}}" value="{{old('old_price', $product->selling_price ?? 0)}}" required>
                                        <span class="text-muted">Product Price: {{$product->selling_price}}</span>
                                    </div>
                                        </div>
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label d-flex align-items-center gap-2" for="new_price">{{__("New Price")}} <span class="text-danger">*</span></label>
                                        <input class="primary_input_field" id="new_price" name="new_price" placeholder="{{__("product.new_price")}}" type="number" min="0" step="{{step_decimal()}}" value="{{old('new_price')}}" required>
                                        <span class="text-danger">{{$errors->first('new_price')}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Update Button -->
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button class="primary_btn_2 mt-5 text-center" type="submit">
                                        <i class="ti-check"></i>{{ __('common.update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Media Manager Modal -->
<div id="mediaManagerDiv"></div>
@endsection

@push('scripts')
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            // Stock management toggle functionality
            $('#checkbox1').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });

            // Date picker initialization
            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        });
    })(jQuery);
</script>
@endpush