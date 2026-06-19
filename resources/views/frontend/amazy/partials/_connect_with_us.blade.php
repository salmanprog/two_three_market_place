@php
    $siteContact = siteContactProfiles();
@endphp
@once
    @push('styles')
        <style>
            .site-contact-avatar-wrap {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                overflow: hidden;
                flex-shrink: 0;
            }
            .site-contact-avatar {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                display: block;
                border-radius: 50%;
            }
        </style>
    @endpush
@endonce
<h2 class="secondry-font text-center text-md-start fs-55 fw-400 mb-20" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">{{ $siteContact['title'] }}</h2>
@foreach($siteContact['profiles'] as $index => $profile)
    @php
        $phoneLink = preg_replace('/\D+/', '', $profile['phone'] ?? '');
        $aosDelay = 90 + ($index * 90);
    @endphp
    <div class="d-flex align-items-center flex-column flex-md-row gap-20 mb-20" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="{{ $aosDelay }}" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
        <div class="site-contact-avatar-wrap">
            <img src="{{ showImage($profile['image'] ?? null) }}" alt="{{ $profile['name'] }}" class="site-contact-avatar">
        </div>
        <div>
            <h5 class="text-center text-md-start fw-500 fs-25 primary-font">{{ $profile['name'] }}</h5>
            <div class="d-flex flex-column gap-20 row-gap-10">
                <div class="d-flex align-items-center gap-20 justify-content-center justify-content-md-start">
                    <i class="fa-solid fa-phone fs-20 text-black"></i>
                    <a href="tel:{{ $phoneLink }}" class="fs-20 p-0 text-black primary-font">{{ $profile['phone'] }}</a>
                </div>
                <div class="d-flex align-items-center gap-20">
                    <i class="fa-solid fa-envelope fs-20 text-black"></i>
                    <a href="mailto:{{ $profile['email'] }}" class="email-address-link fs-20 p-0 text-black primary-font">{{ $profile['email'] }}</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
