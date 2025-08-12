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
    <section class="pricing_part section_padding bg-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10 mb_50">
                    <div class="section__title">
                        <h3 class="mb_40">Organizer Packages</h3>
                        {{-- @php echo $content->pricingDescription; @endphp --}}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                {{-- <div class="col-lg-12 d-none">
                <div class="price_truggle d-flex">
                    <p>{{__('defaultTheme.monthly')}}</p>
                    <label class="switch-toggle outer">
                        <input id="pricingToggle" type="checkbox" />
                        <div></div>
                    </label>
                    <p class="pl-18">{{__('defaultTheme.yearly')}}</p>
                </div>
            </div> --}}
                
                <div class="col-lg-4">
                    <div class="single_pricing_part h-100">
                        <div class="price_icon">
                            <svg width="56" height="53" viewBox="0 0 56 53" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M26.0979 1.8541C26.6966 0.0114833 29.3034 0.0114799 29.9021 1.8541L34.9599 17.4205C35.2277 18.2445 35.9956 18.8024 36.862 18.8024H53.2295C55.1669 18.8024 55.9725 21.2817 54.4051 22.4205L41.1635 32.041C40.4625 32.5503 40.1692 33.453 40.437 34.2771L45.4948 49.8435C46.0935 51.6861 43.9845 53.2183 42.4171 52.0795L29.1756 42.459C28.4746 41.9497 27.5254 41.9497 26.8244 42.459L13.5829 52.0795C12.0155 53.2183 9.9065 51.6861 10.5052 49.8435L15.563 34.2771C15.8308 33.453 15.5375 32.5503 14.8365 32.041L1.59493 22.4205C0.0275064 21.2817 0.833055 18.8024 2.7705 18.8024H19.138C20.0044 18.8024 20.7723 18.2445 21.0401 17.4205L26.0979 1.8541Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <div class="pricing_header pb-0">
                            <h5>Premium Plan / monthly or yearly</h5>
                            {{-- <p>For a limited time</p> --}}
                        </div>
                        <div class="w-100">
                            <img src="{{ asset('public/images/packages-02-img.webp') }}"
                                class="img-fluid package-image mb-0" alt="package image">
                        </div>
                        <div class="monthly_price_div mb-40">
                            <h2>$100/month or $1000/year</h2>
                        </div>
                        <ul class="mb-5 package-list-wrapper">
                            <li>Create an account as a business owner</li>
                            <li>Create art events</li>
                            <li>Use the website to promote and conduct ticket sales</li>
                            <li>Connect with local artists & message them to fill their events</li>
                            <li>Unlimited access to platform for hosting events and artist connections</li>
                            <li>Data analytics</li>
                        </ul>
                        {{-- <a class="amaz_primary_btn py-2 rounded-pill mb_20 text-center justify-content-center cursor_pointer select_btn_price"
                            data-id='{{ $item->id }}'>{{ __('defaultTheme.choose plan') }}</a> --}}
                        <a href="merchant-register-step-3?id=2&type="
                            class="amaz_primary_btn rounded-pill choose-plan-btn mb_20 text-center justify-content-center cursor_pointer select_btn_price">
                            Choose Plan
                        </a>

                    </div>
                </div>
                <form class="price_subscription_add d-none"
                    action="{{ route('frontend.merchant-register-subscription-type') }}" method="get">

                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="type" name="type" value="">
                </form>
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
