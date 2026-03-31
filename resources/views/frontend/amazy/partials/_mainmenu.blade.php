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
    @media (max-width: 991px){
        .mobile_menu {
            top: 54px;
        }
    }
    @media (max-width: 767.98px){
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
                                                    {{$lang->native}}</option>
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
