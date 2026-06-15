@extends(theme('layouts.app'))

@section('title')
    {{ __('Sign In') }}
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

    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-prev,
    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #000 !important;
        color: #fff !important;
        font-size: 16px;
        line-height: 44px;
        margin: 0;
        opacity: 1;
        transition: background 0.25s ease, transform 0.2s ease;
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-prev:hover,
    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-next:hover {
        background: #1a1a1a !important;
        transform: translateY(-50%) scale(1.05);
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-prev {
        left: 0;
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-next {
        right: 0;
    }

    .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button span {
        display: none;
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

        .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-prev,
        .account-signup-sec .account-signup-slider.owl-carousel .owl-nav button.owl-next {
            width: 36px;
            height: 36px;
            line-height: 36px;
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
    <section class="account-signup-sec">
        <div class="container">
            <div class="account-signup-slider-wrap" data-aos="fade-up" data-aos-duration="700">
                <div class="account-signup-slider owl-carousel owl-theme">
                    <div class="account-signup-slide d-flex">
                        <article class="account-signup-card w-100">
                            <div class="account-signup-card__media">
                                <img
                                    src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/buyer_login.png"
                                    alt=""
                                    width="600"
                                    height="450"
                                    loading="lazy"
                                    decoding="async">
                            </div>
                            <div class="account-signup-card__body">
                                <p class="account-signup-card__text primary-font mb-0">Create your buyer account to explore products, connect with sellers, and start purchasing.</p>
                                <div class="account-signup-card__action">
                                    <a href="{{ URL('/login') }}" class="account-signup-btn primary-font">
                                        Login as Buyer
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
                                    src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/artist_login.png"
                                    alt=""
                                    width="600"
                                    height="450"
                                    loading="lazy"
                                    decoding="async">
                            </div>
                            <div class="account-signup-card__body">
                                <p class="account-signup-card__text primary-font mb-0">Create your Artist account to upload your artwork and start selling your paintings today.</p>
                                <div class="account-signup-card__action">
                                    <a href="{{ route('seller.login') }}" class="account-signup-btn primary-font">
                                        Login as Artist
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
                                    src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/event_login.jpg"
                                    alt=""
                                    width="600"
                                    height="450"
                                    loading="lazy"
                                    decoding="async">
                            </div>
                            <div class="account-signup-card__body">
                                <p class="account-signup-card__text primary-font mb-0">Create your Organizer account to start hosting and managing events today.</p>
                                <div class="account-signup-card__action">
                                    <a href="{{ route('event.login') }}" class="account-signup-btn primary-font">
                                        Login as Location
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
                                    <a href="{{ URL('/login') }}" class="account-signup-btn primary-font">
                                        Login as Interior Designers
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
                                    <a href="{{ route('art-gallery.login') }}" class="account-signup-btn primary-font">
                                        Login as Art Gallery
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
    $(document).ready(function () {
        var $accountSignupSlider = $('.account-signup-slider');

        if (!$accountSignupSlider.length || typeof $.fn.owlCarousel !== 'function') {
            return;
        }

        $accountSignupSlider.owlCarousel({
            loop: true,
            margin: 24,
            nav: true,
            dots: true,
            autoplay: false,
            autoplayHoverPause: true,
            smartSpeed: 500,
            navText: [
                '<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>',
                '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 }
            }
        });

        $accountSignupSlider.on('initialized.owl.carousel refreshed.owl.carousel', function () {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });
    });
</script>
@endpush
