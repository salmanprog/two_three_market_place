@extends('frontend.amazy.layouts.app')

@section('title')
How We Partner | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="How We Partner | {{ config('app.name') }}">
<meta name="description" content="How we partner with art galleries — exposure, promotion, and supporting physical spaces at {{ config('app.name') }}.">
<meta property="og:title" content="How We Partner | {{ config('app.name') }}" />
<meta property="og:description" content="How we partner with art galleries — exposure, promotion, and supporting physical spaces." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@push('styles')
<style>
    .how-partner-page {
        --hp-prose: #3a3a3a;
        --hp-heading: #0a0a0a;
        --hp-radius: 1.25rem;
        --hp-shadow: 0 24px 48px rgba(0, 0, 0, 0.08), 0 8px 16px rgba(0, 0, 0, 0.04);
        background: #F4F7F9;
    }

    .how-partner-section {
        position: relative;
    }

    .how-partner-media {
        border-radius: var(--hp-radius);
        overflow: hidden;
        box-shadow: var(--hp-shadow);
        background: #e8e8ea;
        margin: 0;
    }

    .how-partner-media img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        vertical-align: middle;
    }

    @media (min-width: 992px) {
        .how-partner-media img {
            min-height: 380px;
            max-height: 560px;
        }
    }

    .how-partner-prose {
        font-size: 1.0625rem;
        line-height: 1.75;
        color: var(--hp-prose);
    }

    .how-partner-prose p {
        margin-bottom: 1.25rem;
    }

    .how-partner-prose p:last-child {
        margin-bottom: 0;
    }

    .how-partner-lead {
        font-size: 1.125rem;
        font-weight: 600;
        line-height: 1.45;
        color: var(--hp-heading);
        margin-bottom: 1.25rem;
    }

    @media (max-width: 991.98px) {
        .how-partner-section {
            padding-top: 2.5rem !important;
            padding-bottom: 2.5rem !important;
        }
    }
</style>
@endpush

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">How We Partner</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/art-galleries/how-we-partaner.png" alt="How we partner with art galleries" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">Our goal isn’t to compete with you, but to support and promote.</h2>
                        <p>
                            See us as another avenue of exposure for your gallery and artists.
                            We charge %$#@ post your gallery on our website, artists, and the artwork your gallery displays
                        </p>
                        <p>
                            For artists who work with your gallery and want to work with us, you will come first. Why? Because you have a physical location and art is meant to be seen in person and we want to support any physical location that displays art.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
