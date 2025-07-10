@extends('frontend.amazy.layouts.app')
@section('title')
{{ __('common.merchants') }}
@endsection
<style>
    .seller_shop_logo,
    .seller_shop_logo img {
        width: 100%;
    }

    .seller_shop_logo {
        margin-bottom: 20px;
    }

    .seller_shop_logo img {
        object-fit: cover;
        max-width: 350px;
        display: flex;
        justify-content: center;
        margin: 0 auto;
        min-height: 350px;
        border-radius: 10px;
    }

    .seller_shop_info p span {
        color: #000;
    }

    .seller_shop_info p {
        font-size: 17px;
        font-weight: 500;
        color: #666;
        margin-bottom: 10px;
    }

    .seller_shop_info .border-bottom {
        border-bottom: 1px solid #666;
        margin-bottom: 10px;
    }

    .seller_shop_details {
        transition: all 0.3s ease;
    }

    .seller_shop_box_wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        background-color: #e1e1e9;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        cursor: pointer;

    }

    .seller_shop_box_hover {
        display: none;
    }

    .seller_shop_box_wrapper:hover .seller_shop_box_hover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #0000005c;
    }

    .seller_shop_box_hover i {
        font-size: 35px;
    }
    .amazy_section_padding {
        padding-bottom: 40px;
    }
    header.amazcartui_header .header_area .main_header_area {
        background-color: transparent !important;
    }
    header.amazcartui_header .header_area .main_header_area .main_menu {
        background: var(--menu_color);
        padding: 0 15px;
    }
    
   
</style>
@section('content')
<div class="amazy_section_padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title d-flex align-items-center justify-content-between mb_30">
                    <h3>{{ __('All Artists') }}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($sellers as $seller)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="seller_shop_box mb_30">
                    <!-- <div class="seller_shop_banner">
                        @if($seller->SellerAccount && $seller->SellerAccount->banner)
                            <img src="{{ showImage($seller->SellerAccount->banner) }}" alt="{{ $seller->first_name }}" title="{{ $seller->first_name }}">
                        @else
                            <img src="{{ showImage('frontend/default/img/default_shop_banner.png') }}" alt="{{ $seller->first_name }}" title="{{ $seller->first_name }}">
                        @endif
                    </div> -->
                    <a href="{{ route('frontend.seller', $seller->slug ?? base64_encode($seller->id)) }}">
                        <div class="seller_shop_box_wrapper">
                            <div class="seller_shop_details">
                                <div class="seller_shop_logo">
                                    <img src="{{ showImage($seller->photo ?? 'frontend/default/img/avatar.jpg') }}"
                                        alt="{{ $seller->first_name }}"
                                        title="{{ $seller->first_name }}">
                                </div>
                                <div class="seller_shop_info">
                                    <!-- <div class="d-flex align-items-center justify-content-between"> -->
                                    <p><span>Seller Name:</span> {{ $seller->first_name }} {{ $seller->last_name }}</h4>
                                    <p><span>Shop Name:</span> {{ $seller->SellerAccount->seller_shop_display_name }}</p>
                                    <!-- </div> -->
                                    <div class="border-bottom"></div>
                                    <p><span>Address:</span> {{ $seller->SellerBusinessInformation->business_address1 }}</p>
                                    <!-- @if(!empty($seller->SellerAccount?->seller_shop_display_name))
                                <p>{{ $seller->SellerAccount->seller_shop_display_name }}</p>
                                @endif -->
                                </div>
                            </div>
                            <div class="seller_shop_box_hover">
                                <span class="text-white"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <div class="pagination_part">
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection