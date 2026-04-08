@extends('frontend.amazy.layouts.app')

@section('title')
    {{ __('common.merchants') }}
@endsection

@section('content')
    <div class="artists-list-page amazy_section_padding">
        <div class="container">
            <section class="artists-list-section pb-40 overflow-visible">
                <h1 class="artists-list-title fs-55 fw-700 text-center text-black mb-40 secondry-font mx-auto max-w-1020px text-uppercase" data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-out-cubic">
                    Artist and their work
                </h1>

                @if ($sellers->isNotEmpty())
                    {{-- 1 col mobile, 2 cols tablet, 3 cols desktop --}}
                    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                        @foreach ($sellers as $seller)
                            @php
                                $artistName = trim(($seller->first_name ?? '') . ' ' . ($seller->last_name ?? ''));
                                $thumbProducts = $seller->seller_products ? $seller->seller_products->take(3)->values() : collect();
                            @endphp
                            <div class="col d-flex">
                                <article class="artists-list-card w-100" data-aos="fade-up" data-aos-duration="900" data-aos-delay="{{ min($loop->index * 80, 480) }}" data-aos-easing="ease-out-cubic">
                                    <div class="artists-list-card__media">
                                        <div class="artists-list-card__portrait">
                                            <img
                                                src="{{ showImage($seller->avatar != null ? $seller->avatar : 'frontend/default/img/avatar.png') }}"
                                                alt="{{ $artistName }}"
                                                width="400"
                                                height="520"
                                                loading="lazy"
                                                decoding="async">
                                        </div>
                                        <div class="artists-list-card__thumbs">
                                            @for ($slot = 0; $slot < 3; $slot++)
                                                <div class="artists-list-card__thumb-slot @if (!isset($thumbProducts[$slot])) artists-list-card__thumb-slot--empty @endif">
                                                    @if (isset($thumbProducts[$slot]))
                                                        @php $product = $thumbProducts[$slot]; @endphp
                                                        <img
                                                            src="{{ showImage($product->thum_img ?? 'frontend/amazy/img/6438ce493d38b.svg') }}"
                                                            alt="{{ $product->product_name }}"
                                                            width="149"
                                                            height="110"
                                                            loading="lazy"
                                                            decoding="async">
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="artists-list-card__body">
                                        <h2 class="artists-list-card__name secondry-font text-start fw-700">{{ $artistName }}</h2>
                                        <p class="artists-list-card__tagline primary-font text-start mb-0">Portraits &amp; Wildlife</p>
                                        <div class="mt-3">
                                            <a href="{{ route('frontend.seller', $seller->slug ?? base64_encode($seller->id)) }}" class="btn-artists-profile primary-font">View Profile</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center primary-font fs-18 text-muted mb-0" data-aos="fade-up">No artists found.</p>
                @endif
            </section>

            @if ($sellers->isNotEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="pagination_part pt-2">
                            {{ $sellers->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
