@extends('frontend.amazy.layouts.app')

@section('title')
{{ __('common.merchants') }}
@endsection

@section('content')
<div class="artists-list-page amazy_section_padding">
    <div class="container">
        @include('frontend.amazy.partials._artists_filter_section', ['idPrefix' => ''])

        @if ($sellers->isNotEmpty())
        <div class="row">
            <div class="col-12">
                <div class="pagination_part pt-2">
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<section class="how-partner-section py-50 py-lg-100 overflow-visible" id="why-23-ld">
    <div class="container">
        <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Why 23rd LD?</h1>

        <div class="row align-items-center g-4 g-lg-5">

            <div class="col-12 col-lg-6">
                <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
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
                    <ul>
                        <li>Art classes & workshops</li>
                        <li>Commissioned artwork</li>
                        <li>Private shows & events</li>
                        <li>Mural projects</li>
                        <li>Live painting opportunities</li>
                    </ul>
                    <p>
                        Local businesses and venues looking to display artwork
                    </p>
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
                    <p>
                        We focus on local ecosystems. Instead of competing against artists across the country, you'll primarily be connected with buyers, businesses, interior designers, and opportunities in your own community.
                    </p>
                    <p>
                        To maintain quality and opportunity density, we also place limits on the number of artists we represent in each market.
                    </p>
                    <p class="text-black fw-600">
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
            <div class="col-12 col-lg-6"
                style="
                position: sticky;
                top: 14px;
                ">
                <div class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                    <img src="{{asset('public/images/interior-designers/why-23-ld.png')}}" alt="Why interior designers partner with 23LD" width="750" height="500" loading="lazy" decoding="async">
                </div>
            </div>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto">
                <div class="account-signup-sec" style="background: transparent !important;">
                    @guest
                    <a href="./merchant-register-step-2/subscription" class="account-signup-btn primary-font">
                    Become a Featured Artist
                        <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@include('frontend.amazy.partials._artists_filter_script', [
'idPrefix' => '',
'scopeId' => null,
])
@endpush