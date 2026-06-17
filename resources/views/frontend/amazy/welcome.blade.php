@extends('frontend.amazy.layouts.app')

@push('styles')
<style>
    .categories-sec .categories-slider-wrap {
        position: relative;
        padding: 0 48px;
    }

    .categories-sec .categories-slider .categories-slider-slide {
        width: 100%;
        height: 100%;
    }

    .categories-sec .categories-slider .owl-stage {
        display: flex;
        align-items: stretch;
    }

    .categories-sec .categories-slider .owl-item {
        display: flex;
    }

    .categories-sec .categories-slider .categories-card {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 0 10px;
    }

    .categories-sec .categories-card__media {
        position: relative;
        background: #f3f3f3;
        overflow: hidden;
        margin-bottom: 20px;
        height: 370px;
    }

    .categories-sec .categories-card__media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .categories-sec .categories-card:hover .categories-card__media img {
        transform: scale(1.04);
    }

    .categories-sec .categories-slider.owl-carousel .owl-nav {
        display: none !important;
    }

    .categories-sec .categories-slider__nav {
        position: absolute;
        top: 40%;
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

    .categories-sec .categories-slider__nav:hover {
        background: #1a1a1a;
        transform: translateY(-50%) scale(1.05);
    }

    .categories-sec .categories-slider__nav--prev {
        left: 0;
    }

    .categories-sec .categories-slider__nav--next {
        right: 0;
    }

    .categories-sec .categories-slider.owl-carousel .owl-dots {
        margin-top: 28px;
        text-align: center;
    }

    .categories-sec .categories-slider.owl-carousel .owl-dot span {
        width: 10px;
        height: 10px;
        margin: 4px 6px;
        background: rgba(0, 0, 0, 0.2);
        transition: background 0.25s ease, transform 0.25s ease;
    }

    .categories-sec .categories-slider.owl-carousel .owl-dot.active span,
    .categories-sec .categories-slider.owl-carousel .owl-dot:hover span {
        background: #000;
        transform: scale(1.1);
    }

    @media (max-width: 767.98px) {
        .categories-sec .categories-slider-wrap {
            padding: 0 40px;
        }

        .categories-sec .categories-slider__nav {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        /* @media (max-width: 375px) {
            .categories-sec .categories-card__media {
                height: 250px;
            } */
    }
</style>
@endpush

@section('content')
    <!-- home_banner::start  -->
    @php
        $headers = \Modules\Appearance\Entities\Header::all();
    @endphp
    <x-slider-component :headers="$headers"/>
<!-- home_banner::end  -->

<!-- new featured section -->
<!-- <section class="featured-profile-sec py-100 ">
  <div class="container">
    <h2 class="fs-55 fw-700 text-center text-black mb-80 secondry-font">Featured Artist Profiles</h2> -->
    <!-- <div class="row row-gap-10">
        @php
            $sellers = $seller->values();
        @endphp

        {{-- 1st col --}}
        @if(isset($sellers[0]))
        <div class="col-md-6">
            <div class="artist-card position-relative ratio-540-394">
                <img src="{{ $sellers[0]->avatar 
                                ? showImage($seller[0]->avatar) 
                                : showImage('frontend/default/img/avatar.png') }}" 
                    alt="{{ $sellers[0]->first_name }}" class="w-100">
                <h4 class="fw-700 fs-30 text-white position-absolute w-100 visible_text" 
                    style="bottom: 40px;">
                    <a href="{{ route('frontend.seller', $sellers[0]->slug ?? base64_encode($sellers[0]->id)) }}">
                    {{ $sellers[0]->first_name }}
                    </a>
                </h4>
            </div>
        </div>
        @endif

        {{-- 2nd col stacked --}}
        @if(isset($sellers[1]) || isset($sellers[2]))
        <div class="col-md-6">
            @if(isset($sellers[1]))
            <div class="artist-card position-relative mb-10 ratio-540-191">
                <img src="{{ $sellers[1]->avatar 
                                ? showImage($seller[1]->avatar) 
                                : showImage('frontend/default/img/avatar.png') }}" 
                    alt="{{ $sellers[1]->first_name }}" class="w-100">
                <h4 class="fw-700 fs-30 text-white position-absolute w-100 visible_text" 
                    style="bottom: 40px;">
                    <a href="{{ route('frontend.seller', $sellers[1]->slug ?? base64_encode($sellers[1]->id)) }}">
                    {{ $sellers[1]->first_name }}
                    </a>
                </h4>
        </div>
        @endif

        @if(isset($sellers[2]))
        <div class="artist-card position-relative ratio-540-191">
                <img src="{{ $sellers[2]->avatar 
                                ? showImage($seller[2]->avatar) 
                                : showImage('frontend/default/img/avatar.png') }}" 
                    alt="{{ $sellers[2]->first_name }}" class="w-100">
                <h4 class="fw-700 fs-30 text-white position-absolute w-100 visible_text" 
                    style="bottom: 40px;">
                    <a href="{{ route('frontend.seller', $sellers[2]->slug ?? base64_encode($sellers[2]->id)) }}">
                    {{ $sellers[2]->first_name }}
                    </a>
                </h4>
            </div>
            @endif
        </div>
        @endif

        {{-- 3rd col --}}
        @if(isset($sellers[3]))
        <div class="col-md-6">
            <div class="artist-card position-relative ratio-540-192">
                <img src="{{ $sellers[3]->SellerAccount->profile_image 
                                ? asset('uploads/sellers/'.$sellers[3]->SellerAccount->profile_image) 
                                : showImage('frontend/default/img/avatar.png') }}" 
                    alt="{{ $sellers[3]->first_name }}" class="w-100">
                <h4 class="fw-700 fs-30 text-white position-absolute w-100 visible_text" 
                    style="bottom: 40px;">
                    <a href="{{ route('frontend.seller', $sellers[3]->slug ?? base64_encode($sellers[3]->id)) }}">
                    {{ $sellers[3]->first_name }}
                    </a>
                </h4>
            </div>
        </div>
        @endif

        {{-- 4th col side by side --}}
        @if(isset($sellers[4]) || isset($sellers[5]))
        <div class="col-md-6 d-flex flex-column flex-md-row gap-10">
            @if(isset($sellers[4]))
            <div class="artist-card position-relative w-100 ratio-265-192">
                <img src="{{ $sellers[4]->SellerAccount->profile_image 
                                ? asset('uploads/sellers/'.$sellers[4]->SellerAccount->profile_image) 
                                : showImage('frontend/default/img/avatar.png') }}" 
                    alt="{{ $sellers[4]->first_name }}" class="w-100">
                <h4 class="fw-700 fs-30 text-white position-absolute w-100 visible_text" 
                    style="bottom: 40px;">
                    <a href="{{ route('frontend.seller', $sellers[4]->slug ?? base64_encode($sellers[4]->id)) }}">
                    {{ $sellers[4]->first_name }}
                    </a>
                </h4>
        </div>
        @endif

        @if(isset($sellers[5]))
        <div class="artist-card position-relative w-100 ratio-265-196">
                <img src="{{ $sellers[5]->SellerAccount->profile_image 
                                ? asset('uploads/sellers/'.$sellers[5]->SellerAccount->profile_image) 
                                : showImage('frontend/default/img/avatar.png') }}" 
                    alt="{{ $sellers[5]->first_name }}" class="w-100">
                <h4 class="fw-700 fs-30 text-white position-absolute w-100 visible_text" 
                    style="bottom: 40px;">
                    <a href="{{ route('frontend.seller', $sellers[5]->slug ?? base64_encode($sellers[5]->id)) }}">
                    {{ $sellers[5]->first_name }}
                    </a>
                </h4>
            </div>
            @endif
        </div>
        @endif -->

      <!-- <div class="col-md-6">
        <div class="artist-card position-relative">
          <img src="{{ asset('public/uploads/all/6852ea5c2146c.png') }}" alt="" class="w-100">
          <h4 class="fw-700 fs-30 text-white position-absolute w-100" style="bottom: 40px; left: 40px;">Devin Pughsley</h4>
        </div>
      </div>
      <div class="col-md-6">
        <div class="artist-card position-relative mb-10">
          <img src="{{ asset('public/uploads/all/6852ea5c1310e.png') }}" alt="" class="w-100">
          <h4 class="fw-700 fs-30 text-white position-absolute w-100" style="bottom: 40px; left: 40px;">Luke Joshu</h4>
        </div>
        <div class="artist-card position-relative">
          <img src="{{ asset('public/uploads/all/6852ea5c12a49.png') }}" alt="" class="w-100">
          <h4 class="fw-700 fs-30 text-white position-absolute w-100" style="bottom: 40px; left: 40px;">Jim Tidwell</h4>
        </div>
      </div>
      <div class="col-md-6">
        <div class="artist-card position-relative">
          <img src="{{ asset('public/uploads/all/6852ea5c0bff9.png') }}" alt="" class="w-100">
          <h4 class="fw-700 fs-30 text-white position-absolute w-100" style="bottom: 40px; left: 40px;">Robbie Lasky</h4>
        </div>
      </div>
      <div class="col-md-6 d-flex flex-column flex-md-row gap-10">
        <div class="artist-card position-relative w-100">
          <img src="{{ asset('public/uploads/all/6852ea5c0095f.png') }}" alt="" class="w-100">
          <h4 class="fw-700 fs-30 text-white position-absolute w-100" style="bottom: 40px; left: 40px;">Luke Joshua</h4>
        </div>
        <div class="artist-card position-relative w-100">
          <img src="{{ asset('public/uploads/all/6852ea5fe2609.png') }}" alt="" class="w-100">
          <h4 class="fw-700 fs-30 text-white position-absolute w-100" style="bottom: 40px; left: 40px;">Emily Brown</h4>
        </div>
      </div> -->
    <!-- </div>
  </div>
</section> -->
<!-- new featured section --> 

<!-- love art section -->  
@if(count($sellers) > 0) 
@php
    $loveArtCardStagger = 320;
    $loveArtCardBaseDelay = 380;
