@extends('frontend.amazy.layouts.app')

@section('title')
{{ $content->mainTitle ?? 'About Us' }} | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="{{ $content->mainTitle ?? 'About Us' }} | {{ config('app.name') }}">
<meta name="description" content="{{ $content->mainTitle ?? 'About Us' }} | {{ config('app.name') }}">
<meta property="og:title" content="{{ $content->mainTitle ?? 'About Us' }} | {{ config('app.name') }}" />
<meta property="og:description" content="{{ $content->mainTitle ?? 'About Us' }} | {{ config('app.name') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@push('styles')
<style>
    .about-page {
        --about-prose: #3a3a3a;
        --about-heading: #0a0a0a;
        --about-muted: #5c5c5c;
        --about-radius: 1.25rem;
        --about-shadow: 0 24px 48px rgba(0, 0, 0, 0.08), 0 8px 16px rgba(0, 0, 0, 0.04);
    }

    .about-page-section {
        position: relative;
    }

    .about-page-media {
        border-radius: var(--about-radius);
        overflow: hidden;
        box-shadow: var(--about-shadow);
        background: #f0f0f0;
    }

    .about-page-media img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        vertical-align: middle;
    }

    @media (min-width: 992px) {
        .about-page-media--tall img {
            min-height: 420px;
            max-height: 640px;
        }
    }

    .about-page-prose {
        font-size: 1.0625rem;
        line-height: 1.75;
        color: var(--about-prose);
    }

    .about-page-prose p {
        margin-bottom: 1.25rem;
    }

    .about-page-prose p:last-child {
        margin-bottom: 0;
    }

    .about-page-kicker {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--about-heading);
        letter-spacing: 0.02em;
        margin-bottom: 1rem !important;
    }

    .about-page-quote {
        margin: 1.75rem 0;
        padding: 1.25rem 1.5rem;
        background: linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0%, rgba(0, 0, 0, 0.02) 100%);
        border-left: 4px solid #000;
        border-radius: 0 var(--about-radius) var(--about-radius) 0;
        font-style: italic;
        color: var(--about-muted);
    }

    .about-page-quote li {
        line-height: 1.65;
    }

    .about-page-list {
        padding-left: 1.25rem;
        margin-bottom: 1.5rem;
        color: var(--about-heading);
        font-weight: 600;
    }

    .about-page-list li {
        margin-bottom: 0.5rem;
    }

    .about-page-mission {
        font-weight: 700;
        font-size: clamp(1rem, 2.5vw, 1.15rem);
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--about-heading);
        margin-top: 1.75rem;
        margin-bottom: 0.75rem !important;
    }

    .about-page-lead {
        font-size: 1.125rem;
        font-weight: 500;
        line-height: 1.7;
        color: var(--about-prose);
    }

    .about-page-features-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--about-heading);
        margin-bottom: 1.5rem;
    }

    .about-page-feature {
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }

    .about-page-feature:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .about-page-feature h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--about-heading);
        margin-bottom: 0.5rem;
    }

    .about-page-feature p {
        font-size: 0.98rem;
        line-height: 1.7;
        color: var(--about-muted);
        margin: 0;
    }

    @media (max-width: 991.98px) {
        .about-page-section {
            padding-top: 2.5rem !important;
            padding-bottom: 2.5rem !important;
        }
    }
</style>
@endpush

@section('content')

<div class="about-page bg-white">
    <!-- Our Story -->
    <section class="about-page-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Our Story</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="about-page-media about-page-media--tall mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="https://images.unsplash.com/photo-1564399580075-5dfe19c205f3?q=80&amp;w=1170&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.1.0&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid" alt="Our Story — art gallery interior" width="1170" height="780" loading="lazy" decoding="async">
                    </figure>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-page-prose primary-font ps-lg-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <p>
                            A writer and a painter walk into a bar after a long day at work.
                            The bartender looks at them and says, “You two look exhausted. What kind of business are you in?”
                            The creatives glance at each other, then back at him, and answer in unison:
                        </p>

                        <p class="about-page-kicker mb-3">Sales</p>

                        <p>
                            Because to be a successful artist, creativity isn’t enough.
                            Between marketing, networking, sales, invoicing, and everything in between, artists are expected to wear every hat—often at the expense of the work they love.
                        </p>

                        <p class="about-page-kicker mb-3">23LD exists to lighten that load.</p>

                        <p>
                            Alex (a writer) and Devin (a painter) met in a sales program and bring more than 18 years of combined experience in sales and business development.
                            Two simple questions sparked the idea for 23LD:
                        </p>

                        <div class="about-page-quote">
                            <ul class="list-unstyled mb-0 primary-font">
                                <li class="mb-3">“Why do salesmen moonlight as creatives, but creatives rarely moonlight as salesmen?”</li>
                                <li>“And why should it be so hard for creative passions to support real lives, real families, and real dreams?”</li>
                            </ul>
                        </div>

                        <p>So we built 23LD as a bridge between artists and their communities by:</p>

                        <ul class="about-page-list primary-font mb-4">
                            <li>Creating an online platform where artists can sell their work and services</li>
                            <li>Partnering with local businesses that want to display and rotate art from emerging local talent</li>
                        </ul>

                        <p class="about-page-mission">Create. Connect. Collect.</p>
                        <p>That’s our mission–and we welcome all who want to help us achieve it.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do -->
    <section class="about-page-section py-50 py-lg-100 overflow-visible border-top border-light">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">What We Do</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6 order-lg-1">
                    <div class="about-page-prose primary-font pe-lg-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <p class="about-page-lead mb-4">
                            At 23LD, we build bridges. Between artists and the people who want their work. Between local businesses and the communities they serve. Between buyers and the art being created right in their own backyard.
                        </p>

                        <p class="about-page-features-title mb-3">Our work breaks down into three parts:</p>

                        <div class="about-page-feature">
                            <h3>We help artists get seen.</h3>
                            <p>Whether it’s selling original pieces, offering creative services, or landing their work in local spaces, we connect artists to real opportunities, not algorithms.</p>
                        </div>

                        <div class="about-page-feature">
                            <h3>We help locations come alive.</h3>
                            <p>Breweries, cafés, offices, storefronts—anywhere with empty walls or the same tired prints—we bring in rotating local art that elevates the space, draws in customers.</p>
                        </div>

                        <div class="about-page-feature">
                            <h3>We help buyers discover local talent.</h3>
                            <p>People want to buy local art; they just don’t always know where to find it. We make it easy. Buyers meet the artists who live, work, and create right around them.</p>
                        </div>

                        <p class="about-page-mission mt-2">Create. Connect. Collect.</p>
                        <p>That’s what we do. And we’re building a world where local art isn’t hard to find; it’s everywhere you look.</p>
                    </div>
                </div>

                <div class="col-12 col-lg-6 order-lg-2">
                    <figure class="about-page-media about-page-media--tall mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="https://images.unsplash.com/photo-1569084024058-1632922a4e1d?q=80&amp;w=719&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.1.0&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid" alt="What We Do — art gallery interior" width="719" height="480" loading="lazy" decoding="async">
                    </figure>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
