@extends('frontend.amazy.layouts.app')

@section('title')
Art Galleries & Museums | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Art Galleries | {{ config('app.name') }}">
<meta name="description" content="Art galleries — exposure, promotion, and supporting physical spaces at {{ config('app.name') }}.">
<meta property="og:title" content="Art Galleries | {{ config('app.name') }}" />
<meta property="og:description" content="Art galleries — exposure, promotion, and supporting physical spaces." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<div class="how-partner-page dropdown-main-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="how-we-partner">
        <div class="container">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">How We Partner</h1>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{ asset('public/images/art-galleries/how-we-partaner.png') }}" alt="How we partner with art galleries" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">Our goal isn’t to compete with you, but to support and promote.</h2>
                        <p>
                        See us as another avenue of exposure for your gallery and artists.
                        </p>
                        <p>
                            We charge %$#@ post your gallery on our website, artists, and the artwork your gallery displays.
                        </p>
                        <p>
                        For artists who work with your gallery and want to work with us, you will come first. Why? Because you have a physical location and art is meant to be seen in person and we want to support any physical location that displays art.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="why-23-ld">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Why 23rd LD?</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{ asset('public/images/art-galleries/why-23-ld.png') }}" alt="Why partner with 23LD for art galleries" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <p>
                            There are several reasons to choose us as a partner. We provide a free Event Organizer event that can be used by Art Galleries and Museums to promote their events. We understand that you may have your own website or advertisements but we want all of our website traffic a chance to hear about your event.
                        </p>
                        <p>
                            More customers and art patrons for your artists/gallery. We may not be able to help every customer find an artist at 23LD but that doesn’t mean we can’t refer them to you. On the flip side, there may be artists we work with that you want to invite into your gallery. Art Synergy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var HEADER_OFFSET = 120;

    function scrollToSection(hash, smooth) {
        if (!hash) return;
        var id = hash.replace(/^#/, '');
        var target = document.getElementById(id);
        if (!target) return;
        var top = target.getBoundingClientRect().top + window.pageYOffset - HEADER_OFFSET;
        window.scrollTo({ top: top, behavior: smooth ? 'smooth' : 'auto' });
    }

    function samePageHashLink(anchor) {
        try {
            var linkUrl = new URL(anchor.href, window.location.origin);
            return linkUrl.pathname === window.location.pathname && linkUrl.hash.length > 1;
        } catch (e) {
            return false;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (window.location.hash) {
            setTimeout(function () {
                scrollToSection(window.location.hash, true);
            }, 150);
        }
    });

    document.addEventListener('click', function (e) {
        var anchor = e.target.closest('a[href*="#"]');
        if (!anchor || !samePageHashLink(anchor)) return;
        e.preventDefault();
        var linkUrl = new URL(anchor.href, window.location.origin);
        history.pushState(null, '', linkUrl.pathname + linkUrl.hash);
        scrollToSection(linkUrl.hash, true);
    });
})();
</script>
@endpush
