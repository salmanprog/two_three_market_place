@extends('frontend.amazy.layouts.app')

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
<section class="pricing_part section_padding">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6 col-md-10 mb_50">
                <div class="section__title">
                    <h3 class="mb_40">Art Galleries</h3>
                    Turn your business into an art gallery—at cost.
                    This is for prospects considering using us to create a physical gallery space out of their business:
                </div>
            </div>
        </div>
        <div class="row justify-content-center" >

          
            <!-- Basic Yearly -->
            <div class="col-lg-6 col-md-6 mb_30">
                <div class="new_pricing_card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                            <h2 class="plan_title">Basic Yearly</h2>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price">$25.00</span>
                            <div class="price_meta">
                                <span>Painting</span>
                                <span>{{__('defaultTheme.per year')}}</span>
                            </div>
                        </div>
                    </div>
                        
                    <a class="cta_btn select_btn_price cursor_pointer" data-id="4">
                    Choose Plan
                    </a>

                    <div class="feature_divider"></div>

                    <ul class="feature_list">
                        <li><i class="fas fa-check"></i> Art installation with labels.</li>
                        <li><i class="fas fa-check"></i> Art sales facilitation</li>
                        <li><i class="fas fa-check"></i> Receive a commission for art sold</li>
                    </ul>
                </div>
            </div>

            <!-- Premium Yearly -->
            <div class="col-lg-6 col-md-6 mb_30">
                <div class="new_pricing_card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                            <h2 class="plan_title">Premium Yearly</h2>
                       
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price">$50.00</span>
                            <div class="price_meta">
                                <span>Painting</span>
                                <span>{{__('defaultTheme.per year')}}</span>
                            </div>
                        </div>
                    </div>

                    <a class="cta_btn select_btn_price cursor_pointer" data-id="5">
                    Choose Plan
                    </a>

                    <div class="feature_divider"></div>

                    <ul class="feature_list">
                        <li><i class="fas fa-check"></i> All services in the Basic Tier</li>
                        <li><i class="fas fa-check"></i> Seasonal rotations of the artwork in your business, curated to meet your desired aesthetic.</li>
                        <li><i class="fas fa-check"></i> Access to our online platform to host and promote art shows and other events.</li>
                        <li><i class="fas fa-check"></i> Business advertisements & features on social media, as well as marketing campaigns.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form class="price_subscription_add d-none"
        action="{{ route('frontend.merchant-register-subscription-type') }}" method="get">
        <input type="hidden" id="id" name="id" value="">
        <input type="hidden" id="type" name="type" value="monthly">
    </form>
</section>
<section id="contact_section" class="contact-us-sec pb-100">
    <div class="container">
        <div class="row align-items-center row-gap-40">
            <div class="col-12 col-md-12">
                <h2 class="secondry-font text-start fs-55 fw-400 mb-20">Contact Us</h2>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('frontend.contact.us') }}" method="POST">
                    @csrf
                    <div class="row row-gap-20">
                        <div class="col-12 col-sm-6">
                            <input type="text"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                placeholder="First Name"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('first_name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <input type="text"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                placeholder="Last Name"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('last_name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('email')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <input type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Phone"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('phone')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">    
                            <textarea name="message"
                                    rows="5"
                                    placeholder="Message"
                                    class="primary-font border-gray-light fs-16 px-16 py-18 text-area w-100">{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="position-relative w-100">
                                <select name="service"
                                        id="service"
                                        class="primary-font border-gray-light fs-16 px-16 py-18 input-field">
                                    <option disabled selected>Which art are you interested in?</option>
                                    <option value="$25/painting/year" {{ old('service') == '$25/painting/year' ? 'selected' : '' }}>$25/painting/year</option>
                                    <option value="$50/painting/year" {{ old('service') == '$50/painting/year' ? 'selected' : '' }}>$50/painting/year</option>
                                </select>
                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-17 text-black me-3 pe-none"></i>
                            </div>
                            @error('service')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit"
                                    class="btn btn-primary radius-60 bg-black text-white primary-font py-17 px-30 fs-16">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
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
