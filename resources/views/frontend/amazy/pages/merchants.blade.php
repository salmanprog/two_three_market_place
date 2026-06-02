@extends('frontend.amazy.layouts.app')

@section('title')
{{ __('common.merchants') }}
@endsection

@section('content')
@php
$artistFilterCategories = ['Portraits & Wildlife', 'Abstract Expressionism', 'Landscapes', 'Contemporary', 'Mixed Media'];
$artistFilterMediums = ['Oil', 'Acrylic', 'Digital', 'Watercolor', 'Charcoal', 'Mixed'];
@endphp
<div class="artists-list-page amazy_section_padding">
    <div class="container">
        <section class="filter-artist-sec artists-list-section pb-40 overflow-visible">
            <div class="premium-luxury-panel mb-30">
                <h1 class="artists-list-title fs-55 fw-700 text-center text-black mb-28 secondry-font mx-auto max-w-1020px text-uppercase" data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-out-cubic">
                    Artist and their work
                </h1>

                @if ($sellers->isNotEmpty())
                <form class="artists-filter-bar primary-font mb-40" id="artists-filter-bar" data-aos="fade-up" data-aos-duration="700" method="GET" action="{{ route('frontend.artists') }}">
                    <div class="artists-filter-bar__scroll">
                        <div class="artists-filter-bar  row g-3 g-lg-4 justify-content-center">
                            <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                                <label class="artists-filter-field__label minimal-label  " for="artists-filter-category">Name</label>
                                <input type="text" id="artists-filter-name" class="artists-filter-input compact-input" data-artists-filter="name" name="name" value="{{ request('name') }}" autocomplete="off" placeholder="Search by Artist Name or Theme...">
                            </div>
                            <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                                <label class="artists-filter-field__label minimal-label " for="artists-filter-location">{{ __('Country') }}</label>
                                <select id="artists-filter-location" class="artists-filter-select compact-select" data-artists-filter="location" name="country" autocomplete="off">
                                    <option value="">{{ __('Choose Country') }}</option>
                                    @foreach($countries as $key => $country)
                                    <option value="{{ $country->id }}" @selected((string)request('country')===(string)$country->id)>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                                <label class="artists-filter-field__label minimal-label " for="artists-filter-state">{{ __('State') }}</label>
                                <select id="artists-filter-state" class="artists-filter-select compact-select" data-artists-filter="state" name="state" autocomplete="off">
                                    <option value="">{{ __('Choose State') }}</option>
                                    @foreach($states as $key => $state)
                                    <option value="{{ $state->id }}" @selected((string)request('state')===(string)$state->id)>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="artists-filter-field col-12 col-md-6 col-lg-3">
                                <label class="artists-filter-field__label minimal-label " for="artists-filter-city">{{ __('City') }}</label>
                                <select id="artists-filter-city" class="artists-filter-select compact-select" data-artists-filter="city" name="city" autocomplete="off">
                                    <option value="">{{ __('Choose City') }}</option>
                                    @foreach($cities as $key => $city)
                                    <option value="{{ $city->id }}" @selected((string)request('city')===(string)$city->id)>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="artists-filter-field artists-filter-field--actions  col-12 col-md-6 col-lg-3">
                                <span class="artists-filter-field__label minimal-label  artists-filter-field__label minimal-label --spacer" aria-hidden="true">&nbsp;</span>
                                <div class="artists-filter-actions primary-font justify-content-center">
                                    <button type="submit" class="btn btn-compact-black primary-font" id="artists-filter-search" aria-label="Apply filters">Search</button>
                                    <!-- <button type="button" class="btn btn-compact-black artists-filter-reset primary-font" id="artists-filter-reset" aria-label="Clear filters">Reset</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="artists-filter-empty mb-0 primary-font" id="artists-filter-empty" hidden>No artists match these filters.</p>
                </form>
            </div>

            {{-- 1 col mobile, 2 cols tablet, 3 cols desktop --}}
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3" id="artists-filter-grid">
                @foreach ($sellers as $seller)
                @php
                $artistName = trim(($seller->first_name ?? '') . ' ' . ($seller->last_name ?? ''));
                $thumbProducts = $seller->seller_products ? $seller->seller_products->take(3)->values() : collect();
                $seed = abs((int) crc32((string) ($seller->id ?? $loop->index)));
                $filterCategory = $artistFilterCategories[$seed % count($artistFilterCategories)];
                $filterLocation = (string) (data_get($seller, 'SellerBusinessInformation.country') ?? '');
                $filterState = (string) (data_get($seller, 'SellerBusinessInformation.state') ?? '');
                $filterCity = (string) (data_get($seller, 'SellerBusinessInformation.city') ?? '');
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
            @else
            <p class="text-center primary-font fs-18 text-muted mb-0" data-aos="fade-up">No artists found.</p>
            @endif
    </div>
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

