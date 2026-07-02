@once
    @push('styles')
        <style>
            .id-profile-tiers .new_pricing_card {
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
            .id-profile-tiers .new_pricing_card:hover {
                box-shadow: 0 10px 40px rgba(43, 54, 228, 0.1);
            }
            .id-profile-tiers .plan_title {
                font-size: 28px;
                color: black;
                font-weight: 500;
                margin-bottom: 0;
                line-height: 1.2;
            }
            .id-profile-tiers .big_price {
                font-size: 56px;
                color: black;
                font-weight: 500;
                line-height: 1;
                margin-right: 10px;
            }
            .id-profile-tiers .price_meta {
                font-size: 14px;
                line-height: 1.3;
                color: #000;
                font-weight: 500;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .id-profile-tiers .billed_yearly {
                font-size: 15px;
                color: #000;
                margin-top: 8px;
                font-weight: 400;
            }
            .id-profile-tiers .cta_btn {
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
                cursor: pointer;
            }
            .id-profile-tiers .cta_btn:hover {
                background-color: #1F1F1F;
                color: #fff !important;
            }
            .id-profile-tiers .feature_divider {
                border-top: 1px solid #eee;
                margin-bottom: 25px;
            }
            .id-profile-tiers .feature_list {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .id-profile-tiers .feature_list li {
                font-size: 14px;
                color: #333;
                margin-bottom: 12px;
                display: flex;
                align-items: flex-start;
            }
            .id-profile-tiers .feature_list li i {
                margin-right: 12px;
                color: #888;
                font-size: 14px;
                margin-top: 4px;
            }
            @media (max-width: 767px) {
                .id-profile-tiers .new_pricing_card {
                    margin-bottom: 40px;
                }
                .id-profile-tiers .big_price {
                    font-size: 40px;
                }
                .id-profile-tiers .plan_title {
                    font-size: 25px;
                }
            }
        </style>
    @endpush
@endonce

@php
    $isInteriorDesigner = auth()->check() && auth()->user()->role->type === 'interior_designer';
    $isLoggedIn = auth()->check();
@endphp

<section class="id-profile-tiers how-partner-section py-50 py-lg-100 overflow-visible" id="profile-tiers">
    <div class="container">
        <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;">
            Interior Designers <br> Profile Tiers
        </h2>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb_30">
                <div class="new_pricing_card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="plan_title">Bronze</h3>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price">10%</span>
                            <div class="price_meta">
                                <span>Discount</span>
                            </div>
                        </div>
                        <div class="billed_yearly">YTD Purchases: $0 – $50,000</div>
                    </div>
                    @if($isInteriorDesigner)
                        <a href="{{ url('/profile/dashboard') }}" class="cta_btn">Go to Dashboard</a>
                    @elseif($isLoggedIn)
                        <button type="button" class="cta_btn js-interior-designer-signup">Sign up</button>
                    @else
                        <a href="{{ route('interiorregister') }}" class="cta_btn">Sign up</a>
                    @endif
                    <div class="feature_divider"></div>
                    <ul class="feature_list">
                        <li><i class="fas fa-check"></i> 10% Discount on all items</li>
                        <li><i class="fas fa-shopping-cart"></i> For purchases up to $50,000</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb_30">
                <div class="new_pricing_card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="plan_title">Silver</h3>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price">15%</span>
                            <div class="price_meta">
                                <span>Discount</span>
                            </div>
                        </div>
                        <div class="billed_yearly">YTD Purchases: $50,000 - $100,000</div>
                    </div>
                    @if($isInteriorDesigner)
                        <a href="{{ url('/profile/dashboard') }}" class="cta_btn">Go to Dashboard</a>
                    @elseif($isLoggedIn)
                        <button type="button" class="cta_btn js-interior-designer-signup">Sign up</button>
                    @else
                        <a href="{{ route('interiorregister') }}" class="cta_btn">Sign up</a>
                    @endif
                    <div class="feature_divider"></div>
                    <ul class="feature_list">
                        <li><i class="fas fa-check"></i> 15% Discount on all items</li>
                        <li><i class="fas fa-shopping-cart"></i> For purchases between $50k and $100k</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb_30">
                <div class="new_pricing_card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="plan_title">Gold</h3>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price">20%</span>
                            <div class="price_meta">
                                <span>Discount</span>
                            </div>
                        </div>
                        <div class="billed_yearly">YTD Purchases: $100,000+</div>
                    </div>
                    @if($isInteriorDesigner)
                        <a href="{{ url('/profile/dashboard') }}" class="cta_btn">Go to Dashboard</a>
                    @elseif($isLoggedIn)
                        <button type="button" class="cta_btn js-interior-designer-signup">Sign up</button>
                    @else
                        <a href="{{ route('interiorregister') }}" class="cta_btn">Sign up</a>
                    @endif
                    <div class="feature_divider"></div>
                    <ul class="feature_list">
                        <li><i class="fas fa-check"></i> 20% Discount on all items</li>
                        <li><i class="fas fa-shopping-cart"></i> For purchases over $100,000</li>
                        <li><i class="fas fa-star"></i> Priority Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@if($isLoggedIn && ! $isInteriorDesigner)
    <form id="interior-designer-register-prepare-form" action="{{ route('interior-designer.register.prepare') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div class="modal fade login_modal about_modal" id="interiorDesignerSignupModal" tabindex="-1" role="dialog" aria-labelledby="interiorDesignerSignupModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div data-bs-dismiss="modal" data-dismiss="modal" class="close_modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </div>
                    <div class="infix_login_area p-0">
                        <div class="login_area_inner">
                            <h3 class="sign_up_text mb_20 fs-30 text-center" id="interiorDesignerSignupModalLabel">Already Logged In</h3>
                            <!-- <p class="primary-font mb_15">
                                You are currently signed in as
                                <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                                ({{ auth()->user()->email }}).
                            </p> -->
                            <p class="primary-font mb_30 mute_text">
                                To register as an Interior Designer, you need to log out of your current account first. And you will be taken to the registration form.
                            </p>
                            <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-3">
                                <button type="button" class="amaz_primary_btn3 style2 w-100 text-center text-uppercase justify-content-center" data-bs-dismiss="modal" data-dismiss="modal">{{ __('common.cancel') }}</button>
                                <button type="button" class="home10_primary_btn2 w-100 text-center f_w_700 text-uppercase" id="interiorDesignerSignupConfirm">Log Out &amp; Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@once
    @push('scripts')
        <script>
            (function ($) {
                'use strict';

                function showInteriorDesignerSignupModal(modalEl) {
                    if (!modalEl) {
                        return false;
                    }

                    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                        return true;
                    }

                    if (typeof $ !== 'undefined' && typeof $.fn.modal === 'function') {
                        $(modalEl).modal({ backdrop: 'static', keyboard: false });
                        $(modalEl).modal('show');
                        return true;
                    }

                    return false;
                }

                $(document).ready(function () {
                    var modalEl = document.getElementById('interiorDesignerSignupModal');
                    var confirmBtn = document.getElementById('interiorDesignerSignupConfirm');
                    var prepareForm = document.getElementById('interior-designer-register-prepare-form');

                    $(document).on('click', '.js-interior-designer-signup', function (event) {
                        event.preventDefault();

                        if (showInteriorDesignerSignupModal(modalEl)) {
                            return;
                        }

                        if (
                            prepareForm &&
                            window.confirm('You are already logged in. Log out and continue to Interior Designer registration?')
                        ) {
                            prepareForm.submit();
                        }
                    });

                    if (confirmBtn && prepareForm) {
                        confirmBtn.addEventListener('click', function () {
                            confirmBtn.disabled = true;
                            confirmBtn.textContent = 'Logging out...';
                            prepareForm.submit();
                        });
                    }
                });
            })(jQuery);
        </script>
    @endpush
@endonce
