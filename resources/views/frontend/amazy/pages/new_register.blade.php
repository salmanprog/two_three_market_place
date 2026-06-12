@extends(theme('layouts.app'))

@section('title')
    {{ __('Sign Up') }}
@endsection

@section('content')
    <section class="account-signup-sec">
        <div class="container">
            <div class="row account-signup-grid justify-content-center">
                <div class="col-12 col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="80">
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
                </div>

                <div class="col-12 col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="140">
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

                <div class="col-12 col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
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
                <div class="col-12 col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
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
    </section>
@endsection