@endphp
<section class="love-art-sec py-50 overflow-visible">
  <div class="container">
    <h2 class="fs-55 fw-700 text-center text-black mb-40 secondry-font mx-auto max-w-1020px" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0">Love Art? Connect with an artist and their work</h2>
    <p class="primary-font text-black fs-20 mb-30 mx-auto text-center max-w-540px" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="180">Each 23LD artist is unique in their own way just like art. Learn their story and their life's work</p>
    <div class="row row-gap-30 love-art-grid">
        @foreach($sellers as $seller)
            @php
                $loveArtCardDelay = $loveArtCardBaseDelay + ($loop->index * $loveArtCardStagger);
                $loveArtCardAos = 'fade-up';
            @endphp
            <div class="col-12 col-md-6">
                <div class="love-art-card h-100" data-aos="{{ $loveArtCardAos }}" data-aos-duration="1500" data-aos-delay="{{ $loveArtCardDelay }}" data-aos-easing="ease-out-cubic">
                <div class="d-flex gap-5 mb-10">
                    <div>
                    <img src="{{ showImage($seller->avatar != null?$seller->avatar: 'frontend/default/img/avatar.png') }}" alt="" class="" height="335px" width="386px">
                    </div>
                    <div class="d-flex flex-column gap-4">
                            @if(count($seller->seller_products) > 0)
                            @foreach($seller->seller_products->take(3) as $product)
                            <img src="{{ showImage($product->thum_img ?? 'frontend/amazy/img/6438ce493d38b.svg') }}" alt="{{ $product->product_name }}" title="{{ $product->product_name }}" width="149px" height="110px">
                            @endforeach
                        @endif
                    </div>
                </div>
                <h4 class=" secondry-font text-start fs-40 fw-700" style="line-height: 1;">{{ $seller->first_name }} {{ $seller->last_name }}</h4>
                <p class="primary-font text-start mb-10">Portraits &amp; Wildlife</p>
                <a href="{{ route('frontend.seller', $seller->slug ?? base64_encode($seller->id)) }}" class="btn btn-secondary">View Profile</a>
                </div>
            </div>
        @endforeach
      <!-- Artist 1: Devin Pughsley -->
      <!-- <div class="col-12 col-md-6">
        <div class="love-art-card">
          <div class="d-flex gap-5 mb-10">
            <div>
              <img src="{{ asset('public/uploads/all/6852ffb8d8577.png') }}" alt="" class="">
            </div>
            <div class="d-flex flex-column gap-4">
              <img src="{{ asset('public/uploads/all/6852ea5fd54b7.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6852ea5fe1482.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6852ea600077c.png') }}" alt="" class="">
            </div>
          </div>
          <h4 class="secondry-font text-start fs-40 fw-700">Devin Pughsley</h4>
          <p class="primary-font text-start mb-10">Portraits &amp; Wildlife</p>
          <a href="#" class="btn btn-secondary">View Profile</a>
        </div>
      </div> -->
      <!-- Artist 2: Robbie Lasky -->
      <!-- <div class="col-12 col-md-6">
        <div class="love-art-card">
          <div class="d-flex gap-5 mb-10">
            <div>
              <img src="{{ asset('public/uploads/all/6852ffca9ab7d.png') }}" alt="" class="">
            </div>
            <div class="d-flex flex-column gap-4">
              <img src="{{ asset('public/uploads/all/6852ea604529d.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6853067a3ac23.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6853067a3aadf.png') }}" alt="" class="">
            </div>
          </div>
          <h4 class="secondry-font text-start fs-40 fw-700">Robbie Lasky</h4>
          <p class="primary-font text-start mb-10">Abstract &amp; Nature</p>
          <a href="#" class="btn btn-secondary">View Profile</a>
        </div>
      </div> -->
      <!-- Artist 3: Luke Joshu -->
      <!-- <div class="col-12 col-md-6">
        <div class="love-art-card">
          <div class="d-flex gap-5 mb-10">
            <div>
              <img src="{{ asset('public/uploads/all/6852ffca97048.png') }}" alt="" class="">
            </div>
            <div class="d-flex flex-column gap-4">
              <img src="{{ asset('public/uploads/all/6853067a3a93d.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6853067a42989.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6853067a3baa3.png') }}" alt="" class="">
            </div>
          </div>
          <h4 class="secondry-font text-start fs-40 fw-700">Luke Joshu</h4>
          <p class="primary-font text-start mb-10">Digital Art</p>
          <a href="#" class="btn btn-secondary">View Profile</a>
        </div>
      </div> -->
      <!-- Artist 4: Marla Gibson -->
      <!-- <div class="col-12 col-md-6">
        <div class="love-art-card">
          <div class="d-flex gap-5 mb-10">
            <div>
              <img src="{{ asset('public/uploads/all/6852ffca9a4c6.png') }}" alt="" class="">
            </div>
            <div class="d-flex flex-column gap-4">
              <img src="{{ asset('public/uploads/all/6853067d25183.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6853067d133a8.png') }}" alt="" class="">
              <img src="{{ asset('public/uploads/all/6853067d298e6.png') }}" alt="" class="">
            </div>
          </div>
          <h4 class="secondry-font text-start fs-40 fw-700">Marla Gibson</h4>
          <p class="primary-font text-start mb-10">Sketch &amp; Ink</p>
          <a href="#" class="btn btn-secondary">View Profile</a>
        </div>
      </div>
    </div> -->
    <div class="d-flex justify-content-center mt-45 mx-auto" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="{{ $loveArtCardBaseDelay + (count($sellers) * $loveArtCardStagger) + 200 }}">
      <a href="{{ route('frontend.artists') }}" class="btn bg-black text-white primary-font py-10 px-50">View All Artists</a>
    </div>
  </div>
</section>
@endif
{{-- @endif must follow only the Love Art block; filter / categories / marketplace must always render --}}
<!-- filter artist section --> 
<!-- <section class="filter-artist-sec pb-40">
  <div class="container">
    <div class="bg-light-gray-filter py-70">
      <h2 class="fs-55 fw-700 text-center text-black mb-40 secondry-font">Filter Artist Profiles</h2>
      <form action="{{ route('frontend.artists') }}" method="GET">
        <input type="hidden" name="search_artist" id="search_artist" value="1">
        <div class="row row-gap-20">
          <div class="col-md-12">
            <div class="position-relative w-100">
              <input type="text" name="search" class="primary-font filter-artist-input" placeholder="Search By Name" value="{{ request('search') }}">
            </div>
          </div>
          <div class="col-md-12">
            <div class="row row-gap-20">
              <div class="col-md-3">
                <div class="position-relative w-100">
                  <select class=" filter-artist-select primary-font" name="country" id="country" aria-label="Sizes">
                    <option value="">{{__('Choose Country')}}</option>
                    @foreach($countries as $key => $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                  <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-12 text-gray-400 me-3 pe-none"></i>
                </div>
              </div>
              <div class="col-md-3">
                <div class="position-relative w-100">
                  <select class=" filter-artist-select primary-font" name="state" id="state" aria-label="Location">
                    <option value="">{{__('Choose State')}}</option>
                  </select>
                  <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-12 text-gray-400 me-3 pe-none"></i>
                </div>
              </div>
              <div class="col-md-3">
                <div class="position-relative w-100">
                  <select class=" filter-artist-select primary-font" name="city" id="city" aria-label="Price">
                    <option selected="">Choose City</option>
                  </select>
                  <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-12 text-gray-400 me-3 pe-none"></i>
                </div>
              </div>
              <div class="col-md-3">
              <div class="position-relative w-100">
                  <input type="text" name="postal_code" class="primary-font filter-artist-select" placeholder="{{ __('common.postal_code') }}">
                </div>
              </div>
              <!-- <div class="col-md-3">
                <div class="position-relative w-100">
                  <select class=" filter-artist-select primary-font" aria-label="Price">
                    <option selected="">Choose Price</option>
                    <option value="250">250</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    <option value="5000">5000</option>
                    <option value="10000">10,000</option>
                  </select>
                  <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-12 text-gray-400 me-3 pe-none"></i>
                </div>
              </div> -->

              <!-- <div class="col-md-3">
                <div class="position-relative w-100">
                    @php
                        // get all parent categories
                        $parent_categories = \Modules\Product\Entities\Category::where('parent_id', 0)->where('status', 1)->get();
                    @endphp
                  <select class=" filter-artist-select primary-font" aria-label="Art Style">
                    <option selected="">Choose Art Style</option>
                    @foreach($parent_categories as $key => $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-12 text-gray-400 me-3 pe-none"></i>
                </div>
              </div> -->
            </div>
          </div>

        </div>
        <!-- <div class="d-flex justify-content-center mt-45 mx-auto">
            <button type="submit" class="btn bg-black text-white primary-font py-10 px-50">Find Artists</button>
            </div>
            <i class="fa-solid fa-magnifying-glass position-absolute fs-20 text-gray-400 pe-none" style="left: 10px; top: 50%; transform: translateY(-50%);"></i> -->
      </form>
    </div>
  </div>
</section> 
<!-- filter artist section -->  
<!-- Filter Artist Section — Final High-End Overhaul -->
<section class="filter-artist-sec overflow-visible">
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
              @include('frontend.amazy.partials._filter_arts_location_fields', ['locationPrefix' => 'welcome-'])

              <!-- Art Services -->
              <div class="col-12 col-md-6 col-lg-3 d-flex flex-column" data-aos="fade-up" data-aos-delay="200">
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
              <div class="col-12 col-md-6 col-lg-3 d-flex flex-column" data-aos="fade-up" data-aos-delay="250">
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
              <div class="col-12 col-md-6 col-lg-3 d-flex flex-column" data-aos="fade-up" data-aos-delay="300">
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
              <div class="col-12 col-md-6 col-lg-3 d-flex flex-column" data-aos="fade-up" data-aos-delay="350">
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
                    @auth
                    <option value="nude">Nude</option>
                    @endauth
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
              <div class="col-12 col-md-6 col-lg-3 d-flex flex-column" data-aos="fade-up" data-aos-delay="400">
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
              <div class="col-12 col-md-6 col-lg-3 d-flex flex-column" data-aos="fade-up" data-aos-delay="450">
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
              <div class="col-12 col-md-6 col-lg-3 d-flex flex-column" data-aos="fade-up" data-aos-delay="500">
                <label class="minimal-label">Price Range</label>
                <div class="slider-compact-container primary-font">
                    <input 
                      type="range" 
                      class="compact-range" 
                      min="0" 
                      max="5000" 
                      step="100" 
                      value="2500"
                      id="priceRange"
                    >
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
              <div class="col-12 col-md-6 col-lg-4 d-flex flex-column" data-aos="fade-up" data-aos-delay="550">
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
              <div class="col-12 col-md-6 col-lg-4 d-flex flex-column" data-aos="fade-up" data-aos-delay="600">
                 <label class="minimal-label">Palette Orientation</label>
                 <div class="color-compact-wrapper">
                    <input type="color" name="palette_color" value="#000000" class="compact-color-input" title="Custom color picker">
                 </div>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-45" data-aos="zoom-in" data-aos-delay="700">
          <button type="submit" class="btn btn-compact-black primary-font">
             Find Artists <i class="fa-solid fa-arrow-right-long fs-12"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- filter artist section -->  
<!-- love art section -->  
<!-- Slider section -->
 <section class="categories-sec pb-60 overflow-visible">
  <div class="container">
    <h2 class="fs-55 fw-700 text-center text-black mx-auto mb-30 line-height-1-2 secondry-font" style="max-width: 990px;" data-aos="fade-down" data-aos-duration="1500" data-aos-easing="ease-out-cubic">We provide specialized service to these categories</h2>
    <div class="categories-slider-wrap" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-out-cubic">
      <button type="button" class="categories-slider__nav categories-slider__nav--prev" aria-label="Previous category">
        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
      </button>
      <button type="button" class="categories-slider__nav categories-slider__nav--next" aria-label="Next category">
        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
      </button>
      <div class="categories-slider owl-carousel owl-theme">
        <div class="categories-slider-slide d-flex">
          <div class="categories-card mx-auto">
            <div class="categories-card__media">
              <img src="{{ showImage('uploads/images/16-06-2025/6850494d1cc2c.png') }}" alt="Interior Designers" loading="lazy" decoding="async">
            </div>
            <h3 class="text-start fw-700 text-black fs-18 secondry-font">Interior Designers</h3>
            <p class="mb-10 primary-font">Source art for your clients</p>
            <a href="{{ route('frontend.buyer.signup') }}" class="btn btn-secondary primary-font border-gray-light text-gray-400 px-44 py-10">View More</a>
          </div>
        </div>
        <div class="categories-slider-slide d-flex">
          <div class="categories-card mx-auto">
            <div class="categories-card__media">
              <img src="{{ asset('public/images/artist-cat.png') }}" alt="Artists" loading="lazy" decoding="async">
            </div>
            <h3 class="text-start fw-700 text-black fs-18 secondry-font">Artists</h3>
            <p class="mb-10 primary-font">Join our team</p>
            <a href="{{ route('frontend.merchant-register','subscription') }}" class="btn btn-secondary primary-font border-gray-light text-gray-400 px-44 py-10">View More</a>
          </div>
        </div>
        <div class="categories-slider-slide d-flex">
          <div class="categories-card mx-auto">
            <div class="categories-card__media">
              <img src="{{ showImage('uploads/images/16-06-2025/6850681225004.png') }}" alt="Location" loading="lazy" decoding="async">
            </div>
            <h3 class="text-start fw-700 text-black fs-18 secondry-font">Location</h3>
            <p class="mb-10 primary-font">Join Location account</p>
            <a href="{{ route('frontend.event-organiser-register','subscription') }}" class="btn btn-secondary primary-font border-gray-light text-gray-400 px-44 py-10">View More</a>
          </div>
        </div>
        <div class="categories-slider-slide d-flex">
          <div class="categories-card mx-auto">
            <div class="categories-card__media">
              <img src="{{ asset('public/images/about-us-media-02.png') }}" alt="Collectors" loading="lazy" decoding="async">
            </div>
            <h3 class="text-start fw-700 text-black fs-18 secondry-font">Collectors</h3>
            <p class="mb-10 primary-font">Join Collector account</p>
            <a href="#" class="btn btn-secondary primary-font border-gray-light text-gray-400 px-44 py-10">View More</a>
          </div>
        </div>
        <div class="categories-slider-slide d-flex">
          <div class="categories-card mx-auto">
            <div class="categories-card__media">
              <img src="{{ asset('public/images/art-galleries-cat.png') }}" alt="Art Galleries" loading="lazy" decoding="async">
            </div>
            <h3 class="text-start fw-700 text-black fs-18 secondry-font">Art Galleries</h3>
            <p class="mb-10 primary-font">Join Art Gallery account</p>
            <a href="./art-gallery-register/subscription" class="btn btn-secondary primary-font border-gray-light text-gray-400 px-44 py-10">View More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="market-place-sec position-relative mb-35 overflow-visible">
  <div class="container-fluid px-0">
    <div class="marketplace-shell">
      <div class="marketplace-top text-white position-relative">
        <h2 class="text-uppercase fw-bold secondary-font mb-3" style="font-size: clamp(36px, 4vw, 55px);" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic">
          23LD MARKETPLACE
        </h2>
        <p class="fs-6 lh-base marketplace-intro-text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="120" data-aos-easing="ease-out-cubic">
          Find your next work of art or design piece and connect with the community of 23LD buyers and sellers.
        </p>
      </div>
      <div class="marketplace-cards-grid" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200" data-aos-easing="ease-out-cubic">
            <div class="marketplace-card">
                <div class="marketplace-card-media">
                    <img src="{{ asset('public/uploads/all/68530cd031e6b.png') }}" class="img-fluid" alt="Slide 2">
                    <div class="marketplace-card-content">
                        <h3 class="fw-bold secondry-font marketplace-card-title">Collect</h3>
                        <p class="marketplace-card-desc">Buy local art</p>
                        <a href="{{route('frontend.buyer.signup')}}" class="btn btn-light text-black">Sign up as a Buyer</a>
                    </div>
                </div>
            </div>

            <div class="marketplace-card">
                <div class="marketplace-card-media">
                    <img src="{{ asset('public/uploads/all/68530cd031e6b.png') }}" class="img-fluid" alt="Slide 1">
                    <div class="marketplace-card-content">
                        <h3 class="fw-bold secondry-font marketplace-card-title">Sell</h3>
                        <p class="marketplace-card-desc">Join our artist community</p>
                        <a href="{{route('frontend.merchant-register','subscription')}}" class="btn btn-light text-black">Sign up as a Artist</a>
                    </div>
                </div>
            </div>

            <div class="marketplace-card">
                <div class="marketplace-card-media">
                    <img src="{{ asset('public/uploads/all/68530cd031e6b.png') }}" class="img-fluid" alt="Slide 2">
                    <div class="marketplace-card-content">
                        <h3 class="fw-bold secondry-font marketplace-card-title">Service</h3>
                        <p class="marketplace-card-desc">Art Services in your Neighborhood</p>
                        <a href="./art-gallery-register/subscription" class="btn btn-light text-black">Art Services</a>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
  
</section>
<!-- Slider section -->
<!-- newsletter section -->
<section class="newsletter-sec pb-40 overflow-visible">
  <div class="container">
    <div class="newsletter-card py-62 radius-44 bg-white overflow-visible">
      <h2 class="fs-55 fw-700 text-center text-black mb-40 secondry-font" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Subscribe to Our Newsletter</h2>
      <p class="primary-font text-black text-center fs-25 mx-auto mb-30" style="max-width: 863px;" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="110" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Be the first to learn about new collections, new artists, local events, and special offers just for art lovers.</p>
      <form action="">
        <div class="position-relative mx-auto overflow-visible" style="max-width: 830px;" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="220" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
          <input type="email" class="bg-white border-gray-light fs-16 px-16 py-18 primary-font" placeholder="Email">
          <button type="submit" class="position-absolute end-0 top-0 text-black-bg text-white primary-font py-17 px-30 fs-16">Subscribe</button>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- newsletter section -->
<!-- category section -->
@php
    // get all parent categories
    use Modules\Product\Entities\Category;
    use Modules\Seller\Entities\SellerProduct;
    use App\Models\SuggestColors;
    $parent_categories = Category::where('parent_id', 0)->where('status', 1)->take(5)->orderby('id','desc')->get();
    $peoples_choice = $widgets->where('section_name','people_choices')->first();
    $current_user_suggest_color = auth()->check()
        ? SuggestColors::where('user_id', auth()->id())->get()
        : null;

    $user_palette_hexes = $current_user_suggest_color instanceof \Illuminate\Support\Collection
        ? $current_user_suggest_color->pluck('colors')->filter()->unique()->values()->all()
        : [];

    $normalized = ! empty($user_palette_hexes)
        ? collect($user_palette_hexes)->map(fn ($c) => strtolower(trim((string) $c)))->unique()->values()->all()
        : [];

    $relatedLimit = 24;
    $relatedWith = ['seller', 'product', 'skus', 'reviews'];

    if (empty($normalized)) {
        $related_home_products = SellerProduct::with($relatedWith)
            ->where('status', 1)
            ->whereHas('product', function ($q) {
                $q->where('status', 1)->where('is_approved', 1);
            })
            ->inRandomOrder()
            ->take($relatedLimit)
            ->get();
    } else {
        $placeholders = implode(',', array_fill(0, count($normalized), '?'));

        $matchedProducts = SellerProduct::with($relatedWith)
            ->where('status', 1)
            ->whereHas('product', function ($q) use ($normalized, $placeholders) {
                $q->where('status', 1)->where('is_approved', 1);
                $q->whereRaw('LOWER(TRIM(`palette_color`)) IN (' . $placeholders . ')', $normalized);
            })
            ->inRandomOrder()
            ->take($relatedLimit)
            ->get();

        $matchedIds = $matchedProducts->pluck('id')->all();
        $needOthers = $relatedLimit - $matchedProducts->count();

        $otherProducts = collect();
        if ($needOthers > 0) {
            $otherProducts = SellerProduct::with($relatedWith)
                ->where('status', 1)
                ->whereNotIn('id', $matchedIds)
                ->whereHas('product', function ($q) use ($normalized, $placeholders) {
                    $q->where('status', 1)->where('is_approved', 1);
                    $q->where(function ($sub) use ($normalized, $placeholders) {
                        $sub->whereNull('palette_color')
                            ->orWhere('palette_color', '')
                            ->orWhereRaw('LOWER(TRIM(`palette_color`)) NOT IN (' . $placeholders . ')', $normalized);
                    });
                })
                ->inRandomOrder()
                ->take($needOthers)
                ->get();
        }

        $related_home_products = $matchedProducts->merge($otherProducts);
    }
@endphp

<!-- Related Products section -->
 
<!-- @if ($related_home_products->count() > 0)
<section class="related-products-sec py-60 overflow-visible">
    <div class="container">
        <div class="related-products-sec__head position-relative mb-30">
            <h2 class="related-products-heading fs-55 fw-700 text-black mb-0 secondry-font mx-auto" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic">{{ __('Recomended Products') }}</h2>
            <div class="related-products-nav position-absolute top-0 end-0 d-flex gap-2 align-items-center flex-shrink-0" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100" data-aos-easing="ease-out-cubic">
                <button type="button" class="related-products-prev" aria-label="Previous">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button type="button" class="related-products-next" aria-label="Next">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="related-products-slider owl-carousel owl-theme" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="180" data-aos-easing="ease-out-cubic">
            @foreach ($related_home_products as $product)
                <div class="item">
                    <div class="product_widget5 style5 w-100">
                        <div class="product_thumb_upper">
                            @php
                                if (@$product->thum_img != null) {
                                    $rp_thumbnail = showImage(@$product->thum_img);
                                } else {
                                    $rp_thumbnail = showImage(@$product->product->thumbnail_image_source);
                                }
                                $rp_price_qty = getProductDiscountedPrice(@$product);
                                $rp_showData = [
                                    'name' => @$product->product_name,
                                    'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                    'price' => $rp_price_qty,
                                    'thumbnail' => $rp_thumbnail,
                                ];
                            @endphp
                            <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}" class="thumb">
                                @if (app('general_setting')->lazyload == 1)
                                    <img data-src="{{ $rp_thumbnail }}" src="{{ showImage(themeDefaultImg()) }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" class="lazyload">
                                @else
                                    <img src="{{ $rp_thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}">
                                @endif
                            </a>
                            @if (isGuestAddtoCart() == true)
                                <div class="product_action">
                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                        data-producttype="{{ @$product->product->product_type }}"
                                        data-seller="{{ $product->user_id }}"
                                        data-product-sku="{{ @$product->skus->first()->id }}"
                                        data-product-id="{{ $product->id }}">
                                        <i class="ti-control-shuffle" title="{{ __('defaultTheme.compare') }}"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                        id="wishlistbtn_{{ $product->id }}"
                                        data-product_id="{{ $product->id }}"
                                        data-seller_id="{{ $product->user_id }}">
                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                    </a>
                                    <a class="quickView" data-product_id="{{ $product->id }}" data-type="product">
                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                    </a>
                                </div>
                            @endif
                            <div class="product_badge">
                                @if (isGuestAddtoCart() == true)
                                    @if ($product->hasDeal)
                                        @if ($product->hasDeal->discount > 0)
                                            <span class="d-flex align-items-center discount">
                                                @if ($product->hasDeal->discount_type == 0)
                                                    {{ getNumberTranslate($product->hasDeal->discount) }} % {{ __('common.off') }}
                                                @else
                                                    {{ single_price($product->hasDeal->discount) }} {{ __('common.off') }}
                                                @endif
                                            </span>
                                        @endif
                                    @else
                                        @if ($product->hasDiscount == 'yes')
                                            @if ($product->discount > 0)
                                                <span class="d-flex align-items-center discount">
                                                    @if ($product->discount_type == 0)
                                                        {{ getNumberTranslate($product->discount) }} % {{ __('common.off') }}
                                                    @else
                                                        {{ single_price($product->discount) }} {{ __('common.off') }}
                                                    @endif
                                                </span>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="product_star mx-auto">
                            @php
                                $rp_reviews = @$product->reviews->where('status', 1)->pluck('rating');
                                if (count($rp_reviews) > 0) {
                                    $rp_val = 0;
                                    foreach ($rp_reviews as $rv) {
                                        $rp_val += $rv;
                                    }
                                    $rp_rating = $rp_val / count($rp_reviews);
                                } else {
                                    $rp_rating = 0;
                                }
                            @endphp
                            <x-rating :rating="$rp_rating" />
                        </div>
                        <div class="product__meta text-center">
                            <span class="product_banding ">{{ @$product->brand->name ?? ' ' }}</span>
                            <a href="{{ singleProductURL(@$product->seller->slug, $product->slug) }}">
                                <h4>@if ($product->product_name){{ textLimit(@$product->product_name, 50) }}@else{{ textLimit(@$product->product->product_name, 50) }}@endif</h4>
                            </a>
                            @if (isGuestAddtoCart() == true)
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller="{{ $product->user_id }}" data-product-sku="{{ @$product->skus->first()->id }}"
                                        @if (@$product->hasDeal)
                                            data-base-price="{{ selling_price(@$product->skus->first()->sell_price, @$product->hasDeal->discount_type, @$product->hasDeal->discount) }}"
                                        @else
                                            @if (@$product->hasDiscount == 'yes')
                                                data-base-price="{{ selling_price(@$product->skus->first()->sell_price, @$product->discount_type, @$product->discount) }}"
                                            @else
                                                data-base-price="{{ @$product->skus->first()->sell_price }}"
                                            @endif
                                        @endif
                                        data-shipping-method="0"
                                        data-product-id="{{ $product->id }}"
                                        data-stock_manage="{{ $product->stock_manage }}"
                                        data-stock="{{ @$product->skus->first()->product_stock }}"
                                        data-min_qty="{{ @$product->product->minimum_order_qty }}"
                                        data-prod_info="{{ json_encode($rp_showData) }}">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                        </svg>
                                        {{ __('defaultTheme.add_to_cart') }}
                                    </a>
                                    <p>
                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                            <del>{{ getProductwitoutDiscountPrice(@$product) }}</del>
                                        @endif
                                        <strong>{{ getProductDiscountedPrice(@$product) }}</strong>
                                    </p>
                                </div>
                            @else
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent: 0;">{{ __('defaultTheme.login_to_order') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif -->

<!-- category section -->
<!-- how it works — fade-up only (horizontal AOS + overflow clipping caused hidden blocks) -->
<section class="how-it-works-sec py-100 bg-black overflow-visible">
  <div class="container">
    <h2 class="fs-55 fw-700 text-center text-white mx-auto secondry-font mb-40" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic">Connect Your Location with Local Artists</h2>
    <div class="row justify-content-center align-items-center row-gap-30">
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100" data-aos-easing="ease-out-cubic">
        <div class="d-flex gap-30 flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start  ">
          <div class="w-100 text-center text-md-start">
            <img src="{{ asset('public/uploads/all/685340c7f1013.png') }}" alt="Vision Casting" class="mb-20 mx-auto" style="max-width: 140px;">
          </div>
          <div>
            <div class="d-flex justify-content-center justify-content-md-start  gap-10 align-items-center">
              <div>
                <img src="{{ asset('public/uploads/all/685340c7ec6fb.png') }}" alt="Vision Casting" class="mb-20 mx-auto">
              </div>
              <h3 class="fs-24 fw-700 text-white secondry-font mb-10">Walk Through</h3>
            </div>
            <p class="fs-16 fw-400 text-white primary-font">During our in-person discovery, we’ll learn about the vision for your business and put together a plan that connects your space with local art that helps you achieve your desired aesthetic.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="220" data-aos-easing="ease-out-cubic">
        <div class="d-flex gap-30 flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start ">
          <div class=" w-100">
            <img src="{{ asset('public/uploads/all/685340c820468.png') }}" alt="Fine Art Matching &amp; Acquisition" class="mb-20 mx-auto" style="max-width: 140px;">
          </div>
          <div>
            <div class="d-flex justify-content-center justify-content-md-start gap-10 align-items-center text-center text-md-start flex-column flex-md-row">
              <div>
                <img src="{{ asset('public/uploads/all/685340c82af6e.png') }}" alt="Fine Art Matching &amp; Acquisition" class="mb-20 mx-auto">
              </div>
              <h3 class="fs-24 fw-700 text-white secondry-font mb-10">Fine Art Matching &amp; Acquisition</h3>
            </div>
            <p class="fs-16 fw-400 text-white primary-font">We’ll connect you with artists best suited to meet your needs.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="340" data-aos-easing="ease-out-cubic">
        <div class="d-flex gap-30 flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start ">
          <div class=" w-100">
            <img src="{{ asset('public/uploads/all/685340c81c9f6.png') }}" alt="Installation" class="mb-20 mx-auto" style="max-width: 140px;">
          </div>
          <div>
            <div class="d-flex gap-10 align-items-center justify-content-center justify-content-lg-start">
              <div>
                <img src="{{ asset('public/uploads/all/685340c9eec89.png') }}" alt="Installation" class="mb-20 mx-auto">
              </div>
              <h3 class="fs-24 fw-700 text-white secondry-font mb-10">Installation</h3>
            </div>
            <p class="fs-16 fw-400 text-white primary-font">Our team will configure all the pieces in your space for a flat rate. including identifying art labels and desired light fixtures.</p>
            <a href="./art-gallery-register/subscription" class="btn btn-secondary pri mary-font border-gray-light text-gray-400 px-44 py-10">View More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- how it works section -->
<!-- partners section -->
<section class="partners-sec py-100 overflow-visible">
  <div class="container">
    <h2 class="fs-55 fw-700 text-center text-black mx-auto secondry-font mb-40" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-out-cubic">Partners we've helped</h2>
    <div class="row text-center g-4 justify-content-center">
      <div class="col-12 col-sm-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic">
        <img src="{{ asset('public/uploads/all/68530cd015b84.png') }}" alt="Partner 1" class="img-fluid mx-auto d-block">
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="80" data-aos-easing="ease-out-cubic">
        <img src="{{ asset('public/uploads/all/68530cd037c1b.png') }}" alt="Partner 2" class="img-fluid mx-auto d-block">
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="160" data-aos-easing="ease-out-cubic">
        <img src="{{ asset('public/uploads/all/68530cd00c595.png') }}" alt="Partner 3" class="img-fluid mx-auto d-block">
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="240" data-aos-easing="ease-out-cubic">
        <img src="{{ asset('public/uploads/all/68530cd32bf88.png') }}" alt="Partner 4" class="img-fluid mx-auto d-block">
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="320" data-aos-easing="ease-out-cubic">
        <img src="{{ asset('public/uploads/all/68530cd32bb2f.png') }}" alt="Partner 5" class="img-fluid mx-auto d-block">
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="400" data-aos-easing="ease-out-cubic">
        <img src="{{ asset('public/uploads/all/68530cd32b92c.png') }}" alt="Partner 6" class="img-fluid mx-auto d-block">
      </div>
    </div>
</div>
</section>
<!-- partners section -->
<!-- contact us section -->
<section class="contact-us-sec pb-100 overflow-visible">
  <div class="container">
    <div class="row align-items-center row-gap-40">
      <div class="col-12 col-md-6">
        <h2 class="secondry-font text-center text-md-start fs-55 fw-400 mb-20" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Connect with us</h2>
        <div class="d-flex align-items-center flex-column flex-md-row gap-20 mb-20" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="90" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
          <div>
            <img src="{{ asset('public/uploads/all/68530cdb43d0e.png') }}" alt="profile">
          </div>
          <div>
            <h5 class="text-center text-md-start fw-500 fs-25 primary-font">Alex Grove</h5>
            <div class="d-flex flex-column gap-20 row-gap-10">
              <div class="d-flex align-items-center gap-20 justify-content-center justify-content-md-start">
                <i class="fa-solid fa-phone fs-20 text-black"></i>
                <a href="tel:9548500145" class="fs-20 p-0 text-black primary-font">954 850 0145</a>
              </div>
              <div class="d-flex align-items-center gap-20">
                <i class="fa-solid fa-envelope fs-20 text-black"></i>
                <a href="mailto:alexgrove.23ld@gmail.com" class="email-address-link fs-20 p-0 text-black primary-font">alexgrove.23ld@gmail.com</a>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center flex-column flex-md-row gap-20 mb-20" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="180" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
          <div>
            <img src="{{ asset('public/uploads/all/68530cde80b1c.png') }}" alt="profile">
          </div>
          <div>
            <h5 class="text-center text-md-start fw-500 fs-25 primary-font">Devin Pughsley</h5>
            <div class="d-flex flex-column gap-20 row-gap-10">
              <div class="d-flex align-items-center gap-20 justify-content-center justify-content-md-start">
                <i class="fa-solid fa-phone fs-24 text-black"></i>
                <a href="tel:2057778284" class="fs-20 p-0 text-black primary-font">205 777 8284</a>
              </div>
              <div class="d-flex align-items-center gap-20">
                <i class="fa-solid fa-envelope fs-20 text-black"></i>
                <a href="mailto:devinpughsley.23ld@gmail.com" class="email-address-link fs-20 p-0 text-black primary-font">devinpughsley.23ld@gmail.com</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <h2 class="secondry-font text-start fs-55 fw-400 mb-20" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Contact Us</h2>
        @if (session('success'))
            <div class="alert alert-success mb-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="70" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('frontend.contact.us') }}" method="POST">
            @csrf
          <div class="row row-gap-20">
            <div class="col-12 col-sm-6" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="110" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                <input type="text"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    placeholder="First Name"
                    class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                @error('first_name')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12 col-sm-6" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                <input type="text"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    placeholder="Last Name"
                    class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                @error('last_name')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12 col-sm-6" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="290" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                <input type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                @error('email')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12 col-sm-6" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="380" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                <input type="tel"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="Phone"
                    class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                @error('phone')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="470" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                <textarea name="message"
                        rows="5"
                        placeholder="Message"
                        class="primary-font border-gray-light fs-16 px-16 py-18 text-area w-100">{{ old('message') }}</textarea>
                @error('message')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="560" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
              <div class="position-relative w-100">
                <select class="primary-font border-gray-light fs-16 px-16 py-18 input-field" id="serviceSelect" name="service">
                  <option selected="" disabled="">Which service are you interested in?</option>
                  <option value="interior_designers">Interior Designers</option>
                  <option value="artists">Artists</option>
                  <option value="organiser">Location</option>
                  <option value="art_galleries">Art Galleries</option>
                  <option value="art_sourcing_purchase">Art Sourcing/Purchase</option>
                  <!-- <option value="other">Other</option> -->
                </select>
                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-17 text-black me-3 pe-none"></i>
              </div>
            </div>
            <div class="col-12 text-end" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="650" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
              <button type="submit" class="btn btn-primary radius-60 bg-black text-white primary-font py-17 px-30 fs-16">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- contact us section -->

<!-- best deals section -->
@php
    $best_deal = $widgets->where('section_name','best_deals')->first();
@endphp
<!--<div id="best_deals" class="amaz_section section_spacing {{$best_deal->status == 0?'d-none':''}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30 flex-wrap">
                    <h3 id="best_deals_title" class="m-0 flex-fill">{{$best_deal->title}}</h3>
                    <a href="{{route('frontend.category-product',['slug' =>  ($best_deal->section_name), 'item' =>'product'])}}" class="title_link d-flex align-items-center lh-1">
                        <span class="title_text">{{ __('common.view_all') }}</span>
                        <span class="title_icon">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="hidden" class="productQtyCount" value="{{$best_deal->getProductByQuery()->count()}}">
                <div class="trending_product_active owl-carousel">
                    @foreach($best_deal->getProductByQuery() as $key => $product)
                        <div class="product_widget5 mb_30 style5">
                            <div class="product_thumb_upper">
                                @php
                                    if (@$product->thum_img != null) {
                                        $thumbnail = showImage(@$product->thum_img);
                                    } else {
                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                    }

                                    $price_qty = getProductDiscountedPrice(@$product);
                                    $showData = [
                                        'name' => @$product->product_name,
                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                        'price' => $price_qty,
                                        'thumbnail' => $thumbnail,
                                    ];
                                @endphp
                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                    class="thumb">
                                    @if(app('general_setting')->lazyload == 1)
                                        <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                        class="lazyload">
                                    @else
                                        <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                    @endif
                                </a>
                                @if(isGuestAddtoCart() == true)
                                <div class="product_action">
                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                        data-producttype="{{ @$product->product->product_type }}"
                                        data-seller={{ $product->user_id }}
                                        data-product-sku={{ @$product->skus->first()->id }}
                                        data-product-id={{ $product->id }}>
                                        <i class="ti-control-shuffle"
                                            title="{{ __('defaultTheme.compare') }}"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                        id="wishlistbtn_{{ $product->id }}"
                                        data-product_id="{{ $product->id }}"
                                        data-seller_id="{{ $product->user_id }}">
                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                    </a>
                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                        data-type="product">
                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                    </a>
                                </div>
                                @endif
                                <div class="product_badge">
                                @if(isGuestAddtoCart() == true)
                                    @if($product->hasDeal)
                                        @if($product->hasDeal->discount >0)
                                            <span class="d-flex align-items-center discount">
                                                @if($product->hasDeal->discount_type ==0)
                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                @else
                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                @endif
                                            </span>
                                        @endif
                                    @else
                                        @if($product->hasDiscount == 'yes')
                                            @if($product->discount >0)
                                                <span class="d-flex align-items-center discount">
                                                    @if($product->discount_type ==0)
                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                    @else
                                                        {{single_price($product->discount)}} {{__('common.off')}}
                                                    @endif
                                                </span>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                                    @if(isModuleActive('ClubPoint'))
                                    <span class="d-flex align-items-center point">
                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                            <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{getNumberTranslate(@$product->product->club_point)}}
                                    </span>
                                    @endif
                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product_star mx-auto">
                                @php
                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                    if (count($reviews) > 0) {
                                        $value = 0;
                                        $rating = 0;
                                        foreach ($reviews as $review) {
                                            $value += $review;
                                        }
                                        $rating = $value / count($reviews);
                                        $total_review = count($reviews);
                                    } else {
                                        $rating = 0;
                                        $total_review = 0;
                                    }
                                @endphp
                                <x-rating :rating="$rating" />
                            </div>
                            <div class="product__meta text-center">
                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                </a>


                                @if(isGuestAddtoCart() == true)
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                            @if (@$product->hasDeal)
                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                            @else
                                                @if (@$product->hasDiscount == 'yes')
                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                @else
                                                    data-base-price={{ @$product->skus->first()->sell_price }}
                                                @endif
                                            @endif
                                            data-shipping-method=0
                                            data-product-id={{ $product->id }}
                                            data-stock_manage="{{$product->stock_manage}}"
                                            data-stock="{{@$product->skus->first()->product_stock}}"
                                            data-min_qty="{{@$product->product->minimum_order_qty}}"
                                            data-prod_info="{{ json_encode($showData) }}"
                                            >
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                            </svg>
                                            {{__('defaultTheme.add_to_cart')}}
                                        </a>
                                        <p>
                                            @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                <del>
                                                    {{getProductwitoutDiscountPrice(@$product)}}
                                                </del>
                                            @endif
                                            <strong>
                                                {{getProductDiscountedPrice(@$product)}}
                                            </strong>
                                        </p>
                                    </div>

                                @else
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent: 0;">
                                            {{__('defaultTheme.login_to_order')}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- amaz_section::start  -->
@php
    $feature_categories = $widgets->where('section_name','feature_categories')->first();
@endphp
<!--<div id="feature_categories" class="amaz_section {{$feature_categories->status == 0?'d-none':''}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30 flex-wrap ">
                    <h3 id="feature_categories_title" class="m-0 flex-fill">{{$feature_categories->title}}</h3>
                    <a href="{{url('/category')}}" class="title_link d-flex align-items-center lh-1">
                        <span class="title_text">{{ __('common.view_all') }}</span>
                        <span class="title_icon">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($feature_categories->getCategoryByQuery() as $key => $category)
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    <div class="amaz_home_cartBox amaz_cat_bg1 d-flex justify-content-between mb_30">
                        <div class="img_box">
                            @if(app('general_setting')->lazyload == 1)
                             <img class="lazyload" src="{{showImage(themeDefaultImg())}}" data-src="{{showImage(@$category->categoryImage->image?@$category->categoryImage->image:'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                            @else
                            <img src="{{showImage(@$category->categoryImage->image?@$category->categoryImage->image:'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                            @endif
                        </div>
                        <div class="amazcat_text_box">
                            <h4>
                                <a>{{textLimit($category->name,25)}}</a>
                            </h4>
                            <p class="lh-1">{{getNumberTranslate($category->sellerProducts->count())}} {{__('common.products')}}</p>
                            <a class="shop_now_text" href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}">{{__('common.shop_now')}} »</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>-->
