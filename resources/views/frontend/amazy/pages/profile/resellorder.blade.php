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
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="white_box style2 bg-white mb_20">
                            <div class="dashboard_white_box_body">
                                <div class="table-responsive mb_10">
                                    <table class="table amazy_table3 style2 mb-0">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Email</th>
                                                <th>Order State</th>
                                                <th>Total Amount</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>{{$order->order->order_number}}</td>
                                                    <td>{{$order->order->customer_email}}</td>
                                                    <td>{{$order->deliveryStateName}}</td>
                                                    <td>$ {{$order->order->grand_total}}</td>
                                                    <td><a href="{{ route('frontend.resell_order_detail', encrypt($order->id)) }}" class="amaz_primary_btn style2 text-nowrap">{{__('defaultTheme.order_details')}}</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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