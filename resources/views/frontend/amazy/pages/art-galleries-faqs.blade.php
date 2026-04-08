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
<div class="new_user_section  pt-0">
    <div class="container">
        <div class="row justify-content-center py-30">
            <div class="col-lg-10 col-xl-8">
                <h2 class="faq-heading text-start mb-5">Art Gallery FAQ</h2>
                
                <div class="accordion custom-accordion" id="artistFaqAccordion">
                    <!-- Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                               How much cheddar can I expect? What’s my commission for art and services sold? 
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                               It depends on your account type. Our Beagle service offers our artists a 60% commission for artwork sold. Meanwhile, our Husky members receive 75% commission and other additional perks.
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                               I’m already the LeBron James of Artists; I have my own website, gallery representation, and make bank. Can 23LD still help me? 
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                               Of course! We’re another tool in your utility belt. See us as an additional platform of exposure for showcasing your work & services in your community. 
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              How does shipping work?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                              Coordinate a local pick up directly with the artist, or Have the piece shipped to them. The buyer is responsible for the shipping cost, which is calculated at checkout. 23LD partners with company, and will coordinate the shipping process for you. 

                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Are there other earning opportunities with 23LD? 
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                              Yes! We have community partners with whom we connect our artists and market their work and services. If something comes up that may be a good fit for you, we’ll reach out to you directly. 
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                               How soon do I get paid?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                               We’ll deposit what’s in your wallet into your bank account on the 1st and the 15th of every month. Only completed & verified transactions and deliveries will be available in your wallet.
                            </div>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                             What is the selection process? 
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                                We can’t represent anyone, and we’re dedicated to maintaining a standard for the quality of art and artists we represent. However, we believe there is a vast group of artists and art that isn’t getting represented. We will represent everyone from “up in coming” to household names.  It may take up to 3-5 business days to internally review and accept your application. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 7 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                             If I am denied, can I reapply to 23LD?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                               Yes, we believe in growth. We won’t lower our standard, but will welcome you with open arms once you have reached the necessary level to be a 23LD artist. If you still need help on how, we are here for guidance and support. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 8 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            Does 23LD have an exclusive representation of me or my artwork? 
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                              23LD doesn’t have exclusive representation of their artists, but we have exclusive representation of the specific pieces the artist chooses to list with us. The artist is free to remove and upload inventory as they will. We’re willing to work around artists’ current representation agreements. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 9 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            Who sets the price of my art?
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                              You do! We may offer advice, but the final decision is yours. Like at Burger King, “Have it your way!”
                            </div>
                        </div>
                    </div>
                    <!-- Item 10 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                           Do you accept artists from all over the world?
                            </button>
                        </h2>
                        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                             Unfortunately, we can only represent artists in the lower 48 states of the US.
                            </div>
                        </div>
                    </div>
                    <!-- Item 11 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEleven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                           What kind of art can I sell?
                            </button>
                        </h2>
                        <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                             At this time, we can only accommodate the sales of 2D media (paintings, prints, drawings, etc.). We hope to expand our capabilities to one day include 3D media. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 12 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwelve">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                        How do I sell art services, such as art classes and private commissions?
                            </button>
                        </h2>
                        <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                          When creating your profile, you list all the art services you offer. When a prospective buyer expresses interest, they will fill out an inquiry form, and a 23LD rep will connect you with all the relevant information you need to determine whether or not you’ll take the bid. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 13 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThirteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                     How is 23LD different from other online galleries? 
                            </button>
                        </h2>
                        <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                         We have an artist-first model and are dedicated to connecting local artists with local opportunities. Most of your patrons will come from your own backyard, helping you establish a reputation in your community. 
                            </div>
                        </div>
                    </div>
                    <!-- Item 14 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFourteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                    What if I am having issues setting up my profile and artist account? 
                            </button>
                        </h2>
                        <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                         Technology is hard, we get it. Send us an inquiry here explaining your issue, and we’ll get back to you ASAP with a solution. 
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
</div>
@endsection