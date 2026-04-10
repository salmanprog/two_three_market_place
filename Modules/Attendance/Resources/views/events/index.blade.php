@extends('backEnd.master')
@php
    $eventMapsEnabled = config('app.map_api_status') == 'true' && filled(config('app.map_api_key'));
@endphp
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/attendance/css/style.css'))}}" />
<style>
    .event-address-wrap { position: relative; }
    .event-address-suggestions {
        position: absolute;
        left: 0;
        right: 0;
        top: 100%;
        z-index: 1050;
        max-height: 240px;
        overflow-y: auto;
        background: var(--bg_white, #fff);
        border: 1px solid var(--border_color, #e2e6ef);
        border-radius: 4px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        list-style: none;
        margin: 2px 0 0;
        padding: 0;
    }
    .event-address-suggestions li {
        padding: 10px 14px;
        cursor: pointer;
        font-size: 13px;
        line-height: 1.35;
        border-bottom: 1px solid var(--border_color, #eef0f7);
    }
    .event-address-suggestions li:last-child { border-bottom: 0; }
    .event-address-suggestions li:hover,
    .event-address-suggestions li.is-active { background: var(--input__bg, #f5f7fb); }
    .pac-container { z-index: 10000 !important; }
</style>
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
                <div class="@if (auth()->user()->role->type != 'admin') col-lg-3 @else col-lg-12 @endif">
                    @if (auth()->user()->role->type != 'admin')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">@if(isset($editData))
                                        @lang('common.edit')
                                    @else
                                        @lang('common.add')
                                    @endif
                                    @lang('hr.event')
                                </h3>
                            </div>
                            @if(isset($editData))
                                @if (permissionCheck('events.update'))
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['events.update', $editData], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                                @endif
                            @else
                                @if (permissionCheck('events.store'))
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'events.store','method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                @endif
                            @endif
                            <input name="created_by" id="created_by" value="{{auth()->user()->id}}" type="hidden">
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                        @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                        @endif
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{ __('common.title') }}
                                                    <span class="text-danger">*</span></label>
                                                <input name="title" id="title"
                                                       class="primary_input_field"
                                                       value="{{isset($editData) ? $editData->title : old('title') }}"
                                                       placeholder="{{ __('common.title') }}" type="text">
                                                <span class="text-danger">{{$errors->first('title')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{ __('hr.for_whom') }}
                                                    <span class="text-danger">*</span></label>
                                                <select class="primary_select mb-25" name="for_whom"
                                                        id="employment_type">
                                                    <option
                                                        value="all" {{isset($editData) && $editData->for_whom == 'all' ? 'selected' : ''}}>{{__('common.all')}}</option>
                                                    @foreach($roles as $role)
                                                        <option
                                                            value="{{$role->name}}" {{isset($editData) && $editData->for_whom == $role->name ? 'selected' : ''}}>{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{$errors->first('for_whom')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25 event-address-wrap">
                                                <label class="primary_input_label" for="current_address">{{ __('common.location') }}
                                                    <span class="text-danger">*</span></label>
                                                <input name="location" id="current_address"
                                                       class="primary_input_field name"
                                                       placeholder="{{ __('common.location') }}"
                                                       value="{{isset($editData) ? $editData->location : old('location') }}" type="text" autocomplete="off">
                                                <ul id="event_address_suggestions" class="event-address-suggestions d-none" role="listbox" aria-label="{{ __('common.location') }}"></ul>
                                                <input type="hidden" name="current_latitude" id="current_latitude"
                                                       value="{{ isset($editData) ? $editData->current_latitude : old('current_latitude') }}">
                                                <input type="hidden" name="current_longitude" id="current_longitude"
                                                       value="{{ isset($editData) ? $editData->current_longitude : old('current_longitude') }}">
                                                <small class="text-muted d-block mt-1" id="event_geocode_status"></small>
                                                <span class="text-danger">{{$errors->first('location')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 date_of_joining_div">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label"
                                                       for="">{{ __('common.start_date') }}
                                                    <span class="text-danger">*</span></label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="07/14/2021"
                                                                       class="primary_input_field primary-input date form-control"
                                                                       id="start_date" type="text"
                                                                       name="from_date"
                                                                       value="{{dateConvert(isset($editData)? date('m/d/Y', strtotime($editData->from_date)): date('m/d/Y'))}}"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <button class="btn-date" data-id="#start_date" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="text-danger">{{$errors->first('from_date')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 date_of_joining_div">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="">{{ __('common.to_date') }}
                                                    <span class="text-danger">*</span></label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="07/14/2021"
                                                                       class="primary_input_field primary-input date form-control"
                                                                       type="text" name="to_date" id="date"
                                                                       value="{{dateConvert(isset($editData)? date('m/d/Y', strtotime($editData->to_date)): date('m/d/Y'))}}"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <button class="btn-date" data-id="#date" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="text-danger">{{$errors->first('to_date')}}</span>
                                            </div>
                                        </div>
                                         <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">Price
                                                    <span class="text-danger">*</span></label>
                                                <input name="price" id="price"
                                                       class="primary_input_field"
                                                       value="{{isset($editData) ? $editData->price : old('price') }}"
                                                       placeholder="Price" type="text">
                                                <span class="text-danger">{{$errors->first('price')}}</span>
                                            </div>
                                        </div>
                                         <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">Total Ticket
                                                    <span class="text-danger">*</span></label>
                                                <input name="total_ticket" id="total_ticket"
                                                       class="primary_input_field"
                                                       value="{{isset($editData) ? $editData->total_ticket : old('total_ticket') }}"
                                                       placeholder="Total Ticket" type="text">
                                                <span class="text-danger">{{$errors->first('total_ticket')}}</span>
                                                <span style="font-size:8px;float:right;color:gray;">Platform service fee applicable on per ticket</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('common.description') }}</label>

                                                       <textarea name="description" id="description1" class="primary_textarea height_112" name="description" maxlength="300">{{isset($editData) ? $editData->description : old('description') }}</textarea>
                                                <span class="text-danger">{{$errors->first('description')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label"
                                                       for="">{{__('common.image')}} ({{getNumberTranslate(1920)}}x {{getNumberTranslate(500)}})px</label>
                                                <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text"
                                                           id="placeholderFileOneName"
                                                           placeholder="{{__('common.browse_file')}}" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="document_file_1">{{__("common.browse")}} </label>
                                                        <input type="file" class="d-none" name="image" accept="image/*"
                                                               id="document_file_1">
                                                    </button>
                                                </div>
                                                <span class="text-danger">{{$errors->first('image')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="img_div">
                                                <img id="img" src="
                                                    @if(isset($editData))
                                                        @if($editData->image != null)
                                                            {{showImage($editData->image)}}
                                                        @else
                                                            {{showImage('backend/img/default.png')}}
                                                        @endif
                                                    @else
                                                        {{showImage('backend/img/default.png')}}
                                                    @endif
                                                " alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip">
                                                <span class="ti-check"></span>
                                                @if(isset($editData))
                                                    @lang('common.update')
                                                @else
                                                    @lang('common.save')
                                                @endif
                                            </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @if (permissionCheck('events.store') || permissionCheck('events.update'))
                                    {{ Form::close() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="@if (auth()->user()->role->type != 'admin') col-lg-9 @else col-lg-12 @endif">
                        @if(session()->has('message-success-delete'))
                            <div class="alert alert-success">
                                {{ session()->get('message-success-delete') }}
                            </div>
                        @elseif(session()->has('message-danger-delete'))
                            <div class="alert alert-danger">
                                {{ session()->get('message-danger-delete') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-4 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-0">@lang('hr.event_list')</h3>
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
                                                    <th>@lang('common.start_date')</th>
                                                    <th>@lang('Created By')</th>
                                                    <th>@lang('Created By Email')</th>
                                                    <th>@lang('sold ticket')</th>
                                                    <th>@lang('common.price')</th>
                                                    <th>@lang('common.action')</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if(isset($events))
                                                    @foreach($events as $event)
                                                        <tr>

                                                            <td>{{ @$event->title}}</td>
                                                            

                                                            <td>{{ dateConvert($event->from_date) }}</td>


                                                            <td>{{ @$event->user->first_name}}</td>
                                                            <td>{{$event->user->email}}</td>

                                                            <td>{{ @$event->sold_ticket}}</td>
                                                            <td>{{ single_price(@$event->price) }}</td>
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
                                                                        @if (auth()->user()->role->type != 'admin')
                                                                        @if (permissionCheck('events.update'))
                                                                            <a class="dropdown-item" href="{{route('events.edit',$event->id)}}">@lang('common.edit')</a>
                                                                        @endif
                                                                        @if (permissionCheck('events.delete'))
                                                                            <a data-value="{{route('events.delete', $event->id)}}" class="dropdown-item delete_event">{{__('common.delete')}}</a>
                                                                        @endif
                                                                        @else
                                                                            <a class="dropdown-item" href="{{route('view_event',$event->id)}}">@lang('common.view')</a>
                                                                        @endif
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
            </div>
    </section>
    @include('backEnd.partials.delete_modal')
@endsection
@if($eventMapsEnabled)
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.map_api_key') }}&callback=initEventLocationAutocomplete&libraries=places&v=weekly" defer></script>
@endif
@push('scripts')
    <script>
        (function($){
            "use strict";
            var eventMapsEnabled = @json($eventMapsEnabled);

            function geocodeEventLocation(address) {
                var $status = $('#event_geocode_status');
                if (!address || String(address).trim().length < 2) {
                    $('#current_latitude').val('');
                    $('#current_longitude').val('');
                    $status.text('');
                    return $.Deferred().resolve(false).promise();
                }
                $status.text('…');
                return $.getJSON('https://geocoding-api.open-meteo.com/v1/search', {
                    name: String(address).trim(),
                    count: 1,
                    language: 'en',
                    format: 'json'
                }).then(function (data) {
                    if (data.results && data.results[0]) {
                        var r = data.results[0];
                        $('#current_latitude').val(r.latitude);
                        $('#current_longitude').val(r.longitude);
                        $status.text('');
                        return true;
                    }
                    $('#current_latitude').val('');
                    $('#current_longitude').val('');
                    $status.text('');
                    return false;
                }).fail(function () {
                    $status.text('');
                });
            }

            function photonLabel(f) {
                var p = f.properties || {};
                var parts = [p.name, p.street, p.city, p.state, p.country].filter(Boolean);
                return parts.length ? parts.join(', ') : (p.name || '');
            }

            function showPhotonSuggestions(features) {
                var $ul = $('#event_address_suggestions');
                $ul.empty();
                if (!features || !features.length) {
                    $ul.addClass('d-none');
                    return;
                }
                features.forEach(function (f, i) {
                    var coords = f.geometry && f.geometry.coordinates;
                    if (!coords || coords.length < 2) return;
                    var lon = coords[0], lat = coords[1];
                    var label = photonLabel(f);
                    if (!label) return;
                    $('<li role="option" tabindex="-1"></li>')
                        .text(label)
                        .attr('data-lat', lat)
                        .attr('data-lon', lon)
                        .attr('data-label', label)
                        .appendTo($ul);
                });
                if ($ul.children().length) {
                    $ul.removeClass('d-none');
                } else {
                    $ul.addClass('d-none');
                }
            }

            function hidePhotonSuggestions() {
                $('#event_address_suggestions').addClass('d-none').empty();
            }

            window.initEventLocationAutocomplete = function () {
                if (!eventMapsEnabled) return;
                var input = document.getElementById('current_address');
                if (!input || !window.google || !google.maps || !google.maps.places) return;
                var opts = {
                    fields: ['formatted_address', 'geometry', 'name'],
                    types: ['geocode'],
                };
                @if(config('app.map_api_country_1') != '')
                opts.componentRestrictions = { country: [
                    @if(config('app.map_api_country_1') != '') "{{ config('app.map_api_country_1') }}" @endif
                    @if(config('app.map_api_country_2') != '') ,"{{ config('app.map_api_country_2') }}" @endif
                    @if(config('app.map_api_country_3') != '') ,"{{ config('app.map_api_country_3') }}" @endif
                    @if(config('app.map_api_country_4') != '') ,"{{ config('app.map_api_country_4') }}" @endif
                    @if(config('app.map_api_country_5') != '') ,"{{ config('app.map_api_country_5') }}" @endif
                ]};
                @endif
                var ac = new google.maps.places.Autocomplete(input, opts);
                ac.addListener('place_changed', function () {
                    var place = ac.getPlace();
                    if (!place.geometry || !place.geometry.location) return;
                    input.value = place.formatted_address || place.name || input.value;
                    $('#current_latitude').val(place.geometry.location.lat());
                    $('#current_longitude').val(place.geometry.location.lng());
                    $(input).closest('form').removeData('eventGeocodeSubmitted');
                });
            };

            var geocodeTimer;
            var photonTimer;
            $(document).ready(function(){
                $(document).on('click', '.delete_event', function(event){
                    let url = $(this).data('value');
                    confirm_modal(url);
                });
                $(document).on('change', '#document_file_1', function(event){
                    getFileName($(this).val(),'#placeholderFileOneName');
                    imageChangeWithFile($(this)[0],'#img');
                });

                if (!eventMapsEnabled) {
                    $(document).on('input', '#current_address', function () {
                        $(this).closest('form').removeData('eventGeocodeSubmitted');
                        clearTimeout(photonTimer);
                        clearTimeout(geocodeTimer);
                        var q = $.trim($(this).val());
                        if (q.length < 3) {
                            hidePhotonSuggestions();
                            return;
                        }
                        photonTimer = setTimeout(function () {
                            $.getJSON('https://photon.komoot.io/api/', { q: q, limit: 8 })
                                .done(function (data) {
                                    showPhotonSuggestions(data.features || []);
                                })
                                .fail(function () { hidePhotonSuggestions(); });
                        }, 350);
                    });
                    $(document).on('mousedown', '#event_address_suggestions li', function (e) {
                        e.preventDefault();
                        var $li = $(this);
                        $('#current_address').val($li.data('label'));
                        $('#current_latitude').val($li.data('lat'));
                        $('#current_longitude').val($li.data('lon'));
                        hidePhotonSuggestions();
                        $('#current_address').closest('form').removeData('eventGeocodeSubmitted');
                    });
                    $(document).on('blur', '#current_address', function () {
                        setTimeout(hidePhotonSuggestions, 200);
                        clearTimeout(geocodeTimer);
                        var addr = $(this).val();
                        geocodeTimer = setTimeout(function () {
                            if ($.trim($('#current_latitude').val()) === '') {
                                geocodeEventLocation(addr);
                            }
                        }, 400);
                    });
                }

                $('#current_address').closest('form').on('submit', function (e) {
                    var $form = $(this);
                    if ($form.data('eventGeocodeSubmitted')) {
                        return;
                    }
                    var loc = $.trim($('#current_address').val());
                    var lat = $.trim($('#current_latitude').val());
                    if (!loc || lat !== '') {
                        return;
                    }
                    e.preventDefault();
                    geocodeEventLocation(loc).always(function () {
                        $form.data('eventGeocodeSubmitted', true);
                        if ($form[0]) {
                            HTMLFormElement.prototype.submit.call($form[0]);
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
