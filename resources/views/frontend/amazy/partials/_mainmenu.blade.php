<style>
    .header-auth-wrap {
        gap: 0.5rem;
    }

    .header-auth-pills {
        gap: 0.5rem;
    }

    .header-pill-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1.2rem;
        border-radius: 9999px;
        font-size: 0.9375rem;
        font-weight: 500;
        line-height: 1.2;
        text-decoration: none !important;
        transition: opacity 0.2s ease, background-color 0.2s ease, color 0.2s ease;
        white-space: nowrap;
    }

    .header-pill-btn:hover {
        opacity: 0.92;
    }

    .header-pill-btn--outline {
        background: #fff;
        color: #000 !important;
        border: 1px solid #000;
    }

    .header-pill-btn--outline:hover {
        background: #f7f7f7;
        color: #000 !important;
    }

    .header-pill-btn--solid {
        background: #000;
        color: #fff !important;
        border: 1px solid #000;
    }

    .header-pill-btn--solid:hover {
        background: #1a1a1a;
        color: #fff !important;
    }

    @media (max-width: 575.98px) {
        .header-pill-btn {
            padding: 0.4rem 0.75rem;
            font-size: 0.8125rem;
        }
    }

    @media (max-width: 991px) {
        .mobile_menu {
            top: 54px;
        }
    }

    @media (max-width: 767.98px) {
        header.amazcartui_header .header_area .header_top_area .header__wrapper .header__left {
            justify-content: flex-start;
            margin-left: 0;
        }

        .mobile_menu {
            top: 46px;
        }
    }
</style>

