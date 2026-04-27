@extends('frontend.amazy.layouts.app')

@section('title')
    {{ __('common.merchants') }}
@endsection

@section('content')
    @php
        $artistFilterCategories = ['Portraits & Wildlife', 'Abstract Expressionism', 'Landscapes', 'Contemporary', 'Mixed Media'];
        $artistFilterLocations = ['New York', 'Los Angeles', 'Chicago', 'Miami', 'Austin', 'Seattle'];
        $artistFilterMediums = ['Oil', 'Acrylic', 'Digital', 'Watercolor', 'Charcoal', 'Mixed'];
    @endphp
    <div class="artists-list-page amazy_section_padding">
        <div class="container">
            <section class="artists-list-section pb-40 overflow-visible">
                <h1 class="artists-list-title fs-55 fw-700 text-center text-black mb-28 secondry-font mx-auto max-w-1020px text-uppercase" data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-out-cubic">
                    Artist and their work
                </h1>

                @if ($sellers->isNotEmpty())
                    <div class="artists-filter-bar primary-font mb-40" id="artists-filter-bar" data-aos="fade-up" data-aos-duration="700">
                        <div class="artists-filter-bar__scroll">
                            <div class="artists-filter-bar__row">
                                <div class="artists-filter-field">
                                    <label class="artists-filter-field__label" for="artists-filter-category">Category</label>
                                    <select id="artists-filter-category" class="artists-filter-select" data-artists-filter="category" autocomplete="off">
                                        <option value="">All categories</option>
                                        @foreach ($artistFilterCategories as $fc)
                                            <option value="{{ $fc }}">{{ $fc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="artists-filter-field">
                                    <label class="artists-filter-field__label" for="artists-filter-location">Location</label>
                                    <select id="artists-filter-location" class="artists-filter-select" data-artists-filter="location" autocomplete="off">
                                        <option value="">All locations</option>
                                        @foreach ($artistFilterLocations as $fl)
                                            <option value="{{ $fl }}">{{ $fl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="artists-filter-field">
                                    <label class="artists-filter-field__label" for="artists-filter-medium">Medium</label>
                                    <select id="artists-filter-medium" class="artists-filter-select" data-artists-filter="medium" autocomplete="off">
                                        <option value="">All mediums</option>
                                        @foreach ($artistFilterMediums as $fm)
                                            <option value="{{ $fm }}">{{ $fm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="artists-filter-field">
                                    <label class="artists-filter-field__label" for="artists-filter-focus">Focus</label>
                                    <select id="artists-filter-focus" class="artists-filter-select" data-artists-filter="focus" autocomplete="off">
                                        <option value="">All focus areas</option>
                                        <option value="Commissions">Commissions</option>
                                        <option value="Original work">Original work</option>
                                        <option value="Prints">Prints</option>
                                        <option value="Teaching">Teaching</option>
                                    </select>
                                </div>
                                <div class="artists-filter-field artists-filter-field--actions">
                                    <span class="artists-filter-field__label artists-filter-field__label--spacer" aria-hidden="true">&nbsp;</span>
                                    <div class="artists-filter-actions primary-font">
                                        <button type="button" class="artists-filter-search" id="artists-filter-search" aria-label="Apply filters">Search</button>
                                        <button type="button" class="artists-filter-reset" id="artists-filter-reset" aria-label="Clear filters">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="artists-filter-empty mb-0 primary-font" id="artists-filter-empty" hidden>No artists match these filters.</p>
                    </div>

                    {{-- 1 col mobile, 2 cols tablet, 3 cols desktop --}}
                    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3" id="artists-filter-grid">
                        @foreach ($sellers as $seller)
                            @php
                                $artistName = trim(($seller->first_name ?? '') . ' ' . ($seller->last_name ?? ''));
                                $thumbProducts = $seller->seller_products ? $seller->seller_products->take(3)->values() : collect();
                                $seed = abs((int) crc32((string) ($seller->id ?? $loop->index)));
                                $filterCategory = $artistFilterCategories[$seed % count($artistFilterCategories)];
                                $filterLocation = $artistFilterLocations[($seed >> 5) % count($artistFilterLocations)];
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
                                    data-filter-category="{{ $filterCategory }}"
                                    data-filter-location="{{ $filterLocation }}"
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
        (function () {
            var grid = document.getElementById('artists-filter-grid');
            var emptyMsg = document.getElementById('artists-filter-empty');
            if (!grid) return;

            var selects = document.querySelectorAll('[data-artists-filter]');
            var resetBtn = document.getElementById('artists-filter-reset');
            var searchBtn = document.getElementById('artists-filter-search');

            function getVal(key) {
                var el = document.querySelector('[data-artists-filter="' + key + '"]');
                return el ? (el.value || '') : '';
            }

            function applyFilter() {
                var cat = getVal('category');
                var loc = getVal('location');
                var med = getVal('medium');
                var foc = getVal('focus');
                var cards = grid.querySelectorAll('article.artists-list-card');
                var visible = 0;

                cards.forEach(function (card) {
                    var c = card.getAttribute('data-filter-category') || '';
                    var l = card.getAttribute('data-filter-location') || '';
                    var m = card.getAttribute('data-filter-medium') || '';
                    var f = card.getAttribute('data-filter-focus') || '';
                    var show =
                        (!cat || c === cat) &&
                        (!loc || l === loc) &&
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
                selects.forEach(function (sel) {
                    sel.addEventListener('keydown', function (ev) {
                        if (ev.key === 'Enter') {
                            ev.preventDefault();
                            runSearch();
                        }
                    });
                });
            }

            bindSearchTriggers();

            if (resetBtn) {
                resetBtn.addEventListener('click', function () {
                    selects.forEach(function (sel) {
                        sel.selectedIndex = 0;
                    });
                    applyFilter();
                });
            }

            applyFilter();
        })();
    </script>
@endpush
