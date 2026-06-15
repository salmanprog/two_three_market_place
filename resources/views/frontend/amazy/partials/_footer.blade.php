@php
    $footer_content = \Modules\FooterSetting\Entities\FooterContent::first();
    $subscribeContent = \Modules\FrontendCMS\Entities\SubscribeContent::find(1);
    $about_section = Modules\FrontendCMS\Entities\HomePageSection::where('section_name','about_section')->first();
@endphp
@if(url()->current() == url('/'))
<!--<div id="about_section" class="amaz_section section_spacing4 {{ ($about_section)? ($about_section->status == 0?'d-none':'') : ''}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_20">
                    <h3 class="m-0 flex-fill">{{ app('general_setting')->footer_about_title }}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="amaz_mazing_text">
                    @php echo app('general_setting')->footer_about_description; @endphp
                </div>
            </div>
        </div>
    </div>
</div>-->
@endif

<!-- FOOTER::START  -->
    <!--
    <footer class="home_three_footer">
        <div class="main_footer_wrap">
            <div class="container">
                 <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 footer_links_50 ">
                        <div class="footer_widget" >
                            <ul class="footer_links">
                                @foreach($sectionWidgets->where('section','1') as $page)
                                    @if($page->pageData)
                                    @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                        @continue
                                    @endif
                                    <li><a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 footer_links_50 ">
                        <div class="footer_widget">
                            <ul class="footer_links">
                                @foreach($sectionWidgets->where('section','2') as $page)
                                    @if($page->pageData)
                                        @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                            @continue
                                        @endif
                                        <li><a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6">
                        <div class="footer_widget" >

                            <div class="apps_boxs">
                                @if($footer_content->show_play_store)
                                <a href="{{$footer_content->play_store}}" class="google_play_box d-flex align-items-center mb_10">
                                    <div class="icon">
                                        <img src="{{url('/')}}/public/frontend/amazy/img/amaz_icon/google_play.svg" alt="{{__('amazy.Google Play')}}" title="{{__('amazy.Google Play')}}">
                                    </div>
                                    <div class="google_play_text">
                                        <span>{{__('amazy.Get it on')}}</span>
                                        <h4 class="text-nowrap">{{__('amazy.Google Play')}}</h4>
                                    </div>
                                </a>
                                @endif
                                @if($footer_content->show_app_store)
                                <a href="{{$footer_content->app_store}}" class="google_play_box d-flex align-items-center">
                                    <div class="icon">
                                        <img src="{{url('/')}}/public/frontend/amazy/img/amaz_icon/apple_icon.svg" alt="{{__('amazy.Apple Store')}}"  title="{{__('amazy.Apple Store')}}">
                                    </div>
                                    <div class="google_play_text">
                                        <span>{{__('amazy.Get it on')}}</span>
                                        <h4 class="text-nowrap">{{__('amazy.Apple Store')}}</h4>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <x-subscribe-component :subscribeContent="$subscribeContent"/>
                </div>
            </div>
        </div>
        <div class="copyright_area p-0">
            <div class="container">
                <div class="footer_border m-0"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copy_right_text d-flex align-items-center gap_20 flex-wrap justify-content-between">
                            @php echo app('general_setting')->footer_copy_right; @endphp
                            <div class="footer_list_links">
                                @foreach($sectionWidgets->where('section','3') as $page)
                                    @if($page->pageData)
                                        @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                            @continue
                                        @endif
                                        <a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if($footer_content->show_payment_image != 0 && $footer_content->payment_image)
                    <div class="footer_border m-0"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="payment_imgs text-center ">
                                <img class="img-fluid" src="{{showImage($footer_content->payment_image)}}" alt="{{__('common.payment_method')}}" title="{{__('common.payment_method')}}">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </footer>-->
    <footer class="bg-black pt-65 pb-50 overflow-visible">
  <div class="container">
    <div class="row justify-content-between g-4 g-lg-5">
      <div class="col-12 col-lg-4 col-xl-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="0" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
        <div class="logo" style="max-width: 250px;">
          <img src="{{ asset('public/uploads/all/68534b76c74ba.png') }}" alt="23LD" class="mb-20">
        </div>
        <p class="text-white fs-22 mb-20 primary-font" style="max-width: 410px;">Stay inspired with fresh artwork and curated collections added weekly.</p>
        <ul class="d-flex gap-20 ps-0 list-unstyled mb-0">
          <li><a href="https://www.facebook.com/TwoThreeLeggedDogs" target="_blank" class="text-white fs-25" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
          <li><a href="https://www.instagram.com/twothree_leggeddogs/" target="_blank" class="text-white fs-25" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a href="https://www.linkedin.com/company/two-three-legged-dogs-llc/?viewAsMember=true" target="_blank" class="text-white fs-25" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
          <li><a href="" target="_blank" class="text-white fs-25" aria-label="tiktok"><i class="fa-brands fa-tiktok"></i></a></li>
          <li><a href="" target="_blank" class="text-white fs-25" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a></li>
        </ul>
      </div>
      <div class="col-12 col-lg-8 col-xl-9">
        <div class="row g-4">
          <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="80" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
            <ul class="footer-links list-unstyled ps-0 mb-0">
              <li class="text-white fs-22 mb-20 fw-700 primary-font">Resources</li>
              <li class="mb-10"><a href="{{ route('frontend.about-us') }}" class="fs-22 primary-font">About Us</a></li>
              <li class="mb-10"><a href="{{ url('artists/faqs') }}" class="fs-22 primary-font">FAQ for Artists</a></li>
              <li class="mb-10"><a href="{{ url('locations/faqs') }}" class="fs-22 primary-font">FAQ for Locations</a></li>
              <li class="mb-10"><a href="{{ url('interior-designers/faqs') }}" class="fs-22 primary-font">FAQ for Interior Designers</a></li>
              <li class="mb-10"><a href="{{ url('art-galleries/faqs') }}" class="fs-22 primary-font">FAQ for Art Galleries</a></li>
              <li class="mb-10"><a href="{{ url('buyer/faqs') }}" class="fs-22 primary-font">FAQ for Collectors</a></li>
            </ul>
          </div>
          <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="160" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
            <ul class="footer-links list-unstyled ps-0 mb-0">
              <li class="text-white fs-22 mb-20 fw-700 primary-font">Art</li>
              <li class="mb-10"><a href="{{ route('frontend.artists') }}" class="fs-22 primary-font">Find Local Artists</a></li>
              <li class="mb-10"><a href="{{ route('frontend.organiser-events') }}" class="fs-22 primary-font">Find Local Events</a></li>
              <li class="mb-10"><a href="{{ url('art-services/commissions') }}" class="fs-22 primary-font">Find Local Art Services</a></li>
              <li class="mb-10"><a href="{{ url('organiser-events#find-local-art-shows') }}" class="fs-22 primary-font">Find Art Galleries</a></li>
              <li class="mb-10"><a href="{{ url('organiser-events#find-an-artist-for-your-event') }}" class="fs-22 primary-font">Find Local Locations</a></li>
              <li class="mb-10"><a href="{{ url('art-services/commissions') }}" class="fs-22 primary-font">Commission a Painting</a></li>
             
            </ul>
          </div>
          <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="240" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
            <ul class="footer-links list-unstyled ps-0 mb-0">
              <li class="text-white fs-22 mb-20 fw-700 primary-font">Partnerships</li>
              <li class="mb-10"><a href="{{ route('frontend.merchant-register-step-first') }}" class="fs-22 primary-font">Artists</a></li>
              <li class="mb-10"><a href="{{ url('art-services/commissions') }}" class="fs-22 primary-font">Art Services</a></li>
              <li class="mb-10"><a href="{{ url('locations') }}" class="fs-22 primary-font">Locations</a></li>
              <li class="mb-10"><a href="{{ url('art-galleries-museums') }}" class="fs-22 primary-font">Art Galleries</a></li>
              <li class="mb-10"><a href="{{ url('interior-designers') }}" class="fs-22 primary-font">Interior Designers</a></li>
              <li class="mb-10"><a href="{{ route('frontend.event-organiser-subscription-type') }}" class="fs-22 primary-font">Events</a></li>
            
            </ul>
          </div>
          <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="320" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">
            <ul class="footer-links list-unstyled ps-0 mb-0">
              <li class="text-white fs-22 mb-20 fw-700 primary-font">Support</li>
              <li class="mb-10"><a href="{{ route('frontend.contact-us') }}" class="fs-22 primary-font">Customer Service</a></li>
           
              <li class="mb-10"><a href="{{ route('frontend.contact-us') }}" class="fs-22 primary-font">Contact Us</a></li>
              <li class="mb-0 pt-1">
                <a href="{{ route('frontend.account.signup') }}" class="footer-support-signup-btn btn btn-light text-black primary-font fw-600 fs-18 px-5 py-16 rounded-pill text-decoration-none d-inline-flex align-items-center justify-content-center border-0 shadow-sm" style="min-width: 150px; line-height: 1; letter-spacing: .2px; transition: all .25s ease;">{{ __('defaultTheme.register') }}</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
    <!-- FOOTER::END  -->