<div class="header_top_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__wrapper">
                    <!-- header__left__start  -->
                    <div class="header__left d-flex align-items-center">
                        <div class="logo_img" data-aos="fade-down" data-aos-duration="1500" data-aos-delay="0">
                            <a href="{{ url('/') }}">
                                <img src="{{ showImage(app('general_setting')->logo) }}" alt="{{ app('general_setting')->company_name }}" title="{{ app('general_setting')->company_name }}">
                            </a>
                        </div>
                    </div>
                    <!-- header__left__end  -->
                    <div class="header_middle d-flex">
                        @include('frontend.amazy.partials._mega_menu')


                    </div>
                    <!-- header__right_start  -->
                    <div class="header_top_area_right">
                        <div class="wish_cart">
                            <div class="single_wishcart_lists d-flex align-items-center flex-nowrap header-auth-wrap" data-aos="fade-down" data-aos-duration="1500" data-aos-delay="1000">
                                @guest
                                <div class="header-auth-pills d-flex align-items-center flex-nowrap">
                                    <a href="{{ route('frontend.account.signin') }}" class="header-pill-btn header-pill-btn--outline primary-font">{{ __('defaultTheme.login') }}</a>
                                    <a href="{{ route('frontend.account.signup') }}" class="header-pill-btn header-pill-btn--solid primary-font">{{ __('defaultTheme.register') }}</a>
                                </div>
                                @else
                                <div class="header-auth-pills d-flex align-items-center flex-nowrap">
                                    @if (auth()->check() && auth()->user()->role->type == "superadmin" || auth()->check() && auth()->user()->role->type == "admin" || auth()->check() && auth()->user()->role->type == "staff")
                                    <a href="{{ route('admin.dashboard') }}" class="header-pill-btn header-pill-btn--outline primary-font">{{ __('common.dashboard') }}</a>
                                    @elseif (auth()->check() && auth()->user()->role->type == "seller" && isModuleActive('MultiVendor'))
                                    <a href="{{ route('seller.dashboard') }}" class="header-pill-btn header-pill-btn--outline primary-font">{{ __('common.dashboard') }}</a>
                                    @elseif (auth()->check() && auth()->user()->role->type == "affiliate")
                                    <a href="{{ route('affiliate.my_affiliate.index') }}" class="header-pill-btn header-pill-btn--outline primary-font">{{ __('common.dashboard') }}</a>
                                    @else
                                    <a href="{{ route('frontend.dashboard') }}" class="header-pill-btn header-pill-btn--outline primary-font">{{ __('common.dashboard') }}</a>
                                    @endif
                                    <a href="{{ route('logout') }}" class="header-pill-btn header-pill-btn--solid primary-font log_out">{{ __('defaultTheme.log_out') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endguest
                            </div>
                        </div>
                        <div class="single_top_lists position-relative me-3 d-flex align-items-center shoping_language d-lg-none d-inline-flex">
                            <div class="">
                                <div class="language_toggle_btn gj-cursor-pointer d-flex align-items-center gap_10 ">
                                    <span>{{strtoupper($locale)}}</span>
                                    <span class="vertical_line style2 d-none d-md-block"></span>
                                    <span>{{strtoupper($currency_code)}}</span>
                                    <i class="ti-angle-down"></i>
                                </div>
                                <div class="language_toggle_box position-absolute top-100 end-0 bg-white">
                                    <form action="{{route('frontend.locale')}}" method="POST">
                                        @csrf
                                        <div class="lag_select">
                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block">{{ __('defaultTheme.language') }}</span>
                                            <select class="amaz_select6 wide mb_20" name="lang">
                                                @foreach($langs as $key => $lang)
                                                <option {{ $locale==$lang->code?'selected':'' }} value="{{$lang->code}}">
                                                    {{$lang->native}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="lag_select">
                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block">{{ __('defaultTheme.currency') }}</span>
                                            <select class="amaz_select6 wide" name="currency">
                                                @foreach($currencies as $key => $item)
                                                <option {{$currency_code==$item->code?'selected':'' }}
                                                    value="{{$item->id}}">
                                                    ({{$item->symbol}}) {{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="amaz_primary_btn style3 save_btn">{{ __('defaultTheme.save_change') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="wish_cart_mobile">
                            <div class="home6_search_toggle ">
                                <i class="ti-search"></i>
                            </div>
                        </div> -->
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                    <!-- header__right_end  -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  art-modal" id="art_modal" tabindex="-1" role="dialog" aria-labelledby="art_modal" aria-hidden="true"
tabindex="-1"
     data-bs-backdrop="static"
     data-bs-keyboard="false"

>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div data-bs-dismiss="modal" class="close_modal d-flex justify-content-end">
                    <i class="ti-close"></i>
                </div>

            </div>
            <section class="filter-artist-sec art-modal-content overflow-visible">
                <div class="container">
                    <div class="premium-luxury-panel" data-aos="fade-up" data-aos-duration="1200">
                        <h2 class="luxury-heading secondry-font">Filter Arts</h2>

                        <form action="{{ route('frontend.searchshop') }}" method="GET">
                            <div class="row g-3 justify-content-center">
                                <!-- Compact Luxury Search Bar -->
                                <div class="col-6" data-aos="fade-up" data-aos-delay="100">
                                    <div class="search-compact-wrapper">
                                        <input type="text" name="search" class="primary-font compact-input" placeholder="Search by Artist Name or Theme..." value="{{ request('search') }}">
                                        <i class="fa-solid fa-magnifying-glass search-compact-icon"></i>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row g-3 g-lg-4">
                                        <!-- Location -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Region Name</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="location" id="location">
                                                    <option value="">Select Location</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Art Services -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Services</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="art_services">
                                                    <option value="">Select Art Services</option>
                                                    <option value="commissions">Commissions</option>
                                                    <option value="murals">Murals</option>
                                                    <option value="art_classes">Art Classes</option>
                                                    <option value="live_art">Live Art for Events</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Category</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="category">
                                                    <option value="">Select Category</option>
                                                    <option value="all">All</option>
                                                    <option value="paintings">Paintings</option>
                                                    <option value="drawing">Drawing</option>
                                                    <option value="mixed_media">Mixed Media</option>
                                                    <option value="sculpture">Sculpture</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Style -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Style</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="style">
                                                    <option value="">Select Style</option>
                                                    <option value="abstract_art">Abstract Art</option>
                                                    <option value="art_deco">Art Deco</option>
                                                    <option value="art_nouveau">Art Nouveau</option>
                                                    <option value="baroque">Baroque</option>
                                                    <option value="bauhaus">Bauhaus</option>
                                                    <option value="classicism">Classicism</option>
                                                    <option value="contemporary_art">Contemporary Art</option>
                                                    <option value="cubism">Cubism</option>
                                                    <option value="dadaism">Dadaism</option>
                                                    <option value="expressionism">Expressionism</option>
                                                    <option value="fauvism">Fauvism</option>
                                                    <option value="figurative">Figurative</option>
                                                    <option value="harlem_renaissance">Harlem Renaissance</option>
                                                    <option value="impressionism">Impressionism</option>
                                                    <option value="minimalism">Minimalism</option>
                                                    <option value="neoclassicism">Neoclassicism</option>
                                                    <option value="neo_impressionism">Neo-Impressionism</option>
                                                    <option value="pop_art">Pop Art</option>
                                                    <option value="post_impressionism">Post-Impressionism</option>
                                                    <option value="realism">Realism</option>
                                                    <option value="surrealism">Surrealism</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Subject Matter -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Subject Matter</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="subject">
                                                    <option value="">Select Subject</option>
                                                    <option value="abstract">Abstract</option>
                                                    <option value="landscape">Landscape</option>
                                                    <option value="pop_culture">Pop Culture</option>
                                                    <option value="people">People</option>
                                                    <option value="animal">Animal</option>
                                                    <option value="floral">Floral</option>
                                                    <option value="nature">Nature</option>
                                                    <option value="seascape">Seascape</option>
                                                    <option value="dogs">Dogs</option>
                                                    <option value="cats">Cats</option>
                                                    <option value="religious">Religious</option>
                                                    <option value="love">Love</option>
                                                    <option value="nude">Nude</option>
                                                    <option value="geometric">Geometric</option>
                                                    <option value="music">Music</option>
                                                    <option value="food_drinks">Food/Drinks</option>
                                                    <option value="medical">Medical</option>
                                                    <option value="sports">Sports</option>
                                                    <option value="men">Men</option>
                                                    <option value="women">Women</option>
                                                    <option value="buildings">Buildings</option>
                                                    <option value="cartoon">Cartoon</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Medium -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Medium</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="medium">
                                                    <option value="">Select Medium</option>
                                                    <option value="acrylic">Acrylic</option>
                                                    <option value="oil">Oil</option>
                                                    <option value="watercolor">Watercolor</option>
                                                    <option value="ink">Ink</option>
                                                    <option value="ceramic">Ceramic</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Material -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Product Material</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="material">
                                                    <option value="">Select Material</option>
                                                    <option value="canvas">Canvas</option>
                                                    <option value="paper">Paper</option>
                                                    <option value="wood">Wood</option>
                                                    <option value="metal">Metal</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Price Box -->
                                        <div class="col-12 col-md-6 col-lg-3 d-flex flex-column">
                                            <label class="minimal-label">Price Range</label>
                                            <div class="slider-compact-container primary-font">
                                                <input
                                                    type="range"
                                                    class="compact-range"
                                                    min="0"
                                                    max="5000"
                                                    step="100"
                                                    value="2500"
                                                    id="priceRange">
                                                <div class="d-flex justify-content-between align-items-center mt-1">
                                                    <span class="small fw-800 opacity-50 px-none">$0</span>
                                                    <p class="mb-0 fw-bold fs-12">
                                                        Up to: <span class="text-dark">$<span id="priceValue">2500</span></span>
                                                    </p>
                                                    <span class="small fw-800 opacity-50">$5k</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 justify-content-center mt-2">
                                        <!-- Size -->
                                        <div class="col-12 col-md-6 col-lg-4 d-flex flex-column">
                                            <label class="minimal-label">Item Dimensions</label>
                                            <div class="position-relative w-100">
                                                <select class="compact-select primary-font" name="size">
                                                    <option value="">Select Size</option>
                                                    <option value="small">Small (< 20in)</option>
                                                    <option value="med">Med (20-38in)</option>
                                                    <option value="large">Large (38-60in)</option>
                                                    <option value="xlarge">X Large (>60in)</option>
                                                </select>
                                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
                                            </div>
                                        </div>

                                        <!-- Color -->
                                        <div class="col-12 col-md-6 col-lg-4 d-flex flex-column">
                                            <label class="minimal-label">Palette Orientation</label>
                                            <div class="color-compact-wrapper">
                                                <input type="color" name="palette_color" value="#000000" class="compact-color-input" title="Custom color picker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-45">
                                <button type="submit" class="btn btn-compact-black primary-font">
                                    Find Artists <i class="fa-solid fa-arrow-right-long fs-12"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@push('scripts')

@endpush