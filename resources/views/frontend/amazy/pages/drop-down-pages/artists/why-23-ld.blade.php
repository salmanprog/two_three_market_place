@extends('frontend.amazy.layouts.app')

@section('title')
Why 23LD | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Why 23LD | {{ config('app.name') }}">
<meta name="description" content="Why artists partner with {{ config('app.name') }} — local opportunities, income streams, and more time to create.">
<meta property="og:title" content="Why 23LD | {{ config('app.name') }}" />
<meta property="og:description" content="Why artists partner with us — local opportunities, income streams, and more time to create." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="why-23-ld">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Why 23LD</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="how-partner-prose primary-font pe-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <p>
                            Making it as an artist is about more than just the quality of your work—you’re running a business, maintaining a website, marketing, managing social media, booking events, networking…
                        </p>
                        <p>
                            And finding time for your craft outside of all that.
                        </p>
                        <p>
                            Our mission isn't just to sell your art (don’t worry—that’s definitely part of it).
                        </p>
                        <p>
                            It’s to remove the barriers that keep you from focusing on what you do best: creating. We handle the relationship-building, promotion, and opportunity sourcing while connecting you with your local community.
                        </p>
                        <p>
                            Art sales are only one piece of the puzzle. We help connect artists with opportunities that generate income, visibility, and long-term relationships:
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <div class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{ asset('public/images/artists/why-23-ld.webp') }}" alt="Artist focused on creating while 23LD handles business and promotion" width="750" height="500" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <div class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{ asset('public/images/artists/artist-opportunities.webp') }}" alt="Art classes, commissions, murals, and live painting opportunities for artists" width="750" height="500" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                     
                        <ul>
                            <li>Art classes &amp; workshops</li>
                            <li>Commissioned artwork</li>
                            <li>Private shows &amp; events</li>
                            <li>Mural projects</li>
                            <li>Live painting opportunities</li>
                            <li>Local businesses and venues looking to display artwork</li>
                        </ul>
                        <p>
                            We create multiple sources of consistent income and different avenues to work in your community.
                        </p>
                        <p>
                            “What if you guys end up taking on so many artists that I get lost in the fold?”
                        </p>
                        <p>
                            Glad you asked, because you won’t.
                        </p>
                        <p>
                            Most online art platforms have thousands of artists competing for attention.
                        </p>
                        <p>
                            That’s not our model.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="how-partner-prose primary-font pe-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                    
                     
                        <p>
                            We focus on local ecosystems. Instead of competing against artists across the country, you'll primarily be connected with buyers, businesses, interior designers, and opportunities in your own community.
                        </p>
                        <p>
                            To maintain quality and opportunity density, we also place limits on the number of artists we represent in each market.
                        </p>
                        <p>
                            The unfortunate truth is:
                        </p>
                        <p>
                            In most artist–gallery relationships, the artist gets the short end of the stick.
                        </p>
                        <p>
                            We’d like to turn that on its head by giving you more opportunities, more exposure, and some of the best commission rates in the market.
                        </p>
                        <p>
                            We're building something bigger than an art marketplace.
                        </p>
                        <p>
                            We're building local creative communities where artists can earn more, connect more, and spend less time chasing opportunities.
                        </p>
                        <p>
                            When our artists succeed, we succeed.
                        </p>
                        <p>
                            That's the entire point.
                        </p>
                        <p>
                            Discover. Connect. Collect.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <div class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{ asset('public/images/artists/artist-local-community.webp') }}" alt="Local creative community where artists connect, earn, and grow" width="750" height="500" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-partner-section pb-50 pb-lg-100 overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-5 mx-auto text-center">
                    <div class="account-signup-sec" style="background: transparent !important;">
                        @guest
                        <a href="{{ route('frontend.merchant-register', 'subscription') }}" class="account-signup-btn primary-font">
                            Become a Featured Artist
                            <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