<!-- amaz_section::end  -->
<!-- amaz_section::start  -->
@php
    $filter_category_1 = $widgets->where('section_name','filter_category_1')->first();
    $category = @$filter_category_1->customSection->category;
@endphp

<!--
<div id="filter_category_1" class="amaz_section section_spacing2 {{@$filter_category_1->status == 0?'d-none':''}}">
    <div class="container ">
        @if($category)
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title">{{$filter_category_1->title}}</h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                @foreach(@$category->subCategories as $key => $subcat)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$key == 0?'active':''}}" id="tab_link_{{$subcat->id}}" data-bs-toggle="tab" data-bs-target="#house_appliance_tab_pane_subcat_{{$subcat->id}}" type="button" role="tab" aria-controls="Dining" aria-selected="true">{{$subcat->name}}</button>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text">{{__('common.more_deals')}}</span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="House_Appliances_widget_right overflow-hidden p-0 {{$filter_category_1->customSection->field_2?'':'d-none'}}">
                            <img class="h-100 lazyload" data-src="{{showImage($filter_category_1->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{@$filter_category_1->title}}" title="{{@$filter_category_1->title}}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        @if($category->subCategories->count())
                            @foreach($category->subCategories as $key => $subcat)
                                <div class="tab-pane fade {{$key == 0?'show active':''}}" id="house_appliance_tab_pane_subcat_{{$subcat->id}}" role="tabpanel" aria-labelledby="Dining-tab">
                                    <!-- content  -->
                                    <!--<div class="House_Appliances_product">
                                        @foreach($subcat->sellerProductTake() as $product)
                                        <div class="product_widget5 style4 mb-0 style5">
                                            <div class="product_thumb_upper">
                                                @php
                                                    if (@$product->thum_img != null) {
                                                        $thumbnail = showImage(@$product->thum_img);
                                                    } else {
                                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                    }

                                                    $price_qty = getProductDiscountedPrice(@$product);
                                                    $showData = [
                                                        'name' => @$product->product_name,
                                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                        'price' => $price_qty,
                                                        'thumbnail' => $thumbnail,
                                                    ];
                                                @endphp
                                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                    class="thumb">
                                                    @if(app('general_setting')->lazyload == 1)
                                                       <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                       <img src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"   >
                                                    @endif
                                                </a>
                                                @if(isGuestAddtoCart())
                                                    <div class="product_action">
                                                        <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                            data-producttype="{{ @$product->product->product_type }}"
                                                            data-seller={{ $product->user_id }}
                                                            data-product-sku={{ @$product->skus->first()->id }}
                                                            data-product-id={{ $product->id }}>
                                                            <i class="ti-control-shuffle"
                                                                title="{{ __('defaultTheme.compare') }}"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                            id="wishlistbtn_{{ $product->id }}"
                                                            data-product_id="{{ $product->id }}"
                                                            data-seller_id="{{ $product->user_id }}">
                                                            <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                        </a>
                                                        <a class="quickView" data-product_id="{{ $product->id }}"
                                                            data-type="product">
                                                            <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="product_badge">
                                                    @if(isGuestAddtoCart())
                                                        @if($product->hasDeal)
                                                            @if($product->hasDeal->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->hasDeal->discount_type ==0)
                                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @else
                                                            @if($product->hasDiscount == 'yes')
                                                                @if($product->discount >0)
                                                                    <span class="d-flex align-items-center discount">
                                                                        @if($product->discount_type ==0)
                                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                        @else
                                                                            {{single_price($product->discount)}} {{__('common.off')}}
                                                                        @endif
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @if(isModuleActive('ClubPoint'))
                                                    <span class="d-flex align-items-center point">
                                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                            <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        {{getNumberTranslate(@$product->product->club_point)}}
                                                    </span>
                                                    @endif
                                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product_star mx-auto">
                                                @php
                                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                                    if (count($reviews) > 0) {
                                                        $value = 0;
                                                        $rating = 0;
                                                        foreach ($reviews as $review) {
                                                            $value += $review;
                                                        }
                                                        $rating = $value / count($reviews);
                                                        $total_review = count($reviews);
                                                    } else {
                                                        $rating = 0;
                                                        $total_review = 0;
                                                    }
                                                @endphp
                                                <x-rating :rating="$rating" />
                                            </div>
                                            <div class="product__meta text-center">
                                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                                </a>
                                                @if(isGuestAddtoCart())
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                        @if (@$product->hasDeal)
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                        @else
                                                            @if (@$product->hasDiscount == 'yes')
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                            @else
                                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                                            @endif
                                                        @endif
                                                        data-shipping-method=0
                                                        data-product-id={{ $product->id }}
                                                        data-stock_manage="{{$product->stock_manage}}"
                                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                        data-prod_info="{{ json_encode($showData) }}"
                                                        >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                        </svg>
                                                        {{__('defaultTheme.add_to_cart')}}
                                                    </a>
                                                    <p>
                                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                            <del>
                                                                {{getProductwitoutDiscountPrice(@$product)}}
                                                            </del>
                                                         @endif
                                                        <strong>
                                                            {{getProductDiscountedPrice(@$product)}}
                                                        </strong>
                                                    </p>
                                                </div>
                                                @else
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a href="{{ url('/login') }}" class="amaz_primary_btn w-100" style="text-indent: 0;">

                                                        {{__('defaultTheme.login_to_order')}}
                                                    </a>

                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- content  -->
                                <!--</div>
                            @endforeach
                        @else
                            <div class="tab-pane fade show active" id="house_appliance_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                                <!-- content  -->
                                <!--<div class="House_Appliances_product">
                                    @foreach($category->sellerProductTake() as $product)
                                    <div class="product_widget5 style4 mb-0 style5">
                                        <div class="product_thumb_upper">
                                            @php
                                                if (@$product->thum_img != null) {
                                                    $thumbnail = showImage(@$product->thum_img);
                                                } else {
                                                    $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                }

                                                $price_qty = getProductDiscountedPrice(@$product);
                                                $showData = [
                                                    'name' => @$product->product_name,
                                                    'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                    'price' => $price_qty,
                                                    'thumbnail' => $thumbnail,
                                                ];
                                            @endphp
                                            <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                class="thumb">
                                                @if(app('general_setting')->lazyload == 1)
                                                <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                    alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                    class="lazyload">

                                                @else
                                                <img  src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}">
                                                @endif
                                            </a>
                                            @if(isGuestAddtoCart())
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="{{ @$product->product->product_type }}"
                                                    data-seller={{ $product->user_id }}
                                                    data-product-sku={{ @$product->skus->first()->id }}
                                                    data-product-id={{ $product->id }}>
                                                    <i class="ti-control-shuffle"
                                                        title="{{ __('defaultTheme.compare') }}"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                    id="wishlistbtn_{{ $product->id }}"
                                                    data-product_id="{{ $product->id }}"
                                                    data-seller_id="{{ $product->user_id }}">
                                                    <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                </a>
                                                <a class="quickView" data-product_id="{{ $product->id }}"
                                                    data-type="product">
                                                    <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                </a>
                                            </div>
                                            @endif
                                            <div class="product_badge">
                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                    @if($product->hasDeal->discount_type ==0)
                                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @else
                                                            @if($product->hasDiscount == 'yes')
                                                                @if($product->discount >0)
                                                                    <span class="d-flex align-items-center discount">
                                                                        @if($product->discount_type ==0)
                                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                        @else
                                                                            {{single_price($product->discount)}} {{__('common.off')}}
                                                                        @endif
                                                                    </span>
                                                                @endif
                                                            @endif
                                                    @endif
                                                @endif
                                                @if(isModuleActive('ClubPoint'))
                                                <span class="d-flex align-items-center point">
                                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                        <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    {{getNumberTranslate(@$product->product->club_point)}}
                                                </span>
                                                @endif
                                                @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                    <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product_star mx-auto">
                                            @php
                                                $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                                if (count($reviews) > 0) {
                                                    $value = 0;
                                                    $rating = 0;
                                                    foreach ($reviews as $review) {
                                                        $value += $review;
                                                    }
                                                    $rating = $value / count($reviews);
                                                    $total_review = count($reviews);
                                                } else {
                                                    $rating = 0;
                                                    $total_review = 0;
                                                }
                                            @endphp
                                            <x-rating :rating="$rating" />
                                        </div>
                                        <div class="product__meta text-center">
                                            <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                            <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                            </a>
                                            @if(isGuestAddtoCart())
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                        @if (@$product->hasDeal)
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                        @else
                                                            @if (@$product->hasDiscount == 'yes')
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                            @else
                                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                                            @endif
                                                        @endif
                                                        data-shipping-method=0
                                                        data-product-id={{ $product->id }}
                                                        data-stock_manage="{{$product->stock_manage}}"
                                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                        data-prod_info="{{ json_encode($showData) }}"
                                                        >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                        </svg>
                                                        {{__('defaultTheme.add_to_cart')}}
                                                    </a>
                                                    <p>
                                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                            <del>
                                                                {{getProductwitoutDiscountPrice(@$product)}}
                                                            </del>
                                                        @endif
                                                        <strong>
                                                            {{getProductDiscountedPrice(@$product)}}
                                                        </strong>
                                                    </p>
                                                </div>
                                            @else
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a href="{{ url('/login') }}" class="amaz_primary_btn w-100" style="text-indent: 0;">
                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>

                                            </div>

                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- content  -->
                           <!-- </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>-->
