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
    .artist-galary-images img {
            max-height: 118px;
    object-fit: cover;
    border-radius: 10px;
    }
    .love-art-card img{
        height:300px;
    }
   
</style>
@section('content')
<div class="amazy_section_padding">
    <div class="container">
        <!-- <div class="row">
            <div class="col-12">
                <div class="section_title d-flex align-items-center justify-content-between mb_30">
                    <h3>{{ __('All Artists') }}</h3>
                </div>
            </div>
        </div> -->
        <section class="love-art-sec pb-40">
            <div class="container">
                <h2 class="fs-55 fw-700 text-center text-black mb-40 secondry-font text-center mx-auto max-w-1020px">artist and their work</h2>
                <!-- <p class="primary-font text-black fs-20 mb-30 mx-auto text-center max-w-540px">Each 23LD artist is unique in their own way just like art. Learn their story and their life's work</p> -->
                @if(count($sellers) > 0) 
                <div class="row row-gap-30">
                    @foreach($sellers as $seller)
                        
                            <!-- Artist 1: Devin Pughslsey -->
                            <div class="col-12 col-md-6">
                                <div class="love-art-card">
                                <div class="d-flex gap-5 mb-10">
                                    <div>
                                    <img src="{{ showImage($seller->avatar != null?$seller->avatar: 'frontend/default/img/avatar.png') }}" alt="" class="">
                                    </div>
                                   
                                    <div class="d-flex flex-column gap-4 artist-galary-images">
                                         @if(count($seller->seller_products) > 0)
                                            @foreach($seller->seller_products->take(3) as $product)
                                            <img src="{{ showImage($product->thum_img ?? 'frontend/amazy/img/6438ce493d38b.svg') }}" alt="{{ $product->product_name }}" title="{{ $product->product_name }}">
                                            @endforeach
                                        @endif
                                    <!-- <img src="{{ asset('public/uploads/all/6852ea5fd54b7.png') }}" alt="" class="">
                                    <img src="{{ asset('public/uploads/all/6852ea5fe1482.png') }}" alt="" class="">
                                    <img src="{{ asset('public/uploads/all/6852ea600077c.png') }}" alt="" class=""> -->
                                    </div>
                                </div>
                                <h4 class="secondry-font text-start fs-40 fw-700">{{ $seller->first_name }} {{ $seller->last_name }}</h4>
                                <p class="primary-font text-start mb-10">Portraits &amp; Wildlife</p>
                                <a href="{{ route('frontend.seller', $seller->slug ?? base64_encode($seller->id)) }}" class="btn btn-secondary">View Profile</a>
                                </div>
                            </div>
                            <!-- Artist 2: Robbie Lasky -->
                        
                    @endforeach
                    </div>
                @endif
                <!-- <div class="d-flex justify-content-center mt-45 mx-auto">
                <a href="#" class="btn bg-black text-white primary-font py-10 px-50">View All Artists</a>
                </div> -->
            </div>
            </section>
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