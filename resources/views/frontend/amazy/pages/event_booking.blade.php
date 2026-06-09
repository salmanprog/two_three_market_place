@extends('frontend.amazy.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset(asset_path('frontend/amazy/css/page_css/product_details.css'))}}" />
    <link rel="stylesheet" href="{{asset(asset_path('frontend/default/css/lightbox.css'))}}" />
@endpush    
@section('content')
<div class="product_details_wrapper">
    <div class="container">
        <div class="row mb-5">
            <div class="col-xl-6">
                <form id="eventbook" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb_10">
                            <h3 class="check_v3_title2">{{ __("Event Details") }}</h3>
                            <h6 class="shekout_subTitle_text">{{__('defaultTheme.all_transactions_are_secure_and_encrypted')}}.</h6>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td style="width: 20%">{{ __("Event Name") }}:</td>
                                    <td>{{$events->title}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">{{ __("No. Tickets") }}:</td>
                                    <td>{{$bookingevents->no_of_ticket}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">{{ __('Price') }}:</td>
                                    <td>{{single_price($events->price)}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">{{ __("Booking Date") }}:</td>
                                    <td>{{$bookingevents->purchase_date}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">{{ __("Event Date") }}:</td>
                                    <td> Start: {{$events->from_date}}  End: {{$events->to_date}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="" class="amaz_primary_btn style2  min_200 text-center text-uppercase">
                                {{ __("common.continue_payment") }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                    <div class="order_sumery_box flex-fill">
                        <h3 class="check_v3_title mb_25">{{ __('common.payment_summery') }}</h3>
                        <div class="subtotal_lists">
                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("Event Price") }}</span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text">{{ single_price($events->price) }}</span>
                                    </div>
                                </div>

                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.subtotal") }}</span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($events->price * $bookingevents->no_of_ticket) }} </span>
                                    </div>
                                </div>

                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text"> {{__('common.vat/tax/gst')}} (0 %) </span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price(0) }} </span>
                                    </div>
                                </div>

                                <div class="total_amount d-flex align-items-center flex-wrap pb_25">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.total") }} </span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($events->price * $bookingevents->no_of_ticket) }} </span>
                                    </div>
                                </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>    
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('#eventbook');
            var stripe_publishable_key = "pk_live_51KVNYMCRrnOErjCY9HcENE2J4hIHB7n6MR9d3H8I4Gk4aUgIKeew24q31kJ6L24LJmKt6TIVhVUByaXpTPuEautV005khxGgWw";
            var stripe = Stripe(stripe_publishable_key);
            var elements = stripe.elements();
            var card = elements.create('card');
            card.mount('#card-element');

            form.addEventListener('submit', function(e) {
                var selectedMethod = $('input[name="method"]:checked').data('name');
                e.preventDefault();
                if (selectedMethod == 'Stripe') {
                    stripe.createToken(card).then(function(result) {
                        if (result.error) {
                            document.getElementById('card-errors').textContent = result.error.message;
                        } else {
                            var hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'stripeToken';
                                hiddenInput.value = result.token.id;
                                form.appendChild(hiddenInput);
                                form.submit();
                        }
                    });
                }
            });
        });
</script>    
@endpush