@php
    $filter_category_2 = $widgets->where('section_name','filter_category_2')->first();
    $category = @$filter_category_2->customSection->category;
@endphp

    <!--<div id="filter_category_2" class="amaz_section section_spacing2 {{@$filter_category_2->status == 0?'d-none':''}}">
    <div class="container ">
        @if($category)
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title">{{$filter_category_2->title}}</h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                @foreach(@$category->subCategories as $key => $subcat)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$key == 0?'active':''}}" id="tab_link_{{$subcat->id}}" data-bs-toggle="tab" data-bs-target="#fashion_tab_pane_subcat_{{$subcat->id}}" type="button" role="tab" aria-controls="Dining" aria-selected="true">{{$subcat->name}}</button>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text">{{__('common.more_deals')}}</span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="House_Appliances_widget_right overflow-hidden p-0 {{$filter_category_2->customSection->field_2?'':'d-none'}}">
                            <img class="h-100 lazyload" data-src="{{showImage($filter_category_2->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{@$filter_category_2->title}}" title="{{@$filter_category_2->title}}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        @if($category->subCategories->count())
                            @foreach($category->subCategories as $key => $subcat)
                                <div class="tab-pane fade {{$key == 0?'show active':''}}" id="fashion_tab_pane_subcat_{{$subcat->id}}" role="tabpanel" aria-labelledby="Dining-tab">
                                    
                                    <div class="House_Appliances_product">
                                        @foreach($subcat->sellerProductTake() as $product)
                                        <div class="product_widget5 style4 mb-0 style5">
                                            <div class="product_thumb_upper">
                                                @php
                                                    if (@$product->thum_img != null) {
                                                        $thumbnail = showImage(@$product->thum_img);
                                                    } else {
                                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                    }

                                                    $price_qty = getProductDiscountedPrice(@$product);
                                                    $showData = [
                                                        'name' => @$product->product_name,
                                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                        'price' => $price_qty,
                                                        'thumbnail' => $thumbnail,
                                                    ];
                                                @endphp
                                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                    class="thumb">
                                                    @if(app('general_setting')->lazyload == 1)
                                                    <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                    <img  src="{{ $thumbnail }}"   alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}">
                                                    @endif
                                                </a>
                                                @if(isGuestAddtoCart())
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="{{ @$product->product->product_type }}"
                                                        data-seller={{ $product->user_id }}
                                                        data-product-sku={{ @$product->skus->first()->id }}
                                                        data-product-id={{ $product->id }}>
                                                        <i class="ti-control-shuffle"
                                                            title="{{ __('defaultTheme.compare') }}"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                        id="wishlistbtn_{{ $product->id }}"
                                                        data-product_id="{{ $product->id }}"
                                                        data-seller_id="{{ $product->user_id }}">
                                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                    </a>
                                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                                        data-type="product">
                                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                    </a>
                                                </div>
                                                @endif
                                                <div class="product_badge">

                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->hasDeal->discount_type ==0)
                                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        @if($product->hasDiscount == 'yes')
                                                            @if($product->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->discount_type ==0)
                                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                    @if(isModuleActive('ClubPoint'))
                                                    <span class="d-flex align-items-center point">
                                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                            <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        {{getNumberTranslate(@$product->product->club_point)}}
                                                    </span>
                                                    @endif
                                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product_star mx-auto">
                                                @php
                                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                                    if (count($reviews) > 0) {
                                                        $value = 0;
                                                        $rating = 0;
                                                        foreach ($reviews as $review) {
                                                            $value += $review;
                                                        }
                                                        $rating = $value / count($reviews);
                                                        $total_review = count($reviews);
                                                    } else {
                                                        $rating = 0;
                                                        $total_review = 0;
                                                    }
                                                @endphp
                                                <x-rating :rating="$rating" />
                                            </div>
                                            <div class="product__meta text-center">
                                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                                </a>
                                                @if(isGuestAddtoCart())
                                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                        <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                            @if (@$product->hasDeal)
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                            @else
                                                                @if (@$product->hasDiscount == 'yes')
                                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                                @else
                                                                    data-base-price={{ @$product->skus->first()->sell_price }}
                                                                @endif
                                                            @endif
                                                            data-shipping-method=0
                                                            data-product-id={{ $product->id }}
                                                            data-stock_manage="{{$product->stock_manage}}"
                                                            data-stock="{{@$product->skus->first()->product_stock}}"
                                                            data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                            data-prod_info="{{ json_encode($showData) }}"
                                                            >
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                            </svg>
                                                            {{__('defaultTheme.add_to_cart')}}
                                                        </a>
                                                        <p>
                                                            @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                                <del>
                                                                    {{getProductwitoutDiscountPrice(@$product)}}
                                                                </del>
                                                            @endif
                                                            <strong>
                                                                {{getProductDiscountedPrice(@$product)}}
                                                            </strong>
                                                        </p>
                                                    </div>
                                                @else

                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent: 0;">
                                                        {{__('defaultTheme.login_to_order')}}
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                   
                                </div>
                            @endforeach
                        @else
                            <div class="tab-pane fade show active" id="fashion_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                               
                                <div class="House_Appliances_product">
                                    @foreach($category->sellerProductTake() as $product)
                                    <div class="product_widget5 style4 mb-0 style5">
                                        <div class="product_thumb_upper">
                                            @php
                                                if (@$product->thum_img != null) {
                                                    $thumbnail = showImage(@$product->thum_img);
                                                } else {
                                                    $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                }

                                                $price_qty = getProductDiscountedPrice(@$product);
                                                $showData = [
                                                    'name' => @$product->product_name,
                                                    'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                    'price' => $price_qty,
                                                    'thumbnail' => $thumbnail,
                                                ];
                                            @endphp
                                            <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                class="thumb">
                                                @if(app('general_setting')->lazyload == 1)
                                                    <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                @else
                                                    <img  src="{{ $thumbnail }}"
                                                    alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                    >
                                                @endif
                                            </a>
                                            @if(isGuestAddtoCart())
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="{{ @$product->product->product_type }}"
                                                        data-seller={{ $product->user_id }}
                                                        data-product-sku={{ @$product->skus->first()->id }}
                                                        data-product-id={{ $product->id }}>
                                                        <i class="ti-control-shuffle"
                                                            title="{{ __('defaultTheme.compare') }}"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                        id="wishlistbtn_{{ $product->id }}"
                                                        data-product_id="{{ $product->id }}"
                                                        data-seller_id="{{ $product->user_id }}">
                                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                    </a>
                                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                                        data-type="product">
                                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="product_badge">

                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->hasDeal->discount_type ==0)
                                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        @if($product->hasDiscount == 'yes')
                                                            @if($product->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->discount_type ==0)
                                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                @if(isModuleActive('ClubPoint'))
                                                <span class="d-flex align-items-center point">
                                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                        <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    {{getNumberTranslate(@$product->product->club_point)}}
                                                </span>
                                                @endif
                                                @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                    <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product_star mx-auto">
                                            @php
                                                $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                                if (count($reviews) > 0) {
                                                    $value = 0;
                                                    $rating = 0;
                                                    foreach ($reviews as $review) {
                                                        $value += $review;
                                                    }
                                                    $rating = $value / count($reviews);
                                                    $total_review = count($reviews);
                                                } else {
                                                    $rating = 0;
                                                    $total_review = 0;
                                                }
                                            @endphp
                                            <x-rating :rating="$rating" />
                                        </div>
                                        <div class="product__meta text-center">
                                            <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                            <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                            </a>
                                            @if(isGuestAddtoCart())
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                    @if (@$product->hasDeal)
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                    @else
                                                        @if (@$product->hasDiscount == 'yes')
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                        @else
                                                            data-base-price={{ @$product->skus->first()->sell_price }}
                                                        @endif
                                                    @endif
                                                    data-shipping-method=0
                                                    data-product-id={{ $product->id }}
                                                    data-stock_manage="{{$product->stock_manage}}"
                                                    data-stock="{{@$product->skus->first()->product_stock}}"
                                                    data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                    data-prod_info="{{ json_encode($showData) }}"
                                                    >
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                        <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                    </svg>
                                                    {{__('defaultTheme.add_to_cart')}}
                                                </a>
                                                <p>
                                                    @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                        <del>
                                                            {{getProductwitoutDiscountPrice(@$product)}}
                                                        </del>
                                                     @endif
                                                    <strong>
                                                        {{getProductDiscountedPrice(@$product)}}
                                                    </strong>
                                                </p>
                                            </div>
                                            @else
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent:0;">
                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>-->
