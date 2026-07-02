@extends('frontend.amazy.layouts.app')

@section('title')
Art Services | {{ config('app.name') }}
@endsection

@push('styles')
@endpush

@section('content')
<div class="dropdown-main-page">
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="commissions">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Commissions</h2>
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="commissions-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{asset('public/images/art-services/commissions.png')}}" alt="Art commissions on {{ config('app.name') }}" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">“Can you paint me a cow in a bathtub wearing a top hat?” Absolutely.</h2>
                        <p>
                            Our artists love commissions that push their creativity. Just know: commissions aren’t the same as artwork created purely from the artist’s own vision. They often take more time, energy, and collaboration—which is why they usually cost more.
                        </p>
                        <p>
                            23LD lets the artist and client work directly together to bring the idea to life. We’ll help facilitate as needed, but the magic happens between you and the artist. Use our filters or visit artist profiles to find creators who offer commissions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="murals">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Murals</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{('public/images/art-services/murals.png')}}" alt="Mural art services on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">“WOW, that’s a small painting!” — said no one ever.</h2>
                        <p>
                            Murals are large-scale, commissioned works. You’re not just buying a painting—you’re asking an artist to turn a wall into a hand-painted billboard that can boost visibility and foot traffic.
                        </p>
                        <p>
                            Sticker shock happens when people forget murals can take days (or weeks), specialized equipment, and serious skill. To help us match you with the right artist at the right price, please come prepared with:
                        </p>
                        <ul>
                            <li>Accurate wall dimensions</li>
                            <li>A realistic budget</li>
                            <li>Photos and dimensions of the wall and surrounding area (some walls require lifts, ladders, or added safety measures)</li>
                            <li>Browse our mural artists through filters or artist profiles to see past work and services offered.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="live-art">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Live Art</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{('public/images/art-services/live-art.jpg')}}" alt="Live art services on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="how-partner-prose primary-font ps-lg-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <h2 class="how-partner-lead secondry-font">"We went out to eat, and you wouldn't believe what we saw."</h2>
                        <p>
                            Live art brings energy, conversation, and a little spectacle to any event or location. Some artists offer live art for free exposure, while others charge a flat fee.
                        </p>
                        <p>
                            Explore our artists who offer live art and make your event one people talk about.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="art-shows">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Art Shows</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{('public/images/art-services/art-shows.png')}}" alt="Art shows with {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
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
    <section class="nav-dp-wrapper murals-wrapper" id="art-classes">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-55 fw-700 text-center text-black m mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Art Classes</h2>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-content-wrapper">
                        <h2 class="nav-dp-hd-md">"How did you get an F in art class?"<br>"I asked the teacher why he lives in a van—and he told me to Gogh."</h2>
                        <p>
                            Art classes are the gift that keeps on giving. Whether you're:
                        </p>
                        <ul class="nav-dp-list">
                            <li>Filling a homeschool elective</li>
                            <li>Picking up a new hobby</li>
                            <li>Leveling up your skills as an artist</li>
                            <li>Or just looking for a place where the world goes quiet</li>
                        </ul>
                        <p>
                            We'll help you find the right art teacher—locally or online. Use our filters or check artist profiles to see who offers classes.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/art-services/art-class-01.png')}}" alt="art classes" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/art-services/art-class-02.png')}}" alt="art classes" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/art-services/art-class-03.png')}}" alt="art classes" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="locations/office-space">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Office Space</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{('public/images/locations/office-space.png')}}" alt="Office and workspace art on {{ config('app.name') }}" width="750" height="500" loading="lazy" decoding="async">
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
    <section class="nav-dp-wrapper" id="locations/hospitality">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Hospitality</h2>
                </div>
                <div class="col-lg-4">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/locations/hospitality.png')}}" alt="hospitality">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/locations/hospitality-02.png')}}" class="w-100" style="max-height: 340px;" alt="hospitality">
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
    <section class="nav-dp-wrapper" id="locations/churches">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Churches</h2>
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
                        <img src="{{('public/images/locations/churches.png')}}" alt="churches">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/locations/churches-02.png')}}" alt="churches">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="nav-dp-wrapper" id="locations/non-profits">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Non Profits</h2>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/locations/non-profits.png')}}" alt="non-profits">
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
    <section class="nav-dp-wrapper" id="locations/government">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Government</h2>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper reduce-img-size">
                        <img src="{{('public/images/locations/government.jpg')}}" alt="government">
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
    <section class="nav-dp-wrapper medical-wrapper" id="locations/medical">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Medical</h2>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper reduce-img-size">
                        <img src="{{('public/images/locations/medical.jpg')}}" alt="medical">
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
    <section class="nav-dp-wrapper" id="locations/schools">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Schools</h2>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/locations/schools.jpg')}}" alt="schools">
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
                <div class="account-signup-sec">
                    @guest
                    <a href="{{ route('frontend.event-organiser-register','subscription') }}" class="account-signup-btn primary-font">
                        Partner as a Location
                        <i class="fa-solid fa-arrow-right-long fs-12" aria-hidden="true"></i>
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
    <section class="nav-dp-wrapper" id="events/find-an-artist-for-your-event">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h2 class="secondry-font fs-50 fw-700 text-center text-black  line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Find an Artist for Your Event</h2>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="{{('public/images/interior-designers/find-an-artist.png')}}" alt="find-an-artist">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-content-wrapper">
                        <!-- <h2 class="nav-dp-hd-md">Our goal isn’t to compete with you, but to support and promote. </h2> -->
                        <p>
                            We allow anyone to use our Event Organizer. All art events have to meet the requirements and be pre-approved. Locations have special discounts and access to our artists. Our Event Organizer will allow you to host your own art shows!
                        </p>
                        <p>Filter through local artists, send them a request, and the artist will reply to your invitation. Once you have the artists you want and have decided on the ticket price, post your event and start promoting to your heart’s desire. </p>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-partner-section py-50 py-lg-100 overflow-visible" id="art-galleries/how-we-partner">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">How We Partner</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{('public/images/art-galleries/how-we-partaner.png')}}" alt="How we partner with art galleries" width="750" height="500" loading="lazy" decoding="async">
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
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Why 23LD?</h2>

            <div class="row align-items-center g-4 g-lg-5">

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
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{('public/images/art-galleries/why-23-ld.png')}}" alt="Why partner with 23LD for art galleries" width="750" height="500" loading="lazy" decoding="async">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <section class="how-partner-section py-50 py-lg-100 overflow-visible">
        <div class="container">
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">How We Partner</h2>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-6">
                    <figure class="how-partner-media mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
                        <img src="{{('public/images/interior-designers/how-we-partaner.png')}}" alt="How we partner with interior designers" width="750" height="500" loading="lazy" decoding="async">
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
            <h2 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Why 23LD?</h2>

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
                        <img src="{{('public/images/interior-designers/why-23-ld.png')}}" alt="Why interior designers partner with 23LD" width="750" height="500" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    (function() {
        var HEADER_OFFSET = 120;

        function scrollToSection(hash, smooth) {
            if (!hash) return;
            var id = hash.replace(/^#/, '');
            var target = document.getElementById(id);
            if (!target) return;
            var top = target.getBoundingClientRect().top + window.pageYOffset - HEADER_OFFSET;
            window.scrollTo({
                top: top,
                behavior: smooth ? 'smooth' : 'auto'
            });
        }

        function samePageHashLink(anchor) {
            try {
                var linkUrl = new URL(anchor.href, window.location.origin);
                return linkUrl.pathname === window.location.pathname && linkUrl.hash.length > 1;
            } catch (e) {
                return false;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash) {
                setTimeout(function() {
                    scrollToSection(window.location.hash, true);
                }, 150);
            }
        });

        document.addEventListener('click', function(e) {
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