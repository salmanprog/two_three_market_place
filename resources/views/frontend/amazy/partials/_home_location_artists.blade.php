@php
    $locationArtists = siteHomePageLocationArtists();
    $aosDelays = [100, 220, 340];
@endphp
<section class="how-it-works-sec py-100 bg-black overflow-visible">
  <div class="container">
    <h2 class="fs-55 fw-700 text-center text-white mx-auto secondry-font mb-40" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic">{{ $locationArtists['heading'] }}</h2>
    <div class="row justify-content-center align-items-center row-gap-30">
      @foreach($locationArtists['items'] as $index => $item)
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="{{ $aosDelays[$index] ?? 100 }}" data-aos-easing="ease-out-cubic">
        <div class="d-flex gap-30 flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start">
          <div class="w-100 text-center text-md-start">
            <img src="{{ $item['number_image_url'] }}" alt="{{ $item['title'] }}" class="mb-20 mx-auto" style="max-width: 140px;">
          </div>
          <div>
            <div class="d-flex justify-content-center justify-content-md-start gap-10 align-items-center">
              <div>
                <img src="{{ $item['icon_image_url'] }}" alt="{{ $item['title'] }}" class="mb-20 mx-auto " style="max-width: 30px">
              </div>
              <h3 class="fs-24 fw-700 text-white secondry-font mb-10">{{ $item['title'] }}</h3>
            </div>
            <p class="fs-16 fw-400 text-white primary-font">{{ $item['description'] }}</p>
            @if(!empty($item['button_text']) && !empty($item['button_url']))
            <a href="{{ $item['button_url'] }}" class="btn btn-secondary primary-font border-gray-light text-gray-400 px-44 py-10">{{ $item['button_text'] }}</a>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
