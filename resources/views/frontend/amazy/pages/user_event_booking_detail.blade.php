@extends('frontend.amazy.layouts.app')
<style>
@media (max-width:767px) {
.sumery_product_details .table-responsive table {
width: 700px
}

.summery_pro_content {
padding-left: 40px;
}

.font_16_top {
padding-left: 20px;
}

.sumery_product_details .amazy_table3 tbody tr td {
padding: 10px
}
}
</style>
@section('content')
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-8 col-lg-8">
                    <!-- content ::start  -->
                    <div class="white_box style2 bg-white mb_30">
                        <div class="white_box_header gray_color_1 d-flex align-items-center gap_20 flex-wrap  theme_border justify-content-between ">
                            <div class="d-flex flex-column  ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base">{{__('defaultTheme.order_date')}} :  </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ getNumberTranslate($bookingevents->purchase_date) }}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-column ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base">{{__('common.status')}}: </h4>
                                    <p class="font_14 f_w_400 m-0 lh-base">
                                        @if($bookingevents->is_paid == 0)
                                            {{__('common.pending')}}
                                        @else
                                            {{__('common.completed')}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                             <div class="d-flex flex-column  ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base">{{__('defaultTheme.order_amount')}}: </h4> <p class="font_14 f_w_400 m-0 lh-base">{{ single_price($bookingevents->event->price * $bookingevents->no_of_ticket) }}</p>
                                </div>
                            </div>
                            <div class="dashboard_white_box_body dashboard_orderDetails_body">
                                    <div class="order_prise d-flex justify-content-between gap-2 flex-wrap amazy_bb2 pb_11 mb_10">
                                        <h4 class="font_16 f_w_700 m-0">{{__('Event Title')}} : {{ $bookingevents->event->title }}</h4>
                                    </div>
                                    <div class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border">
                                        <div class="d-flex flex-column ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base">{{__('Start Date')}}:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ $bookingevents->event->from_date }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base">{{__('End Date')}}: </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ $bookingevents->event->to_date }}</p>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base">{{__('Ticket Price')}}:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ single_price($bookingevents->event->price) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mb_10">
                                        <div class="thumb">
                                            <img class="img-res" src="{{showImage($bookingevents->event->image)}}" alt="{{textLimit($bookingevents->event->title,28)}}" title="{{textLimit($bookingevents->event->title,28)}}" height="350px">
                                        </div>
                                    </div>
                                     <div class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border">
                                        <div class="d-flex flex-column ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base">{{__('No. of Ticket')}}:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ $bookingevents->no_of_ticket }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base">{{__('Email')}}: </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ $bookingevents->user->email }}</p>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base">{{__('Location')}}:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ $bookingevents->event->location }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base">{{__('Description')}}:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ $bookingevents->event->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>        
                    </div>                        
                    <!-- content ::end    -->
                </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
(function($) {
"use strict";

$(document).ready(function() {
$(document).on('click', '.change_delivery_state_status', function(event) {
event.preventDefault();
let package_id = $(this).data('package_id');
change_delivery_state_status(package_id);
});

function change_delivery_state_status(el) {
$("#pre-loader").show();
$.post('{{ route('change_delivery_status_by_customer') }}', {_token:'{{ csrf_token() }}', package_id:el}, function(data){
if (data == 1) {
toastr.success("{{__('defaultTheme.order_has_been_recieved')}}", "{{__('common.success')}}");
}else {
toastr.error("{{__('defaultTheme.order_not_recieved')}} {{__('common.error_message')}}", "{{__('common.error')}}");
}
$("#pre-loader").hide();
});
}

$(document).on('change', '#rn', function() { // 2nd (A)
$("#rnForm").submit();
});

$('#reason').niceSelect();
$(document).on('click', '.order_cancel_by_id', function(e) {
e.preventDefault();
$('#orderCancelReasonModal').modal('show');
$('.order_id').val($(this).attr('data-id'));
});

$(document).on('submit', '#order_cancel_form', function() {
$("#pre-loader").show();
$('#orderCancelReasonModal').modal('hide');
});
});
})(jQuery);
</script>
@endpush