@php
    $filter_category_3 = $widgets->where('section_name','filter_category_3')->first();
    $category = @$filter_category_3->customSection->category;
@endphp

<!--<div id="filter_category_3" class="amaz_section section_spacing2 {{@$filter_category_3->status == 0?'d-none':''}}">
    <div class="container ">
        @if($category)
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title">{{$filter_category_3->title}}</h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                @foreach(@$category->subCategories as $key => $subcat)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$key == 0?'active':''}}" id="tab_link_{{$subcat->id}}" data-bs-toggle="tab" data-bs-target="#electronics_tab_pane_subcat_{{$subcat->id}}" type="button" role="tab" aria-controls="Dining" aria-selected="true">{{$subcat->name}}</button>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text">{{__('common.more_deals')}}</span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="House_Appliances_widget_right overflow-hidden p-0 {{$filter_category_3->customSection->field_2?'':'d-none'}}">
                            <img class="h-100 lazyload" data-src="{{showImage($filter_category_3->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{@$filter_category_3->title}}" title="{{@$filter_category_3->title}}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        @if($category->subCategories->count())
                            @foreach($category->subCategories as $key => $subcat)
                                <div class="tab-pane fade {{$key == 0?'show active':''}}" id="electronics_tab_pane_subcat_{{$subcat->id}}" role="tabpanel" aria-labelledby="Dining-tab">
                                    
                                    <div class="House_Appliances_product">
                                        @foreach($subcat->sellerProductTake() as $product)
                                        <div class="product_widget5 style4 mb-0 style5">
                                            <div class="product_thumb_upper">
                                                @php
                                                    if (@$product->thum_img != null) {
                                                        $thumbnail = showImage(@$product->thum_img);
                                                    } else {
                                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                    }

                                                    $price_qty = getProductDiscountedPrice(@$product);
                                                    $showData = [
                                                        'name' => @$product->product_name,
                                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                        'price' => $price_qty,
                                                        'thumbnail' => $thumbnail,
                                                    ];
                                                @endphp
                                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                    class="thumb">
                                                    @if(app('general_setting')->lazyload == 1)
                                                      <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                      <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                                    @endif
                                                </a>
                                                @if(isGuestAddtoCart())
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="{{ @$product->product->product_type }}"
                                                        data-seller={{ $product->user_id }}
                                                        data-product-sku={{ @$product->skus->first()->id }}
                                                        data-product-id={{ $product->id }}>
                                                        <i class="ti-control-shuffle"
                                                            title="{{ __('defaultTheme.compare') }}"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                        id="wishlistbtn_{{ $product->id }}"
                                                        data-product_id="{{ $product->id }}"
                                                        data-seller_id="{{ $product->user_id }}">
                                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                    </a>
                                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                                        data-type="product">
                                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                    </a>
                                                </div>
                                                @endif
                                                <div class="product_badge">
                                                    @if(isGuestAddtoCart())
                                                        @if($product->hasDeal)
                                                            @if($product->hasDeal->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->hasDeal->discount_type ==0)
                                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @else
                                                            @if($product->hasDiscount == 'yes')
                                                                @if($product->discount >0)
                                                                    <span class="d-flex align-items-center discount">
                                                                        @if($product->discount_type ==0)
                                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                        @else
                                                                            {{single_price($product->discount)}} {{__('common.off')}}
                                                                        @endif
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @if(isModuleActive('ClubPoint'))
                                                    <span class="d-flex align-items-center point">
                                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                            <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        {{getNumberTranslate(@$product->product->club_point)}}
                                                    </span>
                                                    @endif
                                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product_star mx-auto">
                                                @php
                                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                                    if (count($reviews) > 0) {
                                                        $value = 0;
                                                        $rating = 0;
                                                        foreach ($reviews as $review) {
                                                            $value += $review;
                                                        }
                                                        $rating = $value / count($reviews);
                                                        $total_review = count($reviews);
                                                    } else {
                                                        $rating = 0;
                                                        $total_review = 0;
                                                    }
                                                @endphp
                                                <x-rating :rating="$rating" />
                                            </div>
                                            <div class="product__meta text-center">
                                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                                </a>

                                                @if(isGuestAddtoCart())
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                        @if (@$product->hasDeal)
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                        @else
                                                            @if (@$product->hasDiscount == 'yes')
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                            @else
                                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                                            @endif
                                                        @endif
                                                        data-shipping-method=0
                                                        data-product-id={{ $product->id }}
                                                        data-stock_manage="{{$product->stock_manage}}"
                                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                        data-prod_info="{{ json_encode($showData) }}"
                                                        >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                        </svg>
                                                        {{__('defaultTheme.add_to_cart')}}
                                                    </a>
                                                    <p>
                                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                            <del>
                                                                {{getProductwitoutDiscountPrice(@$product)}}
                                                            </del>
                                                         @endif
                                                        <strong>
                                                            {{getProductDiscountedPrice(@$product)}}
                                                        </strong>
                                                    </p>
                                                </div>
                                                @else
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent:0; ">

                                                        {{__('defaultTheme.login_to_order')}}
                                                    </a>

                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            @endforeach
                        @else
                            <div class="tab-pane fade show active" id="electronics_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                               
                                <div class="House_Appliances_product">
                                    @foreach($category->sellerProductTake() as $product)
                                    <div class="product_widget5 style4 mb-0 style5">
                                        <div class="product_thumb_upper">
                                            @php
                                                if (@$product->thum_img != null) {
                                                    $thumbnail = showImage(@$product->thum_img);
                                                } else {
                                                    $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                }

                                                $price_qty = getProductDiscountedPrice(@$product);
                                                $showData = [
                                                    'name' => @$product->product_name,
                                                    'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                    'price' => $price_qty,
                                                    'thumbnail' => $thumbnail,
                                                ];
                                            @endphp
                                            <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                class="thumb">

                                                    @if(app('general_setting')->lazyload == 1)
                                                      <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                      <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                                    @endif
                                            </a>
                                            @if(isGuestAddtoCart())
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="{{ @$product->product->product_type }}"
                                                    data-seller={{ $product->user_id }}
                                                    data-product-sku={{ @$product->skus->first()->id }}
                                                    data-product-id={{ $product->id }}>
                                                    <i class="ti-control-shuffle"
                                                        title="{{ __('defaultTheme.compare') }}"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                    id="wishlistbtn_{{ $product->id }}"
                                                    data-product_id="{{ $product->id }}"
                                                    data-seller_id="{{ $product->user_id }}">
                                                    <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                </a>
                                                <a class="quickView" data-product_id="{{ $product->id }}"
                                                    data-type="product">
                                                    <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                </a>
                                            </div>
                                            @endif
                                            <div class="product_badge">
                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->hasDeal->discount_type ==0)
                                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        @if($product->hasDiscount == 'yes')
                                                            @if($product->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->discount_type ==0)
                                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                @if(isModuleActive('ClubPoint'))
                                                <span class="d-flex align-items-center point">
                                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                        <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    {{getNumberTranslate(@$product->product->club_point)}}
                                                </span>
                                                @endif
                                                @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                    <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product_star mx-auto">
                                            @php
                                                $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                                if (count($reviews) > 0) {
                                                    $value = 0;
                                                    $rating = 0;
                                                    foreach ($reviews as $review) {
                                                        $value += $review;
                                                    }
                                                    $rating = $value / count($reviews);
                                                    $total_review = count($reviews);
                                                } else {
                                                    $rating = 0;
                                                    $total_review = 0;
                                                }
                                            @endphp
                                            <x-rating :rating="$rating" />
                                        </div>
                                        <div class="product__meta text-center">
                                            <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                            <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                            </a>

                                            @if(isGuestAddtoCart())
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                    @if (@$product->hasDeal)
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                    @else
                                                        @if (@$product->hasDiscount == 'yes')
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                        @else
                                                            data-base-price={{ @$product->skus->first()->sell_price }}
                                                        @endif
                                                    @endif
                                                    data-shipping-method=0
                                                    data-product-id={{ $product->id }}
                                                    data-stock_manage="{{$product->stock_manage}}"
                                                    data-stock="{{@$product->skus->first()->product_stock}}"
                                                    data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                    data-prod_info="{{ json_encode($showData) }}"
                                                    >
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                        <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                    </svg>
                                                    {{__('defaultTheme.add_to_cart')}}
                                                </a>
                                                <p>
                                                    @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                        <del>
                                                            {{getProductwitoutDiscountPrice(@$product)}}
                                                        </del>
                                                     @endif
                                                    <strong>
                                                        {{getProductDiscountedPrice(@$product)}}
                                                    </strong>
                                                </p>
                                            </div>
                                            @else
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent: 0;">

                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                               
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>-->
<!-- amaz_section::end  -->
<!-- cta::start  -->
<div class="amaz_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <x-random-ads-component/>
            </div>
        </div>
    </div>
</div>
<!-- cta::end  -->

@php
    $top_rating = $widgets->where('section_name','top_rating')->first();
    $peoples_choice = $widgets->where('section_name','people_choices')->first();
    $top_picks = $widgets->where('section_name','top_picks')->first();
@endphp
<!--<div class="amaz_section section_spacing3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav amzcart_tabs d-flex align-items-center justify-content-center flex-wrap " id="myTab" role="tablist">
                    <li class="nav-item {{$top_rating->status == 0 ? 'd-none' : ''}}" role="presentation" id="top_rating">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><span id="top_rating_title">{{$top_rating->title}}</span></button>
                    </li>
                    <li class="nav-item {{$peoples_choice->status == 0 ? 'd-none' : ''}}" role="presentation" id="people_choices">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><span id="people_choice_title">{{$peoples_choice->title}}</span></button>
                    </li>
                    <li class="nav-item {{$top_picks->status == 0 ? 'd-none' : ''}}" role="presentation" id="top_picks">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><span id="top_picks_title">{{$top_picks->title}}</span></button>
                    </li>
                </ul>
            </div>
            <div class="col-xl-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{$top_rating->status == 0 ? 'hide' : 'show active'}}" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            @foreach($top_rating->getHomePageProductByQuery() as $key => $product)
                            <div class="product_widget5 mb_30 style5">
                                <div class="product_thumb_upper">
                                    @php
                                        if (@$product->thum_img != null) {
                                            $thumbnail = showImage(@$product->thum_img);
                                        } else {
                                            $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                        }

                                        $price_qty = getProductDiscountedPrice(@$product);
                                        $showData = [
                                            'name' => @$product->product_name,
                                            'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                            'price' => $price_qty,
                                            'thumbnail' => $thumbnail,
                                        ];
                                    @endphp
                                    <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                        class="thumb">
                                            @if(app('general_setting')->lazyload == 1)
                                                <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                class="lazyload">
                                            @else
                                                <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                            @endif
                                    </a>
                                    @if(isGuestAddtoCart())
                                        <div class="product_action">
                                            <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                data-producttype="{{ @$product->product->product_type }}"
                                                data-seller={{ $product->user_id }}
                                                data-product-sku={{ @$product->skus->first()->id }}
                                                data-product-id={{ $product->id }}>
                                                <i class="ti-control-shuffle"
                                                    title="{{ __('defaultTheme.compare') }}"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                id="wishlistbtn_{{ $product->id }}"
                                                data-product_id="{{ $product->id }}"
                                                data-seller_id="{{ $product->user_id }}">
                                                <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                            </a>
                                            <a class="quickView" data-product_id="{{ $product->id }}"
                                                data-type="product">
                                                <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="product_badge">
                                        @if(isGuestAddtoCart())
                                            @if($product->hasDeal)
                                                @if($product->hasDeal->discount >0)
                                                    <span class="d-flex align-items-center discount">
                                                        @if($product->hasDeal->discount_type ==0)
                                                            {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                        @else
                                                            {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                        @endif
                                                    </span>
                                                @endif
                                            @else
                                                @if($product->hasDiscount == 'yes')
                                                    @if($product->discount >0)
                                                        <span class="d-flex align-items-center discount">
                                                            @if($product->discount_type ==0)
                                                                {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                            @else
                                                                {{single_price($product->discount)}} {{__('common.off')}}
                                                            @endif
                                                        </span>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        @if(isModuleActive('ClubPoint'))
                                        <span class="d-flex align-items-center point">
                                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{getNumberTranslate(@$product->product->club_point)}}
                                        </span>
                                        @endif
                                        @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                            <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product_star mx-auto">
                                    @php
                                        $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                        if (count($reviews) > 0) {
                                            $value = 0;
                                            $rating = 0;
                                            foreach ($reviews as $review) {
                                                $value += $review;
                                            }
                                            $rating = $value / count($reviews);
                                            $total_review = count($reviews);
                                        } else {
                                            $rating = 0;
                                            $total_review = 0;
                                        }
                                    @endphp
                                    <x-rating :rating="$rating" />
                                </div>
                                <div class="product__meta px-3 text-center">
                                    <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                    <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                        <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                    </a>
                                    @if(isGuestAddtoCart())
                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                @if (@$product->hasDeal)
                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                @else
                                                    @if (@$product->hasDiscount == 'yes')
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                    @else
                                                        data-base-price={{ @$product->skus->first()->sell_price }}
                                                    @endif
                                                @endif
                                                data-shipping-method=0
                                                data-product-id={{ $product->id }}
                                                data-stock_manage="{{$product->stock_manage}}"
                                                data-stock="{{@$product->skus->first()->product_stock}}"
                                                data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                data-prod_info="{{ json_encode($showData) }}"
                                                >
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                    <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                </svg>
                                                {{__('defaultTheme.add_to_cart')}}
                                            </a>
                                            <p>
                                                @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                    <del>
                                                        {{getProductwitoutDiscountPrice(@$product)}}
                                                    </del>
                                                    @endif
                                                <strong>
                                                    {{getProductDiscountedPrice(@$product)}}
                                                </strong>
                                            </p>
                                        </div>
                                    @else
                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn w-100" href="{{ url('/login') }}"  style="text-indent: 0;">

                                                {{__('defaultTheme.login_to_order')}}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @endforeach
                        </div>
                        
                    </div>
                    <div class="tab-pane fade {{ $peoples_choice->status == 1 && $top_rating->status == 0 ? 'show active': 'hide' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            @foreach($peoples_choice->getHomePageProductByQuery() as $key => $product)

                            <div class="product_widget5 mb_30 style5">
                                <div class="product_thumb_upper">
                                    @php
                                        if (@$product->thum_img != null) {
                                            $thumbnail = showImage(@$product->thum_img);
                                        } else {
                                            $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                        }

                                        $price_qty = getProductDiscountedPrice(@$product);
                                        $showData = [
                                            'name' => @$product->product_name,
                                            'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                            'price' => $price_qty,
                                            'thumbnail' => $thumbnail,
                                        ];
                                    @endphp
                                    <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                        class="thumb">
                                        @if(app('general_setting')->lazyload == 1)
                                            <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                            alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                            class="lazyload">
                                        @else
                                            <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                        @endif
                                    </a>

                                    @if(isGuestAddtoCart())
                                        <div class="product_action">
                                            <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                data-producttype="{{ @$product->product->product_type }}"
                                                data-seller={{ $product->user_id }}
                                                data-product-sku={{ @$product->skus->first()->id }}
                                                data-product-id={{ $product->id }}>
                                                <i class="ti-control-shuffle"
                                                    title="{{ __('defaultTheme.compare') }}"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                id="wishlistbtn_{{ $product->id }}"
                                                data-product_id="{{ $product->id }}"
                                                data-seller_id="{{ $product->user_id }}">
                                                <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                            </a>
                                            <a class="quickView" data-product_id="{{ $product->id }}"
                                                data-type="product">
                                                <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="product_badge">
                                        @if(isGuestAddtoCart())
                                            @if($product->hasDeal)
                                                @if($product->hasDeal->discount >0)
                                                    <span class="d-flex align-items-center discount">
                                                        @if($product->hasDeal->discount_type ==0)
                                                            {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                        @else
                                                            {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                        @endif
                                                    </span>
                                                @endif
                                            @else
                                                @if($product->hasDiscount == 'yes')
                                                    @if($product->discount >0)
                                                        <span class="d-flex align-items-center discount">
                                                            @if($product->discount_type ==0)
                                                                {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                            @else
                                                                {{single_price($product->discount)}} {{__('common.off')}}
                                                            @endif
                                                        </span>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif


                                        @if(isModuleActive('ClubPoint'))
                                        <span class="d-flex align-items-center point">
                                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{getNumberTranslate(@$product->product->club_point)}}
                                        </span>
                                        @endif
                                        @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != '')
                                            <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product_star mx-auto">
                                    @php
                                        $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                        if (count($reviews) > 0) {
                                            $value = 0;
                                            $rating = 0;
                                            foreach ($reviews as $review) {
                                                $value += $review;
                                            }
                                            $rating = $value / count($reviews);
                                            $total_review = count($reviews);
                                        } else {
                                            $rating = 0;
                                            $total_review = 0;
                                        }
                                    @endphp
                                    <x-rating :rating="$rating" />
                                </div>
                                <div class="product__meta px-3 text-center">
                                    <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                    <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                        <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                    </a>

                                    @if(isGuestAddtoCart())
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                            @if (@$product->hasDeal)
                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                            @else
                                                @if (@$product->hasDiscount == 'yes')
                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                @else
                                                    data-base-price={{ @$product->skus->first()->sell_price }}
                                                @endif
                                            @endif
                                            data-shipping-method=0
                                            data-product-id={{ $product->id }}
                                            data-stock_manage="{{$product->stock_manage}}"
                                            data-stock="{{@$product->skus->first()->product_stock}}"
                                            data-min_qty="{{@$product->product->minimum_order_qty}}"
                                            data-prod_info="{{ json_encode($showData) }}"
                                            >
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                            </svg>
                                            {{__('defaultTheme.add_to_cart')}}
                                        </a>
                                        <p>
                                            @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                <del>
                                                    {{getProductwitoutDiscountPrice(@$product)}}
                                                </del>
                                                @endif
                                            <strong>
                                                {{getProductDiscountedPrice(@$product)}}
                                            </strong>
                                        </p>
                                    </div>
                                    @else
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn w-100"  style="text-indent: 0;" href="{{ url('/login') }}" >

                                            {{__('defaultTheme.login_to_order')}}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @endforeach
                        </div>
                        
                    </div>
                    <div class="tab-pane fade {{$top_picks->status == 1 && $peoples_choice->status == 0 && $top_rating->status == 0 ? 'show active': 'hide' }}" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            @foreach($top_picks->getHomePageProductByQuery() as $key => $product)
                                <div class="product_widget5 mb_30 style5">
                                    <div class="product_thumb_upper">
                                        @php
                                            if (@$product->thum_img != null) {
                                                $thumbnail = showImage(@$product->thum_img);
                                            } else {
                                                $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                            }

                                            $price_qty = getProductDiscountedPrice(@$product);
                                            $showData = [
                                                'name' => @$product->product_name,
                                                'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                'price' => $price_qty,
                                                'thumbnail' => $thumbnail,
                                            ];
                                        @endphp
                                        <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                            class="thumb">
                                            @if(app('general_setting')->lazyload == 1)
                                                <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                class="lazyload">
                                            @else
                                                <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                            @endif
                                        </a>
                                        @if(isGuestAddtoCart())
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="{{ @$product->product->product_type }}"
                                                    data-seller={{ $product->user_id }}
                                                    data-product-sku={{ @$product->skus->first()->id }}
                                                    data-product-id={{ $product->id }}>
                                                    <i class="ti-control-shuffle"
                                                        title="{{ __('defaultTheme.compare') }}"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                    id="wishlistbtn_{{ $product->id }}"
                                                    data-product_id="{{ $product->id }}"
                                                    data-seller_id="{{ $product->user_id }}">
                                                    <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                </a>
                                                <a class="quickView" data-product_id="{{ $product->id }}"
                                                    data-type="product">
                                                    <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="product_badge">
                                            @if(isGuestAddtoCart())
                                                @if($product->hasDeal)
                                                    @if($product->hasDeal->discount >0)
                                                        <span class="d-flex align-items-center discount">
                                                            @if($product->hasDeal->discount_type ==0)
                                                                {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                            @else
                                                                {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                            @endif
                                                        </span>
                                                    @endif
                                                @else
                                                    @if($product->hasDiscount == 'yes')
                                                        @if($product->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->discount_type ==0)
                                                                    {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            @if(isModuleActive('ClubPoint'))
                                            <span class="d-flex align-items-center point">
                                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                    <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                {{getNumberTranslate(@$product->product->club_point)}}
                                            </span>
                                            @endif
                                            @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != '')
                                                <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product_star mx-auto">
                                        @php
                                            $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                            if (count($reviews) > 0) {
                                                $value = 0;
                                                $rating = 0;
                                                foreach ($reviews as $review) {
                                                    $value += $review;
                                                }
                                                $rating = $value / count($reviews);
                                                $total_review = count($reviews);
                                            } else {
                                                $rating = 0;
                                                $total_review = 0;
                                            }
                                        @endphp
                                        <x-rating :rating="$rating" />
                                    </div>
                                    <div class="product__meta px-3 text-center">
                                        <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                        <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                            <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                        </a>

                                        @if(isGuestAddtoCart())
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                    @if (@$product->hasDeal)
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                    @else
                                                        @if (@$product->hasDiscount == 'yes')
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                        @else
                                                            data-base-price={{ @$product->skus->first()->sell_price }}
                                                        @endif
                                                    @endif
                                                    data-shipping-method=0
                                                    data-product-id={{ $product->id }}
                                                    data-stock_manage="{{$product->stock_manage}}"
                                                    data-stock="{{@$product->skus->first()->product_stock}}"
                                                    data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                    data-prod_info="{{ json_encode($showData) }}"
                                                    >
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                        <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                    </svg>
                                                    {{__('defaultTheme.add_to_cart')}}
                                                </a>
                                                <p>
                                                    @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                        <del>
                                                            {{getProductwitoutDiscountPrice(@$product)}}
                                                        </del>
                                                    @endif
                                                    <strong>
                                                        {{getProductDiscountedPrice(@$product)}}
                                                    </strong>
                                                </p>
                                            </div>
                                        @else

                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn w-100"  style="text-indent: 0;" href="{{ url('/login') }}">
                                                {{__('defaultTheme.login_to_order')}}
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>-->

@php
    $discount_banner = $widgets->where('section_name','discount_banner')->first();
@endphp
<!--<div id="discount_banner" class="amaz_section amaz_deal_area {{$discount_banner->status == 0?'d-none':''}}">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 {{!@$discount_banner->customSection->field_4?'d-none':''}}">
                <a href="{{@$discount_banner->customSection->field_4}}" class="mb_30">
                    <img data-src="{{showImage(@$discount_banner->customSection->field_1)}}" src="{{showImage(themeDefaultImg())}}" alt="{{$discount_banner->title}}" title="{{$discount_banner->title}}" class="img-fluid lazyload">
                </a>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 {{!@$discount_banner->customSection->field_5?'d-none':''}}">
                <a href="{{@$discount_banner->customSection->field_5}}" class=" mb_30">
                    <img data-src="{{showImage(@$discount_banner->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{$discount_banner->title}}" title="{{$discount_banner->title}}" class="img-fluid lazyload">
                </a>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 {{!@$discount_banner->customSection->field_6?'d-none':''}}">
                <a href="{{@$discount_banner->customSection->field_6}}" class=" mb_30">
                    <img data-src="{{showImage(@$discount_banner->customSection->field_3)}}" src="{{showImage(themeDefaultImg())}}" alt="{{$discount_banner->title}}" title="{{$discount_banner->title}}" class="img-fluid lazyload">
                </a>
            </div>
        </div>
    </div>
</div>-->

<!-- amaz_recomanded::start  -->

@php
    $more_products = $widgets->where('section_name','more_products')->first();
@endphp
<!--<div class="amaz_recomanded_area {{$more_products->status == 0?'d-none':''}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="more_products" class="amaz_recomanded_box mb_60">
                    <div class="amaz_recomanded_box_head">
                        <h4 class="mb-0">{{$more_products->title}}</h4>
                    </div>
                    <div class="amaz_recomanded_box_body2 dataApp">
                        @foreach($more_products->getHomePageProductByQuery() as $key => $product)
                        <div class="product_widget5 style5">
                            <div class="product_thumb_upper">
                                @php
                                    if (@$product->thum_img != null) {
                                        $thumbnail = showImage(@$product->thum_img);
                                    } else {
                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                    }

                                    $price_qty = getProductDiscountedPrice(@$product);
                                    $showData = [
                                        'name' => @$product->product_name,
                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                        'price' => $price_qty,
                                        'thumbnail' => $thumbnail,
                                    ];
                                @endphp
                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                    class="thumb">
                                    @if(app('general_setting')->lazyload == 1)
                                        <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                        class="lazyload">
                                    @else
                                        <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                    @endif
                                </a>
                                @if(isGuestAddtoCart())
                                <div class="product_action">
                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                        data-producttype="{{ @$product->product->product_type }}"
                                        data-seller={{ $product->user_id }}
                                        data-product-sku={{ @$product->skus->first()->id }}
                                        data-product-id={{ $product->id }}>
                                        <i class="ti-control-shuffle"
                                            title="{{ __('defaultTheme.compare') }}"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                        id="wishlistbtn_{{ $product->id }}"
                                        data-product_id="{{ $product->id }}"
                                        data-seller_id="{{ $product->user_id }}">
                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                    </a>
                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                        data-type="product">
                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                    </a>
                                </div>
                                @endif
                                <div class="product_badge">
                                    @if(isGuestAddtoCart())
                                        @if($product->hasDeal)
                                            @if($product->hasDeal->discount >0)
                                                <span class="d-flex align-items-center discount">
                                                    @if($product->hasDeal->discount_type ==0)
                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                    @else
                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                    @endif
                                                </span>
                                            @endif
                                        @else
                                            @if($product->hasDiscount == 'yes')
                                                @if($product->discount >0)
                                                    <span class="d-flex align-items-center discount">
                                                        @if($product->discount_type ==0)
                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                        @else
                                                            {{single_price($product->discount)}} {{__('common.off')}}
                                                        @endif
                                                    </span>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    @if(isModuleActive('ClubPoint'))
                                    <span class="d-flex align-items-center point">
                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                            <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{getNumberTranslate(@$product->product->club_point)}}
                                    </span>
                                    @endif
                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != '')
                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product_star mx-auto">
                                @php
                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');
                                    if (count($reviews) > 0) {
                                        $value = 0;
                                        $rating = 0;
                                        foreach ($reviews as $review) {
                                            $value += $review;
                                        }
                                        $rating = $value / count($reviews);
                                        $total_review = count($reviews);
                                    } else {
                                        $rating = 0;
                                        $total_review = 0;
                                    }
                               @endphp
                                <x-rating :rating="$rating" />
                            </div>
                            <div class="product__meta text-center">
                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                </a>
                                @if(isGuestAddtoCart())
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                        @if (@$product->hasDeal)
                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                        @else
                                            @if (@$product->hasDiscount == 'yes')
                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                            @else
                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                            @endif
                                        @endif
                                        data-shipping-method=0
                                        data-product-id={{ $product->id }}
                                        data-stock_manage="{{$product->stock_manage}}"
                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                        data-prod_info="{{ json_encode($showData) }}"
                                        >
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                        </svg>
                                        {{__('defaultTheme.add_to_cart')}}
                                    </a>
                                    <p>
                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                            <del>
                                                {{getProductwitoutDiscountPrice(@$product)}}
                                            </del>
                                            @endif
                                        <strong>
                                            {{getProductDiscountedPrice(@$product)}}
                                        </strong>
                                    </p>
                                </div>
                                @else
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn w-100" style="text-indent: 0;" href="{{ url('/login') }}">

                                        {{__('defaultTheme.login_to_order')}}
                                    </a>
                                </div>

                                @endif
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                @if($more_products->getHomePageProductByQuery()->lastPage() > 1)
                <a id="loadmore" class="amaz_primary_btn2 min_200 load_more_btn_homepage">{{__('common.load_more')}}</a>
                @endif

                <input type="hidden" id="login_check" value="@if(auth()->check()) 1 @else 0 @endif">
            </div>
        </div>
    </div>
</div>-->
<!-- amaz_recomanded::end -->
<!--<x-top-brand-component/>  -->   
<!-- amaz_brand::start  -->

<!-- amaz_brand::end  -->

<!-- Popular Searches::start  -->
<!--<x-popular-search-component/>   -->
<!-- Popular Searches::end  -->

@include(theme('partials._subscription_modal'))
@endsection
@include(theme('partials.add_to_cart_script'))
@include(theme('partials.add_to_compare_script'))
@push('scripts')
<script>
const range = document.getElementById("priceRange");
    const priceValue = document.getElementById("priceValue");
    if (range && priceValue) {
      range.addEventListener("input", function () {
        priceValue.textContent = this.value;
      });
    }

    $(document).ready(function () {
        var $categoriesSlider = $('.categories-slider');

        if ($categoriesSlider.length && typeof $.fn.owlCarousel === 'function') {
            $categoriesSlider.owlCarousel({
                loop: true,
                margin: 24,
                nav: false,
                dots: true,
                autoplay: false,
                autoplayHoverPause: true,
                smartSpeed: 500,
                responsive: {
                    0: { items: 1 },
                    576: { items: 2 },
                    992: { items: 3 }
                }
            });

            $('.categories-slider__nav--prev').on('click', function () {
                $categoriesSlider.trigger('prev.owl.carousel');
            });

            $('.categories-slider__nav--next').on('click', function () {
                $categoriesSlider.trigger('next.owl.carousel');
            });

            $categoriesSlider.on('initialized.owl.carousel refreshed.owl.carousel', function () {
                if (typeof AOS !== 'undefined') {
                    AOS.refresh();
                }
            });
        }
    });

    var $relatedProductsSlider = $(".related-products-slider");
    if ($relatedProductsSlider.length) {
        $relatedProductsSlider.owlCarousel({
            loop: true,
            margin: 24,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4500,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 },
                1200: { items: 4 }
            }
        });
        $(".related-products-prev").on("click", function () {
            $relatedProductsSlider.trigger("prev.owl.carousel");
        });
        $(".related-products-next").on("click", function () {
            $relatedProductsSlider.trigger("next.owl.carousel");
        });
        $relatedProductsSlider.on("initialized.owl.carousel", function () {
            if (typeof AOS !== "undefined") { AOS.refresh(); }
        });
    }

    function welcomePageAosRefresh() {
        if (typeof AOS !== "undefined") { AOS.refresh(); }
    }
    window.addEventListener("load", welcomePageAosRefresh);
    setTimeout(welcomePageAosRefresh, 300);
    setTimeout(welcomePageAosRefresh, 900);
</script>
@endpush