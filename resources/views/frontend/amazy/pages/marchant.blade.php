@extends('frontend.amazy.layouts.app')
@section('title')
    {{ $content->mainTitle }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset(asset_path('frontend/amazy/css/page_css/marchant.css')) }}" />
    <style>
        .change-height {
            max-height: max-content !important;
        }
        .acc-active{ background-color: var(--background_color) !important;
        }
    </style>
@endpush
@section('content')
    <!-- marcent top content -->
    <!-- <section class="marcent_content section_padding bg-white pb-0">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9">
                    <div class="marcent_content_iner">
                        <h5>{{ $content->subTitle }}</h5>
                        @php echo $content->Maindescription; @endphp
                        @if(app('general_setting')->disable_seller_plan==0)
                        <a href="#register"
                            class="amaz_primary_btn style3 text-nowrap mt_40">{{ __('defaultTheme.become a merchant') }}</a>
                        <span class="mt_20">{{ $content->pricing }}</span>
                        @endif

                        @if(app('general_setting')->disable_seller_plan==1)
                        <a href="{{url('/merchant-register-step-2/none')}}"
                        class="amaz_primary_btn style3 text-nowrap mt_40">{{ __('defaultTheme.become a merchant') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- marcent top content end -->
    <!-- Benefits part -->
    <!-- <section class="benefits_content section_padding bg-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_tittle">
                        <h2 class="mb_25">{{ $content->benifitTitle }}</h2>
                        @php echo $content->benifitDescription; @endphp
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($benefitList as $key => $item)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single_benefits_content">
                            <div class="benefit_img_div">
                                <img src="{{ showImage($item->image) }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                            </div>
                            <h4 class="f_w_700 font_16">{{ $item->title }}</h4>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> -->
    <!-- Benefits part end -->
    <!-- work process part here -->
    <!-- <section class="work_process section_padding bg-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_tittle">
                        <h2>{{ $content->howitworkTitle }}</h2>
                        @php echo $content->howitworkDescription; @endphp
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div id="timeline">
                        @foreach ($workProcessList as $key => $item)
                            <div class="timeline-item">
                                <div
                                    class="timeline-content work_process_single {{ $item->position == 1 ? 'left_float' : 'right_float' }}">
                                    <div class="work_img_div">
                                        <img src="{{ showImage($item->image) }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                    </div>
                                    <h4 class="f_w_700 font_16">{{ $item->title }}</h4>
                                    @php echo $item->description; @endphp
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- work process part end -->
    <!-- Benefits part -->
    @if(app('general_setting')->disable_seller_plan==0)
    <section class="pricing_part section_padding bg-white" id="register">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_tittle">
                        <h2>{{ $content->sellerRegistrationTitle }}</h2>
                        @php echo $content->sellerRegistrationDescription; @endphp
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @php
                    $total_commission = $commissions->where('status', 1)->count();
                    if($total_commission == 1){
                        $column = 'col-lg-4 offset-lg-4 col-md-6 offset-md-3';
                    }elseif($total_commission == 2){
                        $column = 'col-lg-4 offset-lg-1 col-md-6';
                    }else {
                        $column = 'col-lg-4 col-md-6';
                    }
                @endphp
                @foreach ($commissions->where('status', 1)->where('slug','!=','none') as $key => $commission)
                    <div class="{{$column}}">
                        <div class="single_pricing_part @if ($commission->id == 1) product_tricker @endif">
                            @if ($commission->id == 1)
                                <span class="product_tricker_text">{{__('defaultTheme.best value')}}</span>
                            @endif
                            <div class="pricing_header">
                                <h5>{{ $commission->name }}</h5>
                                <h2>
                                    @if ($commission->id == 1)
                                        {{ $commission->rate }} %
                                    @endif
                                </h2>
                                <p>{{ $commission->description }}</p>
                            </div>
                            <a href="{{ route('frontend.merchant-register', $commission->slug) }}"
                                class="amaz_primary_btn3 mb_20  w-100 text-center justify-content-center">{{ __('defaultTheme.choose_plan') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- Benefits part end -->
    <!-- accordion part here -->
    <!-- <section class="ferquently_question_part section_padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_tittle">
                        <h2>{{ $content->faqTitle }}</h2>
                        @php echo $content->faqDescription; @endphp
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-6">
                    <div class="ferquently_question_iner">
                        @foreach ($faqList as $key => $item)
                            <div class="single_ferquently_question">
                                <button class="accordion show-accordion" data-id='#{{ $key."id" }}'>{{ $item->title }}</button>
                                <div id="{{ $key."id" }}" class="panel">
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- accordion part end -->
    <!-- send query part here -->
    <!-- <section class="send_query section_padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <div class="section_tittle">
                        <h2>{{ $content->queryTitle }}</h2>
                        @php echo $content->queryDescription @endphp
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <form action="#" id="contactForm" name="#" class="send_query_form">
                        <div class="row">
                            <div class="col-xl-12">
                                <input name="name" id="name" placeholder="{{ __('defaultTheme.enter_name') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('defaultTheme.enter_name') }}'"
                                    class="primary_line_input style4 mb_10" type="text">
                                <span class="text-danger" id="error_name"></span>
                            </div>
                            <div class="col-xl-12">
                                <input type="email" id="email" name="email" placeholder="{{ __('defaultTheme.enter_email_address') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('defaultTheme.enter_email_address') }}'"
                                    class="primary_line_input style4 mb_10">
                                    <span class="text-danger" id="error_email"></span>
                            </div>
                            <div class="col-xl-12">
                                <select class="amaz_select2 style2 wide mb_30" name="query_type" id="query_type">
                                    <option value="" selected disable>{{ __('defaultTheme.inquery_type') }}</option>
                                    @foreach ($QueryList as $key => $item)
                                        <option  value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error_query_type"></span>
                            </div>
                            <div class="col-xl-12">
                                <textarea class="primary_line_textarea style4 mb_40" name="message" id="message" placeholder="{{ __('defaultTheme.write_messages') }}" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = '{{ __('defaultTheme.write_messages') }}'"></textarea>
                                    <span class="text-danger" id="error_message"></span>
                            </div>
                        </div>
                        <div class="send_query_btn">
                            <button id="contactBtn" type="submit"
                                class="amaz_primary_btn style3 text-nowrap">{{ __('defaultTheme.send_message') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> -->
    <!-- send query part end -->
@endsection
@push('scripts')
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#contactForm').on('submit', function(event) {
                event.preventDefault();
                $("#contactBtn").prop('disabled', true);
                $('#contactBtn').text('{{ __('common.submitting') }}');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('contact.store') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        toastr.success(
                            "{{ __('defaultTheme.message_sent_successfully') }}",
                            "{{ __('common.success') }}");
                        $("#contactBtn").prop('disabled', false);
                        $('#contactBtn').text(
                            "{{ __('defaultTheme.send_message') }}");
                        resetErrorData();
                    },
                    error: function(response) {
                        $("#contactBtn").prop('disabled', false);
                        $('#contactBtn').text(
                            "{{ __('defaultTheme.send_message') }}");
                        showErrorData(response.responseJSON.errors)
                    }
                });
            });
            $('#pricingToggle').on('change', function() {
                this.value = this.checked ? 1 : 0;
                if (this.value == 1) {
                    $('.monthly_price_div').addClass('d-none');
                    $('.yearly_price_div').removeClass('d-none');
                }
                if (this.value == 0) {
                    $('.yearly_price_div').addClass('d-none');
                    $('.monthly_price_div').removeClass('d-none');
                }
            });
            function showErrorData(errors) {
                $('#contactForm #error_name').text(errors.name)
                $('#contactForm #error_email').text(errors.email)
                $('#contactForm #error_query_type').text(errors.query_type)
                $('#contactForm #error_message').text(errors.message)
            }
            function resetErrorData() {
                $('#contactForm')[0].reset();
                $('#contactForm #error_name').text('')
                $('#contactForm #error_email').text('')
                $('#contactForm #error_query_type').text('')
                $('#contactForm #error_message').text('')
            }

            $(document).on('click','.show-accordion',function(){
               let id = $(this).attr('data-id');
               $(id).toggleClass('change-height');
               $(this).toggleClass('acc-active');

            });



        });
    })(jQuery);
</script>
@endpush
