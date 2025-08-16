@extends('backEnd.master')
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/attendance/css/style.css'))}}" />
@endsection
@section('mainContent')

    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($editData))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{url('/events')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('common.add')
                        </a>
                    </div>
                </div>
            @endif
            <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-0">@lang('Event Booking List')</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-40">

                            <div class="col-lg-12">
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table ">
                                        <!-- table-responsive -->
                                        <div class="">
                                            <table class="table Crm_table_active3">

                                                <thead>
                                                <tr>
                                                    <th>@lang('common.title')</th>
                                                    <th>@lang('common.price')</th>
                                                    <th>@lang('Purchase Date')</th>
                                                    <th>@lang('Purchase Ticket')</th>
                                                    <th>@lang('Name')</th>
                                                    <th>@lang('Email')</th>
                                                    <th>@lang('common.action')</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if(isset($events))
                                                    @foreach($events as $event)
                                                        <tr>

                                                            <td>{{ @$event->event->title}}</td>
                                                            <td>{{ @$event->event->price}}</td>

                                                            <td>{{ dateConvert($event->purchase_date) }}</td>


                                                            <td>{{$event->no_of_ticket}}</td>

                                                            <td>{{ @$event->user->first_name}}</td>
                                                            <td>{{ @$event->user->email}}</td>
                                                            <td>
                                                                <div class="dropdown CRM_dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle"
                                                                            type="button"
                                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                        {{__('common.select')}}
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                                        <a class="dropdown-item" href="{{route('booking.events_view',$event->id)}}">@lang('View')</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </section>
    @include('backEnd.partials.delete_modal')
@endsection
@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click', '.delete_event', function(event){
                    let url = $(this).data('value');
                    confirm_modal(url);
                });
                $(document).on('change', '#document_file_1', function(event){
                    getFileName($(this).val(),'#placeholderFileOneName');
                    imageChangeWithFile($(this)[0],'#img');
                });
            });
        })(jQuery);
    </script>
@endpush
