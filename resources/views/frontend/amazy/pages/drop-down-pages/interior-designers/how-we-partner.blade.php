@extends('frontend.amazy.layouts.app')

@section('title')
How We Partner | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="How We Partner | {{ config('app.name') }}">
<meta name="description" content="How we partner with interior designers — discount tiers, dashboard, and art sourcing at {{ config('app.name') }}.">
<meta property="og:title" content="How We Partner | {{ config('app.name') }}" />
<meta property="og:description" content="How we partner with interior designers — discount tiers, dashboard, and art sourcing." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">How We Partner</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/interior-designers/how-we-partaner.png" alt="How we partner with interior designers" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <p>
                            We have a simple 3-tiered discount structure for interior designers based on the amount spent in a calendar year.
                        </p>
                        <p>
                            You’ll have your own administrative dashboard, filter system, and saved color palettes. We want the process of sourcing art for your clients to be easy, cost-effective, and enjoyable.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Why 23LD?</h1>

            <div class="row align-items-center g-4 g-lg-5">
            
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <p>
                            Like general contractors being the ‘Pros’ for Home Depot, interior designers are the Pros for us. We’re committed to going above and beyond for you, just like you go above and beyond for your clients.
                        </p>
                        <p>
                            Where 23LD differs from other sites you may source from is in our mission to connect your clients to local art and artists.
                        </p>
                        <p>
                            Why is that important?
                        </p>
                        <p>
                            Cost!
                        </p>
                        <p>Shipping art can cost as much as the artwork itself.</p>
                        <p>Increase your margins, save the client some money, and help a local artist; everyone’s a happy camper.</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/interior-designers/why-23-ld.png" alt="Why interior designers partner with 23LD" width="750" height="500" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


