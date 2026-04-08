@extends('frontend.amazy.layouts.app')

@section('title')
    Office Space | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Office Space | {{ config('app.name') }}">
<meta name="description" content="Bring art into offices and co-working spaces with {{ config('app.name') }} — creativity, engagement, and spaces that feel alive.">
<meta property="og:title" content="Office Space | {{ config('app.name') }}" />
<meta property="og:description" content="We help turn offices and co-working spaces into places where creativity shows up — art shapes how your team’s time in the space feels." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Office Space</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/locations/office-space.png" alt="Office and workspace art on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">"Wow. I love staring at screens while the walls around me scream meh."</h2>
                        <p>
                            Work doesn't have to feel sterile. And no—we're not saying we'll turn your office into the next Google campus (unless you want that).
                        </p>
                        <p>
                            We help turn offices and co-working spaces into places where creativity actually shows up. It's simple: people do more creative, engaged work when they're surrounded by creativity. Your team spends 40+ hours a week in your space—they basically live there. Art helps shape how that time feels.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
