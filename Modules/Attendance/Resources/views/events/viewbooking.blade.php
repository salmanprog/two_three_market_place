@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/customer/css/show_details.css'))}}" />
<style>
    .white-color{
        color: #FFF !important;
    }
</style>
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30">{{ __('View Booking')}}</h3>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4 col-sm-12">
                                <div class="img_div">
                                    <img class="student-meta-img mb-3" src="{{ (@$events->user->avatar != null) ? showImage($events->user->avatar) : showImage('frontend/default/img/avatar.jpg') }}"  alt="">
                                </div>
                                <h3>{{$events->user->first_name}} {{$events->user->last_name}}</h3>
                                <table class="table table-borderless customer_view">
                                    <tr>
                                        <td>{{ __('common.name') }}</td>
                                        <td>: <span class="ml-1"></span>{{$events->user->first_name}} {{$events->user->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.email') }}</td>
                                        <td>: <span class="ml-1"></span>{{ $events->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.phone') }}</td>
                                        <td>: <span class="ml-1"></span>{{ (getNumberTranslate($events->user->phone)) ?? $events->user->username }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.registered_date') }}</td>
                                        <td>: <span class="ml-1"></span>{{ dateConvert($events->user->created_at) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.active_status') }}</td>
                                        <td>: <span class="ml-1"></span>
                                            @if ($events->user->is_active == 1)
                                                <span class="badge_1">{{__('common.active')}}</span>
                                            @elseif($events->user->is_active == 0)
                                                <span class="badge_4">{{__('common.disabled')}}</span>
                                            @else
                                                <span class="badge_4">{{__('common.in-active')}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3 mb-md-0 customer_profile">
                                <h3>{{__('Booking Summary')}}</h3>
                                <table class="table table-borderless customer_view">
                                    <tr><td>{{__('Event Name')}}</td>
                                    <td>: <span class="ml-1"></span>{{$events->event->title}}</td></tr>
                                    <tr><td>{{__('No. of Tickets')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate($events->no_of_ticket)}}</td></tr>
                                    <tr><td>{{__('Booking Date')}}</td>
                                    <td>: <span class="ml-1"></span>{{$events->purchase_date}}</td></tr>
                                    <tr><td>{{__('Status')}}</td>
                                    <td>: <span class="ml-1"></span><span class="badge_1">{{__('Paid')}}</span></td></tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                                <div class="customer_profile">
                                    <h3>{{__('Transactions Summary')}}</h3>
                                    <table class="table table-borderless customer_view">
                                        <tr><td>{{__('Tx Id')}}</td>
                                        <td>: <span class="ml-1"></span>{{$events->tx_id}}</td></tr>
                                        <tr><td>{{__('Amount')}}</td>
                                        <td>: <span class="ml-1"></span>{{single_price($events->event->price * $events->no_of_ticket)}}</td></tr>
                                       
                                    </table>
                                </div>
                            </div>
                    </div>
                    <hr>
                        <div class="row">
                            <div class="col">
                                <label class="primary_input_label" for="">
                                    <h3 class="mb-0 mr-30">{{ __('Event Details')}}</h3>
                                    <table class="table Crm_table_active4">
                                        <thead>
                                        <tr>
                                            <th>@lang('common.title')</th>
                                            <th>@lang('common.price')</th>
                                            <th>@lang('Location')</th>
                                            <th>@lang('End Date')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $events->event->title}}</td>
                                                <td>{{ $events->event->price}}</td>
                                                    <td>{{ $events->event->location}}</td>
                                                <td>{{ $events->event->to_date}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </label>
                            </div>
                        </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
@endpush
