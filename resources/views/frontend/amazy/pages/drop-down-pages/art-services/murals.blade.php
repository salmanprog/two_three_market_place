@extends('frontend.amazy.layouts.app')

@section('title')
    Murals | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Murals | {{ config('app.name') }}">
<meta name="description" content="Commission mural artists through {{ config('app.name') }} — large-scale walls, budgets, and matching the right creator.">
<meta property="og:title" content="Murals | {{ config('app.name') }}" />
<meta property="og:description" content="Murals as large-scale commissioned work — dimensions, budget, and finding the right mural artist." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Murals</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/art-services/murals.png" alt="Mural art services on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">“WOW, that’s a small painting!” — said no one ever.</h2>
                        <p>
                            Murals are large-scale, commissioned works. You’re not just buying a painting—you’re asking an artist to turn a wall into a hand-painted billboard that can boost visibility and foot traffic.
                        </p>
                        <p>
                            Sticker shock happens when people forget murals can take days (or weeks), specialized equipment, and serious skill. To help us match you with the right artist at the right price, please come prepared with:
                        </p>
                        <ul>
                            <li>Accurate wall dimensions</li>
                            <li>A realistic budget</li>
                            <li>Photos and dimensions of the wall and surrounding area (some walls require lifts, ladders, or added safety measures)</li>
                            <li>Browse our mural artists through filters or artist profiles to see past work and services offered.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
