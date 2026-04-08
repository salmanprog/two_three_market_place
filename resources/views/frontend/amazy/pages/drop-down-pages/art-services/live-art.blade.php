@extends('frontend.amazy.layouts.app')

@section('title')
    Live Art | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Live Art | {{ config('app.name') }}">
<meta name="description" content="Book live art for your event through {{ config('app.name') }} — energy, spectacle, and artists who paint or perform on site.">
<meta property="og:title" content="Live Art | {{ config('app.name') }}" />
<meta property="og:description" content="Live art for events and venues — exposure, flat fees, and artists who make your gathering memorable." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Live Art</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/art-services/live-art.jpg" alt="Live art services on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">"We went out to eat, and you wouldn't believe what we saw."</h2>
                        <p>
                            Live art brings energy, conversation, and a little spectacle to any event or location. Some artists offer live art for free exposure, while others charge a flat fee.
                        </p>
                        <p>
                            Explore our artists who offer live art and make your event one people talk about.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
