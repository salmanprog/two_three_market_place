@extends('frontend.amazy.layouts.app')

@push('styles')
    <style>
        .cursor_pointer{
            cursor: pointer!important;
        }

        .amaz_primary_btn.secondary{
            background: var(--text_color);
            border-color: var(--text_color);
        }
        .amaz_primary_btn.secondary:hover{
            background: var(--base_color);
            border-color: var(--base_color);
        }
    </style>
@endpush

@section('content')
<section class="pricing_part section_padding bg-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6 col-md-10 mb_50">
                <div class="section__title">
                    <h3 class="mb_40">Art Galleries</h3>
                    Turn your business into an art gallery—at cost.
                    This is for prospects considering using us to create a physical gallery space out of their business:
                </div>
            </div>
        </div>
        <div class="row justify-content-center" >

          
            <div class="col-lg-4 col-md-6">
                <div class="single_pricing_part">
                    <div class="price_icon">
                        <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.0979 1.8541C26.6966 0.0114833 29.3034 0.0114799 29.9021 1.8541L34.9599 17.4205C35.2277 18.2445 35.9956 18.8024 36.862 18.8024H53.2295C55.1669 18.8024 55.9725 21.2817 54.4051 22.4205L41.1635 32.041C40.4625 32.5503 40.1692 33.453 40.437 34.2771L45.4948 49.8435C46.0935 51.6861 43.9845 53.2183 42.4171 52.0795L29.1756 42.459C28.4746 41.9497 27.5254 41.9497 26.8244 42.459L13.5829 52.0795C12.0155 53.2183 9.9065 51.6861 10.5052 49.8435L15.563 34.2771C15.8308 33.453 15.5375 32.5503 14.8365 32.041L1.59493 22.4205C0.0275064 21.2817 0.833055 18.8024 2.7705 18.8024H19.138C20.0044 18.8024 20.7723 18.2445 21.0401 17.4205L26.0979 1.8541Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="pricing_header">
                        <h5>Basic Yearly</h5>
                        <div class="w-100">
                            <img src="{{ showImage('frontend/amazy/img/6438ce493d38b.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="monthly_price_div">
                            <h2>$25.00</h2>
                            <p>Painting/{{__('defaultTheme.per year')}}</p>
                        </div>
                    </div>
                    <ul class="mb-5">
                        <li>Art installation with labels.</li>
                        <li>Art sales facilitation</li>
                        <li>Receive a commission for art sold</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_pricing_part">
                    <div class="price_icon">
                        <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.0979 1.8541C26.6966 0.0114833 29.3034 0.0114799 29.9021 1.8541L34.9599 17.4205C35.2277 18.2445 35.9956 18.8024 36.862 18.8024H53.2295C55.1669 18.8024 55.9725 21.2817 54.4051 22.4205L41.1635 32.041C40.4625 32.5503 40.1692 33.453 40.437 34.2771L45.4948 49.8435C46.0935 51.6861 43.9845 53.2183 42.4171 52.0795L29.1756 42.459C28.4746 41.9497 27.5254 41.9497 26.8244 42.459L13.5829 52.0795C12.0155 53.2183 9.9065 51.6861 10.5052 49.8435L15.563 34.2771C15.8308 33.453 15.5375 32.5503 14.8365 32.041L1.59493 22.4205C0.0275064 21.2817 0.833055 18.8024 2.7705 18.8024H19.138C20.0044 18.8024 20.7723 18.2445 21.0401 17.4205L26.0979 1.8541Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="pricing_header">
                        <h5>Premium Yearly</h5>
                        <div class="w-100">
                            <img src="{{ showImage('frontend/amazy/img/6438ce493d38b.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="monthly_price_div">
                            <h2>$50.00</h2>
                            <p>Painting/{{__('defaultTheme.per year')}}</p>
                        </div>
                    </div>
                    <ul class="mb-5">
                        <li>All services in the Basic Tier</li>
                        <li>Seasonal rotations of the artwork in your business, curated to meet your desired aesthetic.</li>
                        <li>Access to our online platform to host and promote art shows and other events.</li>
                        <li>Business advertisements & features on social media, as well as marketing campaigns.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-us-sec pb-100">
    <div class="container">
        <div class="row align-items-center row-gap-40">
            <div class="col-12 col-md-12">
                <h2 class="secondry-font text-start fs-55 fw-400 mb-20">Contact Us</h2>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('frontend.contact.us') }}" method="POST">
                    @csrf
                    <div class="row row-gap-20">
                        <div class="col-12 col-sm-6">
                            <input type="text"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                placeholder="First Name"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('first_name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <input type="text"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                placeholder="Last Name"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('last_name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('email')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <input type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Phone"
                                class="primary-font border-gray-light fs-16 px-16 py-18 input-field w-100">
                            @error('phone')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">    
                            <textarea name="message"
                                    rows="5"
                                    placeholder="Message"
                                    class="primary-font border-gray-light fs-16 px-16 py-18 text-area w-100">{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="position-relative w-100">
                                <select name="service"
                                        id="service"
                                        class="primary-font border-gray-light fs-16 px-16 py-18 input-field">
                                    <option disabled selected>Which art are you interested in?</option>
                                    <option value="$25/painting/year" {{ old('service') == '$25/painting/year' ? 'selected' : '' }}>$25/painting/year</option>
                                    <option value="$50/painting/year" {{ old('service') == '$50/painting/year' ? 'selected' : '' }}>$50/painting/year</option>
                                </select>
                                <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-17 text-black me-3 pe-none"></i>
                            </div>
                            @error('service')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit"
                                    class="btn btn-primary radius-60 bg-black text-white primary-font py-17 px-30 fs-16">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $('#pricingToggle').on('change', function(){
                this.value = this.checked ? 1 : 0;
                if(this.value == 1){
                    $('#type').val('yearly');
                    $('.monthly_price_div').addClass('d-none');
                    $('.yearly_price_div').removeClass('d-none');
                }
                if(this.value == 0){
                    $('#type').val('monthly');
                    $('.yearly_price_div').addClass('d-none');
                    $('.monthly_price_div').removeClass('d-none');
                }
            });
            $(document).on('click','.select_btn_price', function(){
                event.preventDefault();
                $('#id').val($(this).attr("data-id"));
                $('.price_subscription_add').submit();
            });
        });
    })(jQuery);
</script>
@endpush
