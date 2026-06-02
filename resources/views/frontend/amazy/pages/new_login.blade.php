@extends(theme('layouts.app'))

@section('title')
    {{ __('Sign In') }}
@endsection

@section('content')
    <section class="account-signup-sec">
        <div class="container">
            <div class="row account-signup-grid justify-content-center">
                <div class="col-12 col-sm-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="80">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/buyer_login.jfif"
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

                <div class="col-12 col-sm-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="140">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/artist_login.jfif"
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

                <div class="col-12 col-sm-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
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

                <div class="col-12 col-sm-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="260">
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
                <div class="col-12 col-sm-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="260">
                    <article class="account-signup-card w-100">
                        <div class="account-signup-card__media">
                            <img
                                src="{{ asset('') }}Modules/PageBuilder/Resources/assets/keditor/snippets/img/art_gallery_login.jpg"
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
    </section>
@endsection
