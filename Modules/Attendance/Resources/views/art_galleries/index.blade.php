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
                        <a href="{{route('booking.art_galleries')}}" class="primary-btn small fix-gr-bg">
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
                                    {{ __('Art Inventory') }}
                                </h3>
                            </div>
                            @if(isset($editData))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['booking.art_galleries.update', $editData->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            @else
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'booking.art_galleries.store','method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            <input name="user_id" value="{{auth()->user()->id}}" type="hidden">
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
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{ __('common.description') }}</label>
                                                <textarea name="description" class="primary_input_field" rows="4" placeholder="{{ __('common.description') }}">{{isset($editData) ? $editData->description : old('description') }}</textarea>
                                                <span class="text-danger">{{$errors->first('description')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{ __('common.image') }}
                                                    @if(!isset($editData))<span class="text-danger">*</span>@endif</label>
                                                <input name="image" class="primary_input_field" type="file" accept="image/*">
                                                @if(isset($editData) && $editData->image)
                                                    <div class="mt-10">
                                                        <img src="{{ showImage($editData->image) }}" alt="" width="120">
                                                    </div>
                                                @endif
                                                <span class="text-danger">{{$errors->first('image')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{ __('common.status') }}
                                                    <span class="text-danger">*</span></label>
                                                <select class="primary_select mb-25" name="status" id="status">
                                                    <option value="1" {{ (isset($editData) && $editData->status == 1) || old('status') == '1' ? 'selected' : '' }}>{{ __('common.active') }}</option>
                                                    <option value="0" {{ (isset($editData) && $editData->status == 0) || old('status') === '0' ? 'selected' : '' }}>{{ __('common.inactive') }}</option>
                                                </select>
                                                <span class="text-danger">{{$errors->first('status')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-20">
                                            <button type="submit" class="primary-btn fix-gr-bg submit">
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
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endif
                </div>
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
                                    <h3 class="mb-0">{{ __('Art Inventory') }} @lang('common.list')</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table ">
                                        <div class="">
                                            <table class="table art_gallery_list_table" id="artGalleryListTable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('common.image')</th>
                                                    <th>@lang('common.title')</th>
                                                    <th>@lang('common.slug')</th>
                                                    <th>@lang('common.description')</th>
                                                    <th>@lang('Created By')</th>
                                                    <th>@lang('common.status')</th>
                                                    <th>@lang('common.action')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($artGalleries ?? [] as $artGallery)
                                                        <tr>
                                                            <td>
                                                                @if($artGallery->image)
                                                                    <img src="{{ showImage($artGallery->image) }}" alt="" width="60" height="60" style="object-fit:cover;">
                                                                @endif
                                                            </td>
                                                            <td>{{ $artGallery->title }}</td>
                                                            <td>{{ $artGallery->slug }}</td>
                                                            <td>{{ \Illuminate\Support\Str::limit($artGallery->description, 80) }}</td>
                                                            <td>{{ @$artGallery->user->first_name }}</td>
                                                            <td>{{ $artGallery->status == 1 ? __('common.active') : __('common.inactive') }}</td>
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
                                                                            <a class="dropdown-item" href="{{route('booking.art_galleries.edit',$artGallery->id)}}">@lang('common.edit')</a>
                                                                            <a data-value="{{route('booking.art_galleries.delete', $artGallery->id)}}" class="dropdown-item delete_art_gallery">{{__('common.delete')}}</a>
                                                                        @else
                                                                            <a class="dropdown-item" href="{{route('booking.art_galleries.edit',$artGallery->id)}}">@lang('common.view')</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">{{ __('common.no_data_found') }}</td>
                                                    </tr>
                                                @endforelse
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
@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function () {
                if ($('#artGalleryListTable').length && !$.fn.DataTable.isDataTable('#artGalleryListTable')) {
                    $('#artGalleryListTable').DataTable({
                        bLengthChange: false,
                        stateSave: false,
                        bDestroy: true,
                        language: {
                            search: "<i class='ti-search'></i>",
                            searchPlaceholder: typeof trans === 'function' ? trans('common.quick_search') : 'Quick Search',
                            paginate: {
                                next: "<i class='ti-arrow-right'></i>",
                                previous: "<i class='ti-arrow-left'></i>"
                            }
                        },
                        dom: 'Bfrtip',
                        buttons: [
                            { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: { columns: ':not(:last-child)' } },
                            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: { columns: ':not(:last-child)' } },
                            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV', exportOptions: { columns: ':not(:last-child)' } },
                            { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF', exportOptions: { columns: ':not(:last-child)' }, pageSize: 'A4' },
                            { extend: 'print', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', exportOptions: { columns: ':not(:last-child)' } },
                            { extend: 'colvis', text: '<i class="fa fa-columns"></i>', postfixButtons: ['colvisRestore'] }
                        ],
                        columnDefs: [{ visible: false }],
                        responsive: true
                    });
                }
            });

            $(document).on('click', '.delete_art_gallery', function(event) {
                event.preventDefault();
                var url = $(this).data('value');
                $('#delete_modal').modal('show');
                $('#delete_link').attr('href', url);
            });
        })(jQuery);
    </script>
@endpush
