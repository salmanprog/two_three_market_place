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
                <h2 class="faq-heading text-start mb-5">Buyer FAQ</h2>
                
                <div class="accordion custom-accordion" id="artistFaqAccordion">
                    
                    <!-- Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          How do I know my art piece is original? 
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                           Unless specifically advertised as a print, all artwork is original.
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           How do I know my painting will be safe when it's shipped? What if it is damaged?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                         We partner with Company, a proven shipping partner of art. Each shipment above a certain dollar amount is insured (right, Devin?). If your piece arrives damaged, submit a form here. You can opt for a replacement or receive a refund. 
                            </div>
                        </div>
                    </div>

                    
                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         How do I find a local artist? How do I find an artist who does classes or live art events?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                         You can filter artists and events by location. See what’s happening in your backyard.

                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              Is buying/collecting art considered a good investment? 
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                          We are an art company, so take what we say here with a grain of salt, but YES. As artists grow in renown, their pieces increase in value. Investing in an artist is like investing in a business. Imagine buying Apple stock in the 80s. Imagine buying an original Van Gogh before he was a household name. 
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            How do you commission an original piece? 
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                           Submit an inquiry on the artist profile with specifications of what you’d like (size, subject, budget, etc.), and a 23LD rep will connect with the artist to see if they accept your bid. 
                            </div>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          What if I want to return my painting?  
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                           It’d be a lot cooler if you didn’t. But of course! Like any purchase, you’ll have 5 business days to return your piece. 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection