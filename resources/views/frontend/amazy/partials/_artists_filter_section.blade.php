@php
    $idPrefix = $idPrefix ?? '';
    $showArtistGrid = $showArtistGrid ?? true;
    $artistFilterCategories = $artistFilterCategories ?? ['Portraits & Wildlife', 'Abstract Expressionism', 'Landscapes', 'Contemporary', 'Mixed Media'];
    $artistFilterMediums = $artistFilterMediums ?? ['Oil', 'Acrylic', 'Digital', 'Watercolor', 'Charcoal', 'Mixed'];
    $sellers = $sellers ?? collect();
    $countries = $countries ?? collect();
    $states = $states ?? collect();
    $cities = $cities ?? collect();
@endphp

<section class="filter-artist-sec artists-list-section pb-40 overflow-visible" style="box-shadow: none; background: transparent;">
    <div class="premium-luxury-panel" style="background: transparent; border-radius: 0; box-shadow: none; border: none;">
        <h1 class="artists-list-title fs-55 fw-700 text-center text-black mb-28 secondry-font mx-auto max-w-1020px text-uppercase" data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-out-cubic">
            Artist and their work
        </h1>

        @if (!$showArtistGrid || $sellers->isNotEmpty())
        <form class="artists-filter-bar primary-font mb-40" id="{{ $idPrefix }}artists-filter-bar" data-aos="fade-up" data-aos-duration="700" method="GET" action="{{ route('frontend.artists') }}">
            <div class="artists-filter-bar__scroll">
                <div class="artists-filter-bar row g-3 g-lg-4 justify-content-center">
                    <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                        <label class="artists-filter-field__label minimal-label" for="{{ $idPrefix }}artists-filter-name">Name</label>
                        <input type="text" id="{{ $idPrefix }}artists-filter-name" class="artists-filter-input compact-input" data-artists-filter="name" name="name" value="{{ request('name') }}" autocomplete="off" placeholder="Search by Artist Name or Theme...">
                    </div>
                    <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                        <label class="artists-filter-field__label minimal-label" for="{{ $idPrefix }}artists-filter-location">{{ __('Country') }}</label>
                        <select id="{{ $idPrefix }}artists-filter-location" class="artists-filter-select compact-select" data-artists-filter="location" name="country" autocomplete="off">
                            <option value="">{{ __('Choose Country') }}</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" @selected((string)request('country')===(string)$country->id)>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                        <label class="artists-filter-field__label minimal-label" for="{{ $idPrefix }}artists-filter-state">{{ __('State') }}</label>
                        <select id="{{ $idPrefix }}artists-filter-state" class="artists-filter-select compact-select" data-artists-filter="state" name="state" autocomplete="off">
                            <option value="">{{ __('Choose State') }}</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}" @selected((string)request('state')===(string)$state->id)>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                        <label class="artists-filter-field__label minimal-label" for="{{ $idPrefix }}artists-filter-city">{{ __('City') }}</label>
                        <select id="{{ $idPrefix }}artists-filter-city" class="artists-filter-select compact-select" data-artists-filter="city" name="city" autocomplete="off">
                            <option value="">{{ __('Choose City') }}</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}" @selected((string)request('city')===(string)$city->id)>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="artists-filter-field artists-filter-field--actions col-12 col-md-6 col-lg-3">
                        <span class="artists-filter-field__label minimal-label artists-filter-field__label minimal-label --spacer" aria-hidden="true">&nbsp;</span>
                        <div class="artists-filter-actions primary-font justify-content-center">
                            <button type="submit" class="btn btn-compact-black primary-font" id="{{ $idPrefix }}artists-filter-search" aria-label="Apply filters">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <p class="artists-filter-empty mb-0 primary-font" id="{{ $idPrefix }}artists-filter-empty" hidden>No artists match these filters.</p>
        </form>
        @endif

        @if ($showArtistGrid)
        @if ($sellers->isNotEmpty())
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3" id="{{ $idPrefix }}artists-filter-grid">
            @foreach ($sellers as $seller)
            @php
            $artistName = trim(($seller->first_name ?? '') . ' ' . ($seller->last_name ?? ''));
            $thumbProducts = $seller->seller_products ? $seller->seller_products->take(3)->values() : collect();
            $seed = abs((int) crc32((string) ($seller->id ?? $loop->index)));
            $filterCategory = $artistFilterCategories[$seed % count($artistFilterCategories)];
            $filterLocation = (string) (data_get($seller, 'SellerBusinessInformation.business_country') ?? data_get($seller, 'SellerBusinessInformation.country') ?? '');
            $filterState = (string) (data_get($seller, 'SellerBusinessInformation.business_state') ?? data_get($seller, 'SellerBusinessInformation.state') ?? '');
            $filterCity = (string) (data_get($seller, 'SellerBusinessInformation.business_city') ?? data_get($seller, 'SellerBusinessInformation.city') ?? '');
            $filterMedium = $artistFilterMediums[($seed >> 10) % count($artistFilterMediums)];
            $focusOptions = ['Commissions', 'Original work', 'Prints', 'Teaching'];
            $filterFocus = $focusOptions[($seed >> 14) % count($focusOptions)];
            @endphp
            <div class="col d-flex artists-filter-col">
                <article
                    class="artists-list-card w-100"
                    data-aos="fade-up"
                    data-aos-duration="900"
                    data-aos-delay="{{ min($loop->index * 80, 480) }}"
                    data-aos-easing="ease-out-cubic"
                    data-filter-name="{{ strtolower($artistName) }}"
                    data-filter-category="{{ $filterCategory }}"
                    data-filter-location="{{ $filterLocation }}"
                    data-filter-state="{{ $filterState }}"
                    data-filter-city="{{ $filterCity }}"
                    data-filter-medium="{{ $filterMedium }}"
                    data-filter-focus="{{ $filterFocus }}">
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
                        <p class="artists-list-card__tagline primary-font text-start mb-0">{{ $filterCategory }}</p>
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
        @endif
    </div>
</section>
