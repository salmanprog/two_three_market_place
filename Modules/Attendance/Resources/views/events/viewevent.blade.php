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
                                <h3 class="mb-0 mr-30">{{ __('Organiser Event')}}</h3>
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
                                <h3>{{__('Event Details')}}</h3>
                                <table class="table table-borderless customer_view">
                                    <tr><td>{{__('Title')}}</td>
                                    <td>: <span class="ml-1"></span>{{$events->title}}</td></tr>
                                    <tr><td>{{__('Start Date')}}</td>
                                    <td>: <span class="ml-1"></span>{{dateConvert($events->from_date)}}</td></tr>
                                    <tr><td>{{__('End Date')}}</td>
                                    <td>: <span class="ml-1"></span>{{dateConvert($events->to_date)}}</td></tr>
                                    <tr><td>{{__('Total Ticket')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate($events->total_ticket)}}</td></tr>
                                    <tr><td>{{__('Sold Ticket')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate($events->sold_ticket)}}</td></tr>
                                    <tr><td>{{__('Price')}}</td>
                                        <td>: <span class="ml-1"></span>{{single_price($events->price)}}</td></tr>
                                </table>
                               </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="customer_profile">
                                    <h3>{{__('Event Locations')}}</h3>
                                    <table class="table table-borderless customer_view">
                                        <tr><td>{{__('Location')}}</td>
                                        <td>: <span class="ml-1"></span>{{$events->location}}</td></tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        @if ($events->description)
                            <hr>
                                <div class="row">
                                    <div class="col">
                                        <h3>{{__('Event Description')}}</h3>
                                        <label class="primary_input_label" for="">
                                            @php
                                                echo $events->description;
                                            @endphp
                                        </label>
                                    </div>
                                </div>
                            <hr>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="col-lg-12 student-details">
                            <ul class="nav nav-tabs tab_column mb-50" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#Order" role="tab" data-toggle="tab">{{ __('Event Bookings') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-30">
                                <div role="tabpanel" class="tab-pane fade show active" id="Order">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">
                                                    <div class="">
                                                        <table class="table" id="orderTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('common.sl')}}</th>
                                                                    <th width="10%">{{__('common.date')}}</th>
                                                                    <th>{{__('Name')}}</th>
                                                                    <th>{{__('Email')}}</th>
                                                                    <th>{{__('Tickets')}}</th>
                                                                    <th>{{__('Price')}}</th>
                                                                    <th>{{__('Total Amount')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tobody>
                                                            @if(isset($event_booking))
                                                                @foreach($event_booking as $booking)
                                                                <tr>
                                                                    <td>{{$booking->id}}</td>
                                                                    <td>{{dateConvert($booking->purchase_date)}}</td>
                                                                    <td>{{$booking->user->first_name}}</td>
                                                                    <td>{{$booking->user->email}}</td>
                                                                    <td>{{$booking->no_of_ticket}}</td>
                                                                    <td>{{single_price($booking->event->price)}}</td>
                                                                    <td>{{single_price($booking->event->price * $booking->no_of_ticket)}}</td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                            </tobody>
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
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")

@endpush
