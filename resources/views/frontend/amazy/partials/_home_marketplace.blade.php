@php
    $marketplace = siteHomePageMarketplace();
@endphp
<section class="market-place-sec position-relative mb-35 overflow-visible">
  <div class="container-fluid px-0">
    <div class="marketplace-shell">
      <div class="marketplace-top text-white position-relative">
        <h2 class="text-uppercase fw-bold secondary-font mb-3" style="font-size: clamp(36px, 4vw, 55px);" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic">
          {{ $marketplace['heading'] }}
        </h2>
        <p class="fs-6 lh-base marketplace-intro-text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="120" data-aos-easing="ease-out-cubic">
          {{ $marketplace['intro'] }}
        </p>
      </div>
      <div class="marketplace-cards-grid" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200" data-aos-easing="ease-out-cubic">
        @foreach($marketplace['cards'] as $card)
            <div class="marketplace-card">
                <div class="marketplace-card-media">
                    <img src="{{ $card['image_url'] }}" class="img-fluid" alt="{{ $card['title'] }}">
                    <div class="marketplace-card-content">
                        <h3 class="fw-bold secondry-font marketplace-card-title">{{ $card['title'] }}</h3>
                        <p class="marketplace-card-desc">{{ $card['description'] }}</p>
                        <a href="{{ $card['button_url'] }}" class="btn btn-light text-black">{{ $card['button_text'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
