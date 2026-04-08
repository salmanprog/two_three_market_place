@extends('frontend.amazy.layouts.app')

@section('title')
    Commissions | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Commissions | {{ config('app.name') }}">
<meta name="description" content="Commission original art through {{ config('app.name') }} — work directly with artists to bring your idea to life.">
<meta property="og:title" content="Commissions | {{ config('app.name') }}" />
<meta property="og:description" content="Commission original art — work directly with artists; we help facilitate when you need it." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Commissions</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/art-services/commissions.png" alt="Art commissions on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">“Can you paint me a cow in a bathtub wearing a top hat?” Absolutely.</h2>
                        <p>
                            Our artists love commissions that push their creativity. Just know: commissions aren’t the same as artwork created purely from the artist’s own vision. They often take more time, energy, and collaboration—which is why they usually cost more.
                        </p>
                        <p>
                            23LD lets the artist and client work directly together to bring the idea to life. We’ll help facilitate as needed, but the magic happens between you and the artist. Use our filters or visit artist profiles to find creators who offer commissions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
