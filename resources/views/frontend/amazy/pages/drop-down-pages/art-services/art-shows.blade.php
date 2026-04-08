@extends('frontend.amazy.layouts.app')

@section('title')
    Art Shows | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Art Shows | {{ config('app.name') }}">
<meta name="description" content="Host art shows with {{ config('app.name') }} — from intimate multi-artist events to full-scale venue experiences.">
<meta property="og:title" content="Art Shows | {{ config('app.name') }}" />
<meta property="og:description" content="Spaces, artists, and coordination for successful art shows — plan ahead with us and our creators." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Art Shows</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="../public/images/art-services/art-shows.png" alt="Art shows with {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
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
</div>
@endsection
