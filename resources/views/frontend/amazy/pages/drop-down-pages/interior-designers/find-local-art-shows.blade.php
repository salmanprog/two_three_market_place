@extends('frontend.amazy.layouts.app')

@section('title')
    Find Local Art Shows | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Find Local Art Shows | {{ config('app.name') }}">
<meta name="description" content="Discover local art shows hosted by {{ config('app.name') }} locations — free and ticketed events near you.">
<meta property="og:title" content="Find Local Art Shows | {{ config('app.name') }}" />
<meta property="og:description" content="Our locations host new art shows to enjoy. Some events are free; some are ticketed — check age limits before you go." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Find Local Art Shows</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <div class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{asset('public/images/interior-designers/local-art.png')}}" alt="Find local art shows on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
</div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <p>
                            Our locations are constantly hosting new art shows for you to enjoy! Some of these events will be free, and some are ticketed.
                        </p>
                        <p>
                            Please be respectful to the artists and their art when you go!*
                        </p>
                        <p>
                            *Confirm individual events' age limits before attending.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
