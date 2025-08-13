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
    <section class="section-pricing" style="padding: 100px 0px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10 mb_50">
                    @if (count($events) > 0)
                        @foreach($events as $key => $event)
                            <div class="col-xl-4 col-md-6 col-sm-6 col-6 d-flex">
                                <div class="product_widget5 mb_30 style5 w-100">
                                    <div class="product_thumb_upper">
                                        <a href="#" class="thumb">
                                            <img data-src="http://localhost/tow-three-ld/public/frontend/amazy/img/6438ce493d38b.svg" src="http://localhost/tow-three-ld/public/frontend/amazy/img/6438ce493d38b.svg" alt="newpremiumartist product" title="newpremiumartist product" class="lazyload">
                                        </a>
                                        <div class="product__meta text-center">
                                            <span class="product_banding "> </span>
                                                <a href="#">
                                                <h4>{{$event->title}}</h4>
                                                </a>
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn addToCartFromThumnail" href="#" >
                                                    View Event
                                                    </a>
                                                </div>    
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="section__title">
                        <h3 class="mb_40" style="color: #000; font-size: 40px;">Coming Soons</h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
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
