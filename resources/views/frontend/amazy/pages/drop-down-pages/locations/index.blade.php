@extends('frontend.amazy.layouts.app')
@push('styles')
<style>
    .location-tier-card {
        border: 1px solid gray;
        border-radius: 20px;
        padding: 30px;
        background: #fff;
        position: relative;
        height: 100%;
        text-align: left;
        transition: all 0.3s ease;
    }
    .location-tier-card:hover {
        box-shadow: 0 10px 40px rgba(43, 54, 228, 0.1);
    }
    .location-tier-icon__placeholder {
        width: 100%;
        aspect-ratio: 4 / 3;
        border: 1px dashed #bbb;
        border-radius: 16px;
        background: #f7f7f7;
        color: #777;
        text-align: center;
        padding: 1rem;
    }
    .location-tier-card .plan_title {
        font-size: 28px;
        color: #000;
        font-weight: 500;
        margin-bottom: 0;
        line-height: 1.2;
    }
    .location-tier-card .discount_badge {
        background: #ffeeb2;
        color: #333;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 4px;
        display: inline-block;
        white-space: nowrap;
    }
    .location-tier-card .big_price {
        font-size: 56px;
        color: #000;
        font-weight: 500;
        line-height: 1;
        margin-right: 10px;
    }
    .location-tier-card .price_meta {
        font-size: 14px;
        line-height: 1.3;
        color: #000;
        font-weight: 500;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .location-tier-card .feature_divider {
        border-top: 1px solid #eee;
        margin-bottom: 25px;
    }
    .location-tier-card .feature_list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .location-tier-card .feature_list li {
        font-size: 14px;
        color: #333;
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
    }
    .location-tier-card .feature_list li i {
        margin-right: 12px;
        color: #888;
        font-size: 14px;
        margin-top: 4px;
    }
    .location-tier-notes {
        max-width: 920px;
    }
    .location-tier-notes li {
        font-size: 15px;
        color: #333;
        margin-bottom: 10px;
    }
    @media (max-width: 767px) {
        .location-tier-card {
            margin-bottom: 24px;
        }
        .location-tier-card .big_price {
            font-size: 40px;
        }
        .location-tier-card .plan_title {
            font-size: 25px;
        }
    }
</style>
@endpush
@section('content')
<section class="how-partner-section py-50 py-lg-100 overflow-visible" id="office-space">
    <div class="container">
        <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Office Space</h1>

        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-12 col-lg-6">
                <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                    <img src="{{asset('public/images/locations/office-space.png')}}" alt="Office and workspace art on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
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
<section class="nav-dp-wrapper" id="hospitality">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Hospitality</h1>
            </div>
            <div class="col-lg-4">
                <div class="nav-dp-img-wrapper">
                    <img src="{{asset('public/images/locations/hospitality.png')}}" alt="hospitality">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="nav-dp-img-wrapper">
                    <img src="{{asset('public/images/locations/hospitality-02.png')}}" class="w-100" style="max-height: 340px;" alt="hospitality">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="nav-dp-content-wrapper">
                    <h2 class="nav-dp-hd-md">"Hotels, Airbnbs, Restaurants—oh my!"</h2>
                    <p>
                        Wherever people spend their time, local art leaves a mark.
                    </p>
                    <p>
                        Sometimes it's a fuzzy feeling that keeps them coming back.
                    </p>
                    <p>
                        Other times, it's a clear signal: we care about this community.
                    </p>
                    <p>
                        Either way, displaying local art doesn't just make our artists happy.
                    </p>
                    <p>
                        It makes your regulars happy, too.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="nav-dp-wrapper" id="churches">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Churches</h1>
            </div>

            <div class="col-lg-12">
                <div class="nav-dp-content-wrapper">
                    <h2 class="nav-dp-hd-md">The Church was once the largest patron of the arts.</h2>
                    <p>
                        What happened?
                    </p>
                    <p>
                        Michelangelo, Leonardo—and the rest of the Ninja Turtles—would be pinching pennies today if they relied on church commissions like they did during the Renaissance.
                    </p>
                    <p>
                        Over time, the Church stepped away from supporting fine art.
                    </p>
                    <p>
                        23LD wants to help bring that tradition back—connecting artists with spaces meant to inspire, reflect, and uplift.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-img-wrapper">
                    <img src="{{asset('public/images/locations/churches.png')}}" alt="churches">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-img-wrapper">
                    <img src="{{asset('public/images/locations/churches-02.png')}}" alt="churches">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="nav-dp-wrapper" id="non-profits">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Non Profits</h1>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-img-wrapper">
                    <img src="{{asset('public/images/locations/non-profits.png')}}" alt="non-profits">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-content-wrapper">
                    <h2 class="nav-dp-hd-md">We're here to put the "profit" in "non-profit."</h2>
                    <p>
                        Silent auctions, live paintings, art shows, workshops, classes—
                        host art-driven events through our platform to raise funds, build community, and support your cause.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="nav-dp-wrapper" id="government">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Government</h1>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-img-wrapper reduce-img-size">
                    <img src="{{asset('public/images/locations/government.jpg')}}" alt="government">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-content-wrapper">
                    <h2 class="nav-dp-hd-md">"Where's my bust of George Washington?"</h2>
                    <p>
                        Paintings and sculptures are how we immortalized the founding fathers and wouldn't have known what they looked like without the artists who made history through art.
                    </p>
                    <p>
                        Art history is embedded in the government and should continue to be the case. 23LD works with local, city, state, and federal governments to provide the next art pieces to commemorate the people who serve our country.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="nav-dp-wrapper medical-wrapper" id="medical">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Medical</h1>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-img-wrapper reduce-img-size">
                    <img src="{{asset('public/images/locations/medical.jpg')}}" alt="medical">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-content-wrapper">
                    <h2 class="nav-dp-hd-md">"When I'm at the hospital the snacks are….whack….cafeteria food…. whack….chairs…..whack…..this art……uhhh pretty cool"</h2>
                    <p>
                        No one likes waiting to see their loved ones in the waiting room. No one likes being in a hospital bed stuck with whatever is available on the TV that has 12 channels. No one likes the sterile feeling you get from the colors, smell, and lights in the hospital.
                    </p>
                    <p>
                        Why not provide your patients with color? Paintings that provide hope and peace as your patients and their families are waiting. Live art for people in the waiting room or long term patients, so they can keep their mind occupied.
                    </p>
                    <p>
                        Let us help you find an artist and art for your hospital!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="nav-dp-wrapper" id="schools">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Schools</h1>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-img-wrapper">
                    <img src="{{asset('public/images/locations/schools.jpg')}}" alt="schools">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav-dp-content-wrapper">
                    <h2 class="nav-dp-hd-md">"When did you start your art career?" "Kindergarten!"</h2>
                    <p>
                        Art begins with children. Schools are the playground for artists. Where artists found they could create without pressure or expectations. Murals are a great way to inspire the student body. Artists coming by to perform events or host shows inspire the next generation.
                    </p>
                    <p>
                        23LD believes in helping the next generation find their creativity. Whether it's ABC's or college degrees, we will find artists to connect your students with.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-4 mx-auto">
            <div class="account-signup-sec" style="background: transparent !important;">
                @guest
                <a href="{{ route('frontend.event-organiser-register', 'subscription') }}" class="account-signup-btn primary-font">
                    Partner as a Location
                    <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                </a>
                @endguest
            </div>
        </div>
    </div>
</section>

<section class="how-partner-section py-50 py-lg-100 overflow-visible bg-white" id="service-tiers">
    <div class="container">
        <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Service Tiers</h2>

        <div class="row justify-content-center g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="0">
                <div class="location-tier-card">
                    <div class="location-tier-icon mb-4">
                        {{-- Replace with Beagle breed image/icon --}}
                        <div class="location-tier-icon__placeholder primary-font">
                            <span>Beagle image / icon placeholder</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="plan_title secondry-font">Beagle</h3>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price secondry-font">Free</span>
                        </div>
                    </div>
                    <div class="feature_divider"></div>
                    <ul class="feature_list primary-font">
                        <li><i class="fas fa-check"></i> Access to our online platform to host ticketed events.</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="100">
                <div class="location-tier-card">
                    <div class="location-tier-icon mb-4">
                        {{-- Replace with Husky breed image/icon --}}
                        <div class="location-tier-icon__placeholder primary-font">
                            <span>Husky image / icon placeholder</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="plan_title secondry-font">Husky</h3>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price secondry-font">$25</span>
                            <div class="price_meta primary-font">
                                <span>/painting</span>
                                <span>/year</span>
                            </div>
                        </div>
                    </div>
                    <div class="feature_divider"></div>
                    <ul class="feature_list primary-font">
                        <li><i class="fas fa-check"></i> Access to our online platform to host ticketed events.</li>
                        <li><i class="fas fa-check"></i> Source local art for your location.</li>
                        <li><i class="fas fa-check"></i> Art installation &amp; sales facilitation.</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
                <div class="location-tier-card">
                    <div class="location-tier-icon mb-4">
                        {{-- Replace with Mastiff breed image/icon --}}
                        <div class="location-tier-icon__placeholder primary-font">
                            <span>Mastiff image / icon placeholder</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="plan_title secondry-font">Mastiff</h3>
                        <span class="discount_badge primary-font">{{ __('defaultTheme.best value') }}</span>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price secondry-font">$150</span>
                            <div class="price_meta primary-font">
                                <span>/painting</span>
                                <span>/year</span>
                            </div>
                        </div>
                    </div>
                    <div class="feature_divider"></div>
                    <ul class="feature_list primary-font">
                        <li><i class="fas fa-check"></i> Access to our online platform to host ticketed events.</li>
                        <li><i class="fas fa-check"></i> Source local art for your location.</li>
                        <li><i class="fas fa-check"></i> Art installation &amp; sales facilitation.</li>
                        <li><i class="fas fa-check"></i> Source art from more established, premium artists with more renown.</li>
                        <li><i class="fas fa-check"></i> Seasonal rotations of art to match your desired aesthetic.</li>
                        <li><i class="fas fa-check"></i> Business features on social media and marketing campaigns.</li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="location-tier-notes primary-font mx-auto mt-40 mb-0 ps-3" data-aos="fade-up" data-aos-duration="900" data-aos-delay="260">
            <li>Events generate $1.50 per ticket sale to 23LD in service charges.</li>
            <li>Art sales at the Mastiff/Husky locations generate 25% commission to 23LD on artwork sold (art is supplied by Husky artists).</li>
        </ul>
    </div>
</section>
@endsection