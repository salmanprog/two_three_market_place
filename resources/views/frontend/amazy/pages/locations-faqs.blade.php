@extends('frontend.amazy.layouts.app')

@push('styles')
@endpush

@section('content')
<div class="flash_deal_banner position-relative">
    <div class="position-absolute inset-0 w-100 h-100">
        <div class="container d-flex align-items-center justify-content-center h-100">
            <div class="row">
                <div class="col-12">
                    <h2 class="faq-heading text-center mb-5">FAQ'S</h2>
                </div>
            </div>
        </div>
    </div>
    {{-- @if ($seller->role_id == "1") --}}
    <img src="{{app('general_setting')->shop_link_banner?showImage(app('general_setting')->shop_link_banner):showImage('frontend/default/img/breadcrumb_bg.png')}}" alt="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" title="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" class="img-fluid w-100">
    {{-- @else
    <img src="{{$seller->SellerAccount->banner?showImage($seller->SellerAccount->banner):showImage('frontend/default/img/breadcrumb_bg.png')}}" alt="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" title="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" class="img-fluid w-100">
    @endif --}}
</div>
<div class="new_user_section section_spacing6 pt-0">
    <div class="container">
        <div class="row justify-content-center py-30">
            <div class="col-lg-10 col-xl-8">
                <h2 class="faq-heading text-start mb-5">Location FAQ</h2>
                
                <div class="accordion custom-accordion" id="artistFaqAccordion">
                    
                    <!-- Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                               How do I set up an account with 23LD? Did we just become best friends?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                           Right here. Looking forward to being best friends! 
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                             Are we liable for the art? Who is “risking it for the biscuit”?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                          Provided the damage isn’t due to negligence, 23LD and the individual artists assume liability for your art. 
                            </div>
                        </div>
                    </div>

                    

                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                             Who is in charge of the art? (To Dev: What’s this question asking?) This is for managers or people who are in charge of the space.
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                            We are. We’ll manage the installation and rotation of art at your location. 

                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Why would I display local art when I can buy mass-printed art produced from a factory overseas? 
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                              <!-- Yes! We have community partners with whom we connect our artists and market their work and services. If something comes up that may be a good fit for you, we’ll reach out to you directly.  -->
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              Why wouldn’t you?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                               <!-- We’ll deposit what’s in your wallet into your bank account on the 1st and the 15th of every month. Only completed & verified transactions and deliveries will be available in your wallet. -->
                            </div>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                         Can I promote any event using the 23LD platform? 
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                               You can only host events that promote local art in some way using the 23LD platform. Please allow a couple of days for us to approve your event. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 7 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            How does the money work?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                              Our organizer platform is free to use. A service charge added to ticket sales that goes back to 23LD. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 8 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            Can I source artists for my event using 23LD? 
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                             Depending on the nature of your event, you can source appropriate artists using our search filter. If your event requires a more nuanced approach to connecting with artists, a 23LD rep will curate a list of local artists and connect them to you on your behalf. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 9 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            What does a “Location” mean for 23LD?
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                            A “Location” is any qualified building or space that art can elevate. We source local artists and pieces based on the Location’s needs. Additionally, Locations can host art events in their venues to attract traffic, provide a unique experience for their customers, and create a positive impact on their community.
                            </div>
                        </div>
                    </div>
                  

                    

                </div>
            </div>
        </div>
</div>
@endsection