@push('scripts')
<script>
    (function() {
        var grid = document.getElementById('artists-filter-grid');
        var emptyMsg = document.getElementById('artists-filter-empty');
        if (!grid) return;

        var filterFields = document.querySelectorAll('[data-artists-filter]');
        var resetBtn = document.getElementById('artists-filter-reset');
        var searchBtn = document.getElementById('artists-filter-search');
        var nameInput = document.getElementById('artists-filter-name');
        var countrySelect = document.getElementById('artists-filter-location');
        var stateSelect = document.getElementById('artists-filter-state');
        var citySelect = document.getElementById('artists-filter-city');
        var baseUrl = @json(url('/'));

        function getVal(key) {
            var el = document.querySelector('[data-artists-filter="' + key + '"]');
            return el ? (el.value || '') : '';
        }

        function applyFilter() {
            var name = (getVal('name') || '').toLowerCase().trim();
            var loc = getVal('location');
            var st = getVal('state');
            var ct = getVal('city');
            var med = getVal('medium');
            var foc = getVal('focus');
            var cards = grid.querySelectorAll('article.artists-list-card');
            var visible = 0;

            cards.forEach(function(card) {
                var n = (card.getAttribute('data-filter-name') || '').toLowerCase();
                var l = card.getAttribute('data-filter-location') || '';
                var s = card.getAttribute('data-filter-state') || '';
                var ci = card.getAttribute('data-filter-city') || '';
                var m = card.getAttribute('data-filter-medium') || '';
                var f = card.getAttribute('data-filter-focus') || '';
                var show =
                    (!name || n.indexOf(name) !== -1) &&
                    (!loc || l === loc) &&
                    (!st || s === st) &&
                    (!ct || ci === ct) &&
                    (!med || m === med) &&
                    (!foc || f === foc);
                var col = card.closest('.artists-filter-col');
                if (col) {
                    col.style.display = show ? '' : 'none';
                } else {
                    card.style.display = show ? '' : 'none';
                }
                if (show) visible++;
            });

            if (emptyMsg) {
                emptyMsg.hidden = visible > 0;
                emptyMsg.setAttribute('aria-hidden', visible > 0 ? 'true' : 'false');
            }
        }

        function bindSearchTriggers() {
            function runSearch() {
                applyFilter();
            }
            if (searchBtn) searchBtn.addEventListener('click', runSearch);
            filterFields.forEach(function(field) {
                field.addEventListener('keydown', function(ev) {
                    if (ev.key === 'Enter') {
                        ev.preventDefault();
                        runSearch();
                    }
                });
            });
            if (nameInput) {
                nameInput.addEventListener('input', runSearch);
            }
        }

        bindSearchTriggers();

        function resetSelectWithPlaceholder(selectEl, placeholder) {
            if (!selectEl) return;
            selectEl.innerHTML = '';
            var opt = document.createElement('option');
            opt.value = '';
            opt.textContent = placeholder;
            selectEl.appendChild(opt);
        }

        if (countrySelect) {
            countrySelect.addEventListener('change', function() {
                var countryId = countrySelect.value || '';
                resetSelectWithPlaceholder(stateSelect, @json(__('Choose State')));
                resetSelectWithPlaceholder(citySelect, @json(__('Choose City')));
                if (!countryId) return;
                fetch(baseUrl + '/get-state?country_id=' + encodeURIComponent(countryId), {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(function(r) {
                        return r.ok ? r.json() : [];
                    })
                    .then(function(states) {
                        (states || []).forEach(function(stateObj) {
                            var opt = document.createElement('option');
                            opt.value = stateObj.id;
                            opt.textContent = stateObj.name;
                            stateSelect.appendChild(opt);
                        });
                    })
                    .catch(function() {});
            });
        }

        if (stateSelect) {
            stateSelect.addEventListener('change', function() {
                var stateId = stateSelect.value || '';
                resetSelectWithPlaceholder(citySelect, @json(__('Choose City')));
                if (!stateId) return;
                fetch(baseUrl + '/get-city?state_id=' + encodeURIComponent(stateId), {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(function(r) {
                        return r.ok ? r.json() : [];
                    })
                    .then(function(cities) {
                        (cities || []).forEach(function(cityObj) {
                            var opt = document.createElement('option');
                            opt.value = cityObj.id;
                            opt.textContent = cityObj.name;
                            citySelect.appendChild(opt);
                        });
                    })
                    .catch(function() {});
            });
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                window.location.href = @json(route('frontend.artists'));
            });
        }

        applyFilter();
    })();
</script>
@endpush