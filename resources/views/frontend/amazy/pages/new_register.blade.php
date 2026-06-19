@extends(theme('layouts.app'))

@section('title')
{{ __('Sign Up') }}
@endsection

@push('styles')
<style>
    .account-signup-sec .account-signup-slider-wrap {
        position: relative;
        padding: 0 48px;
    }

    .account-signup-sec .account-signup-slider .account-signup-slide {
        height: 100%;
    }

    .account-signup-sec .account-signup-slider .owl-stage {
        display: flex;
        align-items: stretch;
    }

    .account-signup-sec .account-signup-slider .owl-item {
        display: flex;
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav {
        display: none !important;
    }

    .account-signup-sec .account-signup-slider__nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #000;
        color: #fff;
        font-size: 16px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        margin: 0;
        z-index: 10;
        cursor: pointer;
        transition: background 0.25s ease, transform 0.2s ease;
    }

    .account-signup-sec .account-signup-slider__nav:hover {
        background: #1a1a1a;
        transform: translateY(-50%) scale(1.05);
    }

    .account-signup-sec .account-signup-slider__nav--prev {
        left: 0;
    }

    .account-signup-sec .account-signup-slider__nav--next {
        right: 0;
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-dots {
        margin-top: 28px;
        text-align: center;
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-dot span {
        width: 10px;
        height: 10px;
        margin: 4px 6px;
        background: rgba(0, 0, 0, 0.2);
        transition: background 0.25s ease, transform 0.25s ease;
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-dot.active span,
    .account-signup-sec .account-signup-slider.owl-carousel .owl-dot:hover span {
        background: #000;
        transform: scale(1.1);
    }

    @media (max-width: 767.98px) {
        .account-signup-sec .account-signup-slider-wrap {
            padding: 0 40px;
        }

        .account-signup-sec .account-signup-slider__nav {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
<section class="account-signup-sec">
    <div class="container">
        <div class="account-signup-slider-wrap" data-aos="fade-up" data-aos-duration="700">
            <button type="button" class="account-signup-slider__nav account-signup-slider__nav--prev" aria-label="Previous slide">
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>
            <button type="button" class="account-signup-slider__nav account-signup-slider__nav--next" aria-label="Next slide">
                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            </button>
            <div class="account-signup-slider owl-carousel owl-theme">
                <!-- <div class="account-signup-slide d-flex">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/buyer.jpg"
                                alt=""
                                width="600"
                                height="450"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="account-signup-card__body">
                            <p class="account-signup-card__text primary-font mb-0">Create your buyer account to explore products, connect with sellers, and start purchasing.</p>
                            <div class="account-signup-card__action">
                                <a href="{{ route('frontend.buyer.signup') }}" class="account-signup-btn primary-font">
                                    Become a Buyer
                                    <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div> -->
                <div class="d-flex">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/interior_designer.jpg"
                                alt=""
                                width="600"
                                height="450"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="account-signup-card__body">
                            <p class="account-signup-card__text primary-font mb-0">Create your Interior designers account transform spaces by planning layouts.</p>
                            <div class="account-signup-card__action">
                                <a href="{{ URL('/interior-designer-register') }}" class="account-signup-btn primary-font">
                                Partner as an Interior Designer
                                    <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="d-flex">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/buyer.jpg"
                                alt=""
                                width="600"
                                height="450"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="account-signup-card__body">
                            <p class="account-signup-card__text primary-font mb-0">Create your buyer account to explore products, connect with sellers, and start purchasing.</p>
                            <div class="account-signup-card__action">
                                <a href="{{ URL('/register') }}" class="account-signup-btn primary-font">
                                    Create Buyer Profile
                                    <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="account-signup-slide d-flex">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/artist.png"
                                alt=""
                                width="600"
                                height="450"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="account-signup-card__body">
                            <p class="account-signup-card__text primary-font mb-0">Create your Artist account to upload your artwork and start selling your paintings today.</p>
                            <div class="account-signup-card__action">
                                <a href="{{ route('frontend.merchant-register','subscription') }}" class="account-signup-btn primary-font">
                                    Partner as an Artist
                                    <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="account-signup-slide d-flex">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/eventss.jpg"
                                alt=""
                                width="600"
                                height="450"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="account-signup-card__body">
                            <p class="account-signup-card__text primary-font mb-0">Create your Organizer account to start hosting and managing events today.</p>
                            <div class="account-signup-card__action">
                                <a href="{{ route('frontend.event-organiser-register','subscription') }}" class="account-signup-btn primary-font">
                                    Partner as a Location
                                    <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="account-signup-slide d-flex">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/eventss.jpg"
                                alt=""
                                width="600"
                                height="450"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="account-signup-card__body">
                            <p class="account-signup-card__text primary-font mb-0">Create your Art Gallery account to start selling your artwork and start selling your paintings today.</p>
                            <div class="account-signup-card__action">
                                <a href="{{ route('frontend.art-gallery-register','subscription') }}" class="account-signup-btn primary-font">
                                    Partner as an Art Gallery
                                    <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var $accountSignupSlider = $('.account-signup-slider');

        if (!$accountSignupSlider.length || typeof $.fn.owlCarousel !== 'function') {
            return;
        }

        $accountSignupSlider.owlCarousel({
            loop: true,
            margin: 24,
            nav: false,
            dots: true,
            autoplay: false,
            autoplayHoverPause: true,
            smartSpeed: 500,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });

        $('.account-signup-slider__nav--prev').on('click', function() {
            $accountSignupSlider.trigger('prev.owl.carousel');
        });

        $('.account-signup-slider__nav--next').on('click', function() {
            $accountSignupSlider.trigger('next.owl.carousel');
        });

        $accountSignupSlider.on('initialized.owl.carousel refreshed.owl.carousel', function() {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });
    });
</script>
@endpush