@include('frontend.amazy.auth.partials._login_modal')
<div id="cart_data_show_div">
    @include('frontend.amazy.partials._cart_details_submenu')
</div>
<div id="cart_success_modal_div">
    @include('frontend.amazy.partials._cart_success_modal')
</div>
<input type="hidden" id="login_check" value="@if(auth()->check()) 1 @else 0 @endif">
<div class="add-product-to-cart-using-modal">

</div>

@include('frontend.amazy.partials._modals')

<div id="back-top" style="display: none;">
    <a title="{{__('common.go_to_top')}}" href="#"><i class="fas fa-chevron-up"></i></a>
</div>

@php
    $messanger_data = \Modules\GeneralSetting\Entities\FacebookMessage::first();
@endphp
@if($messanger_data->status == 1)
    @php echo $messanger_data->code; @endphp
@endif


@include('frontend.amazy.partials._script')
@stack('scripts')
@stack('wallet_scripts')

<script>
    $(document).ready(function(){
    $(".marketplace-slider").owlCarousel({
        items: 1,  // One item per slide
        loop: true,  // Enable looping
        autoplay: true,  // Enable autoplay
        autoplayTimeout: 3000,  // Autoplay interval (3 seconds)
        autoplayHoverPause: true,  // Pause on hover
        nav: true,  // Show next/prev buttons
        dots: false,  // Disable dots
        responsiveClass: true,
        responsive: {
            0: {
                items: 1  // On small screens, display 1 item
            },
            600: {
                items: 1  // On medium screens, display 1 item
            },
            1000: {
                items: 1  // On large screens, display 1 item
            }
        }
    });
});
$(document).ready(function() {
  // Remove text inside owl-prev and owl-next
  $(".marketplace-slider.owl-carousel .owl-nav .owl-prev, .marketplace-slider.owl-carousel .owl-nav .owl-next").each(function() {
    $(this).text(''); // Removes the text content (Prev and Next)
  });
});
</script>


</body>

</html>
