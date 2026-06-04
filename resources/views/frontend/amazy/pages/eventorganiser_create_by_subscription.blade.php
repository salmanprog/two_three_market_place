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

        /* New Pricing Card Styles */
        .new_pricing_card {
            border: 1px solid gray;
            border-radius: 20px;
            padding: 30px;
            background: #fff;
            position: relative;
            height: 100%;
            text-align: left;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }
        .new_pricing_card:hover {
            box-shadow: 0 10px 40px rgba(43, 54, 228, 0.1);
        }
        .plan_title {
            font-size: 28px;
            color: black;
            font-weight: 500;
            margin-bottom: 0;
            line-height: 1.2;
        }
        .discount_badge {
            background: #ffeeb2;
            color: #333;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 4px;
            display: inline-block;
            white-space: nowrap;
        }
        .big_price {
            font-size: 56px;
            color: black;
            font-weight: 500;
            line-height: 1;
            margin-right: 10px;
        }
        .price_meta {
            font-size: 14px;
            line-height: 1.3;
            color: #000;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .billed_yearly {
            font-size: 15px;
            color: #000;
            margin-top: 8px;
            font-weight: 400;
        }
        .cta_btn {
            background-color: black;
            color: #fff !important;
            display: block;
            width: 100%;
            text-align: center;
            padding: 14px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            text-decoration: none;
            transition: background 0.3s;
            border: none;
        }
        .cta_btn:hover {
            background-color: #1F1F1F;
        }
        .feature_divider {
            border-top: 1px solid #eee; /* Light gray line */
            margin-bottom: 25px;
        }
        .feature_list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .feature_list li {
            font-size: 14px;
            color: #333;
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }
        .feature_list li i {
            margin-right: 12px;
            color: #888;
            font-size: 14px;
            margin-top: 4px;
        }

        @media (max-width: 767px) {
            .new_pricing_card {
                margin-bottom: 40px;
            }
            .big_price {
                font-size: 40px;
            }
            .plan_title {
                font-size: 25px;
            }
        }
    </style>
@endpush

@section('content')
<section class="pricing_part section_padding bg-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6 col-md-10 mb_50">
                <div class="section__title">
                    <h3 class="mb_40">Locations Subscription</h3>
                    Event organizing involves the planning, coordination, and execution of events such as conferences, festivals, corporate functions, weddings, and more. Event organizers handle everything from venue selection and vendor management to scheduling, booking, and on-site.
                </div>
            </div>
        </div>
        <div class="row justify-content-center" >
            {{-- <div class="col-lg-12 d-none">
                <div class="price_truggle d-flex">
                    <p>{{__('defaultTheme.monthly')}}</p>
                    <label class="switch-toggle outer">
                        <input id="pricingToggle" type="checkbox" />
                        <div></div>
                    </label>
                    <p class="pl-18">{{__('defaultTheme.yearly')}}</p>
                </div>
            </div> --}}

            @foreach($pricing_plans as $key => $item)
            <div class="col-lg-4 col-md-6 mb_30">
                <div class="new_pricing_card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                         <h2 class="plan_title">{{$item->name}}</h2>
                         @if($item->is_featured == 1)
                            <span class="discount_badge">{{__('defaultTheme.best value')}}</span>
                         @endif
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="big_price">{{single_price($item->monthly_cost)}}</span>
                            <div class="price_meta">
                                <span>{{__('defaultTheme.per month')}}</span>
                            </div>
                        </div>
                    </div>

                    <a class="cta_btn select_btn_price cursor_pointer" data-id='{{ $item->id }}'>
                        {{__('defaultTheme.choose plan')}}
                    </a>

                    <div class="feature_divider"></div>

                    @include('frontend.amazy.partials._pricing_plan_feature_list', ['plan' => $item, 'context' => 'event'])
                </div>
            </div>
            @endforeach
            <form class="price_subscription_add d-none"
                action="{{ route('frontend.event-organiser-subscription-type') }}" method="get">

                <input type="hidden" id="id" name="id" value="">
                <input type="hidden" id="type" name="type" value="">
            </form>
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
