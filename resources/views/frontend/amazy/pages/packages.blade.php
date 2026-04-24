@extends('frontend.amazy.layouts.app')

@section('title')
    {{ __('Packages') }}
@endsection

@push('styles')
    <style>
        .cursor_pointer{
            cursor: pointer!important;
        }

        .amaz_primary_btn.secondary{
            background: var(--text_color);
            border-color: var(--text_color);
        }
        .amaz_primary_btn.secondary:hover{
            background: var(--base_color);
            border-color: var(--base_color);
        }
        
        /* New Pricing Card Styles */
        .new_pricing_card {
            border: 1px solid gray;
            border-radius: 20px;
            padding: 30px;
            background: #fff;
            position: relative;
            height: 100%;
            text-align: left;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }
        .new_pricing_card:hover {
            box-shadow: 0 10px 40px rgba(43, 54, 228, 0.1);
        }
        .plan_title {
            font-size: 28px;
            color: black;
            font-weight: 500;
            margin-bottom: 0;
            line-height: 1.2;
        }
        .discount_badge {
            background: #ffeeb2;
            color: #333;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 4px;
            display: inline-block;
            white-space: nowrap;
        }
        .big_price {
            font-size: 56px;
            color: black;
            font-weight: 500;
            line-height: 1;
            margin-right: 10px;
        }
        .price_meta {
            font-size: 14px;
            line-height: 1.3;
            color: #000;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .billed_yearly {
            font-size: 15px;
            color: #000;
            margin-top: 8px;
            font-weight: 400;
        }
        .cta_btn {
            background-color: black;
            color: #fff !important;
            display: block;
            width: 100%;
            text-align: center;
            padding: 14px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            text-decoration: none;
            transition: background 0.3s;
            border: none;
        }
        .cta_btn:hover {
            background-color: #1F1F1F;
        }
        .feature_divider {
            border-top: 1px solid #eee; /* Light gray line */
            margin-bottom: 25px;
        }
        .feature_list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .feature_list li {
            font-size: 14px;
            color: #333;
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }
        .feature_list li i {
            margin-right: 12px;
            color: #888;
            font-size: 14px;
            margin-top: 4px;
        }

        @media (max-width: 767px) {
            .new_pricing_card {
                margin-bottom: 40px;
            }
            .big_price {
                font-size: 40px;
            }
            .plan_title {
                font-size: 25px;
            }
        }
    </style>
@endpush

@section('content')

<div class="new_user_section section_spacing6 pt-0">
    <div class="container">
        <div class="row justify-content-center py-30">
            <div class="col-lg-12">
                <h2 class="faq-heading text-center">Interior Designers <br> Profile Tiers</h2>
                
                <section class="pricing_part">
                    <div class="row justify-content-center">
                        <!-- Bronze Tier -->
                        <div class="col-lg-4 col-md-6 mb_30">
                            <div class="new_pricing_card">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                     <h2 class="plan_title">Bronze</h2>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="big_price">10%</span>
                                        <div class="price_meta">
                                            <span>Discount</span>
                                        </div>
                                    </div>
                                    <div class="billed_yearly">
                                         YTD Purchases: $0 – $50,000
                                    </div>
                                </div>

                                <a href="{{ route('interiorregister') }}" class="cta_btn cursor_pointer">
                                    Sign up
                                </a>

                                <div class="feature_divider"></div>

                                <ul class="feature_list">
                                    <li><i class="fas fa-check"></i> 10% Discount on all items</li>
                                    <li><i class="fas fa-shopping-cart"></i> For purchases up to $50,000</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Silver Tier -->
                        <div class="col-lg-4 col-md-6 mb_30">
                            <div class="new_pricing_card">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                     <h2 class="plan_title">Silver</h2>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="big_price">15%</span>
                                        <div class="price_meta">
                                            <span>Discount</span>
                                        </div>
                                    </div>
                                    <div class="billed_yearly">
                                         YTD Purchases: $50,000 - $100,000
                                    </div>
                                </div>

                                <a href="{{ route('interiorregister') }}" class="cta_btn cursor_pointer">
                                    Sign up
                                </a>
                                <div class="feature_divider"></div>

                                <ul class="feature_list">
                                    <li><i class="fas fa-check"></i> 15% Discount on all items</li>
                                    <li><i class="fas fa-shopping-cart"></i> For purchases between $50k and $100k</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Gold Tier -->
                        <div class="col-lg-4 col-md-6 mb_30">
                            <div class="new_pricing_card">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                     <h2 class="plan_title">Gold</h2>
                                    
                                </div>
                                
                                <div class="mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="big_price">20%</span>
                                        <div class="price_meta">
                                            <span>Discount</span>
                                        </div>
                                    </div>
                                    <div class="billed_yearly">
                                         YTD Purchases: $100,000+
                                    </div>
                                </div>

                                <a href="{{ route('interiorregister') }}" class="cta_btn cursor_pointer">
                                    Sign up
                                </a>

                                <div class="feature_divider"></div>

                                <ul class="feature_list">
                                    <li><i class="fas fa-check"></i> 20% Discount on all items</li>
                                    <li><i class="fas fa-shopping-cart"></i> For purchases over $100,000</li>
                                    <li><i class="fas fa-star"></i> Priority Support</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div>
    </div>
                <form class="price_subscription_add d-none"
                    action="{{ route('frontend.merchant-register-subscription-type') }}" method="get">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="type" name="type" value="monthly">
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
            $(document).on('click','.select_btn_price', function(){
                event.preventDefault();
                $('#id').val($(this).attr("data-id"));
                $('.price_subscription_add').submit();
            });
        });
    })(jQuery);
</script>
@endpush
