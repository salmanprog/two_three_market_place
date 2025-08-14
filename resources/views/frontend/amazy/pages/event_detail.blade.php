@extends('frontend.amazy.layouts.app')

@push('styles')
    <style>
        .cursor_pointer {
            cursor: pointer !important;
        }

        .amaz_primary_btn.secondary {
            background: var(--text_color);
            border-color: var(--text_color);
        }

        .amaz_primary_btn.secondary:hover {
            background: var(--base_color);
            border-color: var(--base_color);
        }

        .package-list-wrapper {
            padding: 0px 0px 20px 50px !important;

        }

        .package-list-wrapper li {
            position: relative;
            text-align: left;
        }

        .package-list-wrapper li::before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            background-color: #000;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            left: -14px;
            top: 14px;
            transform: translateY(-50%) translateX(-100%);
            color: #fff;
            font-size: 12px;
        }

        .package-image {
            max-height: 270px;
            width: 100%;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 20px;
        }
        .choose-plan-btn {
            padding: 16px 46px !important;
        }
    </style>
@endpush

@section('content')
<div class="product_details_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xl-9">
                <div class="row">
                    <!-- image show -->
                        <div class="col-lg-6 col-xl-6">
                            <div class="slider-container slick_custom_container mb_30" id="myTabContent">
                                <div class="slider-for gallery_large">
                                    <div class="item-slick slick-current slick-active" id="thumb_5">
                                        <img class="varintImg zoom_01" src="http://localhost/tow-three-ld/public/frontend/amazy/img/6438ce493d38b.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- image show End -->    
                    <!-- Event Detail show -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="product_content_details mb_20">
                            <div id="stock_div">
                                    @if ($events->total_ticket > $events->sold_ticket)
                                        <span class="stoke_badge">{{__('Tickets Available')}}</span>
                                    @else
                                        <span class="stokeout_badge">{{__('Tickets Not Available')}}</span>
                                    @endif
                            </div>
                            <h3>{{$events->title}}</h3>
                            <div class="viendor_text d-flex align-items-center">
                                <p class="stock_text"> <span class="text-uppercase">{{__('Start Date')}}:</span> <span class="stock_value" id="sku_id_li"> {{dateConvert($events->from_date)}}</span></p>
                                <p class="stock_text"> <span class="text-uppercase">{{__('End Date')}}:</span>
                                    <span>{{dateConvert($events->to_date)}}</span>
                                </p>
                            </div>
                            <div class="viendor_text d-flex align-items-center">
                                <p class="stock_text"> <span class="text-uppercase">{{__('defaultTheme.availability')}}:</span> <span class="stock_value" id="availability">
                                    {{$events->remaining_ticket}}-{{__('tickets')}}
                                </span></p>
                            </div>
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="product_ratings mb-2">
                                    <div class="stars">
                                        Locations:
                                    </div>
                                    <span>{{$events->location}}</span>
                                </div>
                            </div>
                            <div class="destils_prise_information_box mb_20">
                                <h2 class="pro_details_prise d-flex align-items-center  m-0">
                                    <span>
                                        {{single_price($events->price)}}
                                    </span>
                                </h2>
                            </div>
                            <div class="product_info">
                                <div class="single_pro_varient">
                                    <h5 class="font_14 f_w_500 theme_text3 " >{{__('common.quantity')}}:</h5>
                                    <div class="product_number_count mr_5" data-target="amount-1">
                                        <span class="count_single_item inumber_decrement qtyChange" data-value="-"> <i class="ti-minus"></i></span>
                                        <input name="qty" id="qty" class="count_single_item input-number qty" type="text" data-value="0" value="1">
                                        <span class="count_single_item number_increment qtyChange" data-value="+"> <i class="ti-plus"></i></span>
                                    </div>
                                </div>
                                <div class="row mt_30 " id="add_to_cart_div">
                                    @if ($events->remaining_ticket > 0)
                                        <div class="col-6">
                                            <button type="button" id="butItNow" class="amaz_primary_btn3 mb_20  w-100 text-center justify-content-center text-uppercase buy_now_btn" data-id="{{$events->id}}" data-type="product">{{__('common.buy_now')}}</button>
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <button type="button" disabled class="amaz_primary_btn style2 mb_20  add_to_cart text-uppercase flex-fill text-center w-100">{{__('All Tickets Sold')}}</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>   
                    <!-- Event Detail show End --> 
                    <input type="hidden" name="stock_manage_status" id="stock_manage_status" value="1">
                    <input type="hidden" name="available_stock" id="available_stock" value="{{$events->remaining_ticket}}">
                    <input type="hidden" id="maximum_order_qty" value="{{$events->remaining_ticket}}">
                    <input type="hidden" id="minimum_order_qty" value="1">
                </div>
            </div>
            <div class="col-12">
                <div class="product_details_dec mb_76">
                    <div class="product_details_dec_header">
                        <h4 class="font_20 f_w_400 m-0 ">{{__('common.description')}}</h4>
                    </div>
                    <div class="product_details_dec_body">
                        <div class="product_description_container">
                            <div class="contents">
                                @php
                                    echo $events->description;
                                @endphp
                            </div>
                        </div>
                        <div class="col-12 show_full_btn d-none">
                            <button id="show_full_details" class="show_less amaz_primary_btn style3 text-uppercase">Show More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.qtyChange', function(event){
                event.preventDefault();
                let value = $(this).data('value');
                qtyChange(value);
            });
        function qtyChange(val){
            $('.cart-qty-minus').prop('disabled',false);
            let available_stock = $('#available_stock').val();
            let stock_manage_status = $('#stock_manage_status').val();
            let maximum_order_qty = $('#maximum_order_qty').val();
            let minimum_order_qty = $('#minimum_order_qty').val();
            let qty = $('#qty').data('value');
            if (stock_manage_status != 0) {
                if(val == '+'){
                    if (parseInt(qty) < parseInt(available_stock)) {
                        if(maximum_order_qty != ''){
                            if(parseInt(qty) < parseInt(maximum_order_qty)){
                            let qty1 = parseInt(++qty);
                            $('#qty').val(numbertrans(qty1));
                            $('#qty').data('value',qty1);
                            }else{
                                toastr.warning('{{__("defaultTheme.maximum_quantity_limit_is")}}'+maximum_order_qty+'.', '{{__("common.warning")}}');
                            }
                        }else{
                            let qty1 = parseInt(++qty);
                            $('#qty').val(numbertrans(qty1));
                            $('#qty').data('value',qty1);
                        }
                    }else{
                        toastr.error("{{__('defaultTheme.no_more_stock')}}", "{{__('common.error')}}");
                    }
                }
                if(val == '-'){
                    if (parseInt(qty) <= parseInt(available_stock)) {
                        if(minimum_order_qty != ''){
                            if(parseInt(qty) > parseInt(minimum_order_qty)){
                                if(qty>1){
                                    let qty1 = parseInt(--qty)
                                    $('#qty').val(numbertrans(qty1));
                                    $('#qty').data('value',qty1);
                                    $('.cart-qty-minus').prop('disabled',false);
                                }else{
                                    $('.cart-qty-minus').prop('disabled',true);
                                }
                            }else{
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}')
                            }
                        }else{
                            if(parseInt(qty)>1){
                                let qty1 = parseInt(--qty)
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                $('.cart-qty-minus').prop('disabled',false);
                            }else{
                                $('.cart-qty-minus').prop('disabled',true);
                            }
                        }
                    }else{
                        toastr.error("{{__('defaultTheme.no_more_stock')}}", "{{__('common.error')}}");
                    }
                }
            }
        }
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('#pricingToggle').on('change', function() {
                    this.value = this.checked ? 1 : 0;
                    if (this.value == 1) {
                        $('#type').val('yearly');
                        $('.monthly_price_div').addClass('d-none');
                        $('.yearly_price_div').removeClass('d-none');
                    }
                    if (this.value == 0) {
                        $('#type').val('monthly');
                        $('.yearly_price_div').addClass('d-none');
                        $('.monthly_price_div').removeClass('d-none');
                    }
                });
                $(document).on('click', '.select_btn_price', function() {
                    event.preventDefault();
                    $('#id').val($(this).attr("data-id"));
                    $('.price_subscription_add').submit();
                });
            });
        })(jQuery);
    </script>
@endpush
