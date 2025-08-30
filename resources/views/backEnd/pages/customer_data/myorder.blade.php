@extends('backEnd.master')
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/ordermanage/css/style.css'))}}" />

@endsection

@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-20">
                <div class="box_header_right">
                    <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                        <ul class="nav nav_list" role="tablist">
                            @if (permissionCheck('confirmed_orders'))
                                <!-- <li class="nav-item">
                                    <a class="nav-link active show" href="#order_confirmed_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.confirmed_orders')}}</a>
                                </li> -->
                            @endif

                            @if (permissionCheck('complete_orders'))
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="#order_complete_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.completed_orders')}}</a>
                                </li> -->
                            @endif

                            @if (permissionCheck('pending_orders'))
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="#pending_payment_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.pending_payment_orders')}}</a>
                                </li> -->
                            @endif

                            @if (permissionCheck('cancelled_orders'))
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="#cancelled_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.cancelled_orders')}}</a>
                                </li> -->
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">

                    <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="order_confirmed_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('Order List')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $key => $order)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td>{{ getNumberTranslate($order->created_at) }}</td>
                                                        <td>{{ getNumberTranslate($order->order_number) }}</td>
                                                        <td>{{ single_price($order->grand_total) }}</td>
                                                        <td>
                                                            @if($order->is_cancelled == 1)
                                                                {{__('common.cancelled')}}
                                                                @elseif($order->is_completed == 1)
                                                                {{__('common.completed')}}
                                                                @else
                                                                    @if ($order->is_confirmed == 1)
                                                                    {{__('common.confirmed')}}
                                                                    @elseif ($order->is_confirmed == 2)
                                                                    {{__('common.declined')}}
                                                                    @else
                                                                    {{__('common.pending')}}
                                                                    @endif
                                                                @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('frontend.my_purchase_order_detail', encrypt($order->id)) }}" class="btn_2">{{__('defaultTheme.order_details')}}</a>
                                                        </td>
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

</section>
@endsection

@push('scripts')
@endpush
