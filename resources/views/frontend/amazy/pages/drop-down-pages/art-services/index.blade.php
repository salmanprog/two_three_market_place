@extends('frontend.amazy.layouts.app')

@section('title')
    Art Services | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Art Services | {{ config('app.name') }}">
<meta name="description" content="Art services through {{ config('app.name') }} — work directly with artists to bring your idea to life.">
<meta property="og:title" content="Art Services | {{ config('app.name') }}" />
<meta property="og:description" content="Art services — work directly with artists; we help facilitate when you need it." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="commissions">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Commissions</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="commissions-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{asset('public/images/art-services/commissions.png')}}" alt="Art commissions on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
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
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="murals">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Murals</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{asset('public/images/art-services/murals.png')}}" alt="Mural art services on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
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
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="live-art">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Live Art</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{asset('public/images/art-services/live-art.jpg')}}" alt="Live art services on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
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
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="art-shows">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Art Shows</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{asset('public/images/art-services/art-shows.png')}}" alt="Art shows with {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">"The show must go on—and so must the art."</h2>
                        <p>
                            Have a space? We've got the artists.
                        </p>
                        <p>
                            Whether you're hosting an intimate show with 1–5 artists or turning your venue into a full-scale art event, we'll help coordinate the details. Art shows take planning, so give us and the artists plenty of lead time to make it a success.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="nav-dp-wrapper murals-wrapper" id="art-classes">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black m mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Art Classes</h1>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-content-wrapper">
                        <h2 class="nav-dp-hd-md">"How did you get an F in art class?"<br>"I asked the teacher why he lives in a van—and he told me to Gogh."</h2>
                        <p>
                            Art classes are the gift that keeps on giving. Whether you're:
                        </p>
                        <ul class="nav-dp-list">
                            <li>Filling a homeschool elective</li>
                            <li>Picking up a new hobby</li>
                            <li>Leveling up your skills as an artist</li>
                            <li>Or just looking for a place where the world goes quiet</li>
                        </ul>
                        <p>
                            We'll help you find the right art teacher—locally or online. Use our filters or check artist profiles to see who offers classes.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{asset('public/images/art-services/art-class-01.png')}}" alt="art classes" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{asset('public/images/art-services/art-class-02.png')}}" alt="art classes" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{asset('public/images/art-services/art-class-03.png')}}" alt="art classes" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
