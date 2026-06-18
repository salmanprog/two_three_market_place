@extends('backEnd.master')
@section('mainContent')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex align-items-center">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('Organiser List') }}</h3>
                            @if(permissionCheck('staffs.store'))
                            <ul class="d-flex">
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('staffs.create') }}"><i class="ti-plus"></i>{{ __('common.add_new') }} {{ __('hr.staff') }}</a></li>
                            </ul>
                            @endif
                            @if (permissionCheck('staffs.destroy'))
                            <button type="button" class="primary-btn fix-gr-bg small d-none bulk_delete_staffs ml-3">
                                <i class="ti-trash"></i> {{ __('common.bulk_delete') }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        @if (permissionCheck('staffs.destroy'))
                                        <th scope="col">
                                            <label class="primary_checkbox d-flex mr-0 mb-0">
                                                <input type="checkbox" class="select_all_staffs">
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        @endif
                                        <th scope="col">{{ __('common.sl') }}</th>
                                        <th scope="col">{{ __('common.avatar') }}</th>
                                        <th scope="col">{{ __('common.name') }}</th>
                                        <th scope="col">{{ __('common.email') }}</th>
                                        <th scope="col">{{ __('common.phone') }}</th>
                                        <th scope="col">{{ __('Total Earn') }}</th>
                                        <th scope="col">{{ __('Total Event') }}</th>
                                        <th scope="col">{{ __('common.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($staffs as $key => $staff)
                                            <tr>
                                                @if (permissionCheck('staffs.destroy'))
                                                <th>
                                                    <label class="primary_checkbox d-flex mr-0 mb-0">
                                                        <input type="checkbox" class="staff_row_checkbox" value="{{ $staff->id }}">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th>
                                                @endif
                                                <th>{{ getNumberTranslate($key+1) }}</th>
                                                <th>
                                                    <div class="logo_div">
                                                        <img class="mini_logo img-size" src="{{ showImage($staff->avatar != null?$staff->avatar:'frontend/default/img/avatar.jpg') }}" alt="" height="60px">
                                                    </div>
                                                </th>
                                                <td><a href="{{ route('staffs.view', $staff->id) }}">{{ucwords( @$staff->first_name ) }}</a></td>
                                                <td>{{ @$staff->email }}</td>
                                                <td>{{ @getNumberTranslate($staff->phone) }}</td>
                                                <td>{{single_price($staff->wallet_balances->sum('amount'))}}</td>
                                                <td>{{count($staff->event)}}</td>
                                                <td>
                                                    <!-- shortby  -->
                                                    <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                            @if(permissionCheck('staffs.view'))
                                                            <a href="{{ route('staffs.view', $staff->id) }}" class="dropdown-item">{{__('common.view')}}</a>
                                                            @endif

                                                            @if(permissionCheck('staffs.edit'))
                                                            <a href="{{ route('staffs.edit', $staff->id) }}" class="dropdown-item">{{__('common.edit')}}</a>
                                                            @endif

                                                            @if(permissionCheck('staffs.destroy'))
                                                            <a data-value="{{route('staffs.destroy', $staff->id)}}" class="dropdown-item delete_staff">{{__('common.delete')}}</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- shortby  -->
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
    </section>
@include('backEnd.partials.delete_modal')

<div class="modal fade" id="confirm-bulk-delete-staff">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('common.bulk_delete') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4>{{ __('common.are_you_sure_to_delete_?') }}</h4>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">{{ __('common.cancel') }}</button>
                    <button type="button" class="primary-btn fix-gr-bg" id="confirm_bulk_delete_staff">{{ __('common.delete') }}</button>
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
            $(document).ready(function(){
                $(document).on('change','.payrollPayment', function(){
                    if(this.checked){
                        var status = 1;
                    }
                    else{
                        var status = 0;
                    }
                    $.post('{{ route('staffs.update_active_status') }}', {_token:'{{ csrf_token() }}', id:this.value, status:status}, function(data){
                        if(data.success){
                            toastr.success(data.success);
                        }
                        else{
                            toastr.error(data.error);
                        }
                    }).fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

            });
                });

                $(document).on('click', '.delete_staff', function(event){
                    event.preventDefault();
                    let value = $(this).data('value');
                    confirm_modal(value);
                });

                function toggleStaffBulkDeleteButton() {
                    var hasChecked = $('.staff_row_checkbox:checked').length > 0;
                    $('.bulk_delete_staffs').toggleClass('d-none', !hasChecked);
                }

                $(document).on('change', '.select_all_staffs', function() {
                    var checked = $(this).is(':checked');
                    $('.staff_row_checkbox').prop('checked', checked);
                    toggleStaffBulkDeleteButton();
                });

                $(document).on('change', '.staff_row_checkbox', function() {
                    var total = $('.staff_row_checkbox').length;
                    var checked = $('.staff_row_checkbox:checked').length;
                    $('.select_all_staffs').prop('checked', total > 0 && total === checked);
                    toggleStaffBulkDeleteButton();
                });

                $(document).on('click', '.bulk_delete_staffs', function() {
                    if (!$('.staff_row_checkbox:checked').length) {
                        toastr.warning("{{ __('common.select_one') }}", "{{ __('common.warning') }}");
                        return;
                    }
                    $('#confirm-bulk-delete-staff').modal('show');
                });

                $('#confirm_bulk_delete_staff').on('click', function() {
                    var ids = [];
                    $('.staff_row_checkbox:checked').each(function() {
                        ids.push($(this).val());
                    });

                    if (!ids.length) {
                        $('#confirm-bulk-delete-staff').modal('hide');
                        return;
                    }

                    $('#pre-loader').removeClass('d-none');
                    $('#confirm-bulk-delete-staff').modal('hide');

                    $.ajax({
                        url: "{{ route('staffs.bulk_destroy') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: ids
                        },
                        success: function(response) {
                            if (response.deleted > 0) {
                                toastr.success(response.message, "{{ __('common.success') }}");
                                window.location.reload();
                            } else {
                                toastr.warning(response.message, "{{ __('common.warning') }}");
                            }
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            var message = "{{ __('common.error_message') }}";
                            if (response.responseJSON) {
                                message = response.responseJSON.message
                                    || response.responseJSON.error
                                    || message;
                            }
                            toastr.error(message, "{{ __('common.error') }}");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $(document).on('change', '.update_status_staff', function(){
                    event.preventDefault();
                    let status = 0;
                    if($(this).prop('checked')){
                        status = 1;
                    }
                    else{
                        status = 0;
                    }
                    let id = $(this).data('id');
                    $('#pre-loader').removeClass('d-none');
                    let formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('id', id);
                    formData.append('status', status);

                    $.ajax({
                        url: "{{ route('staffs.update_active_status') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            toastr.error("{{__('common.error_message')}}");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
