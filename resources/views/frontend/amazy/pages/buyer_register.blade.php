@extends(theme('layouts.app'))

@section('title')
    {{ __('Buyer registration') }}
@endsection

@section('content')
    <section class="account-signup-sec">
        <div class="container">
            <div class="row account-signup-grid justify-content-center">
                <div class="col-12 col-sm-6 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="80">
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

                <div class="col-12 col-sm-6 d-flex" data-aos="fade-up" data-aos-duration="700" data-aos-delay="140">
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
                                    Create Interior Designer Profile
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
