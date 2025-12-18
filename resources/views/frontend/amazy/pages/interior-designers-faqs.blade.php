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
                <h2 class="faq-heading text-start mb-5">Interior Designers FAQ</h2>
                
                <div class="accordion custom-accordion" id="artistFaqAccordion">
                    
                    <!-- Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                             How do the discounts work?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                           The more you buy, the more you save. Look here to see our discount tiers for interior designers.
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                             Why would I source art with 23LD over my current art partners? 
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                          Where 23LD shines is in specifically connecting your clients with LOCAL art/artists. This saves your client money on shipping and fosters a more integrated community in your client’s backyard. 
                            </div>
                        </div>
                    </div>

                    
                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                           What is the quality of art that you guys source from?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                           Good art. 

                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Where do you guys get your color swatches?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                            We source our swatches from Benjamin Moore & Co. 
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              What if I want to see the art in person before purchasing? It's not real until I can smell the paint fumes?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#artistFaqAccordion">
                            <div class="accordion-body">
                              While some of the listed pieces are only available for viewing online, some of them are displayed in our partnered locations. Give one of them a visit.
                            </div>
                        </div>
                    </div>

                
                  
                </div>
            </div>
        </div>
</div>
@endsection