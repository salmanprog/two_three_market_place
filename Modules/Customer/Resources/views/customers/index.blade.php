@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/customer/css/style.css'))}}" />

@endsection
@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 mb-20">
                <div class="box_header_right">
                    <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                        <ul class="nav" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active show" href="#all_customer" role="tab" data-toggle="tab"
                                    id="1" aria-selected="true">{{ __('common.all') }} {{__('Buyer')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#active_customer" role="tab" data-toggle="tab"
                                    id="1" aria-selected="true">{{ __('Active Buyer') }}</a>
                            </li>
                            @if (permissionCheck('customer.list_inactive'))
                            <li class="nav-item">
                                <a class="nav-link" href="#in_active_customer" role="tab" data-toggle="tab" id="1"
                                    aria-selected="true">{{ __('Inactive Buyer') }}</a>
                            </li>
                            @endif

                            @if (permissionCheck('admin.customer.create'))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('admin.customer.create')}}">{{ __('common.create') }} {{__('common.customer')}}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade active show" id="all_customer">
                            <div class="box_header common_table_header ">
                                <div class="main-title d-md-flex align-items-center">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('Active Buyer')}}</h3>
                                    @if (permissionCheck('admin.customer.destroy'))
                                    <button type="button" class="primary-btn fix-gr-bg small d-none bulk_delete_buyers" data-table="allCustomerTable">
                                        <i class="ti-trash"></i> {{ __('common.bulk_delete') }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table">
                                    <!-- table-responsives -->
                                    <div class="">
                                        @include('customer::customers.components.all_lists')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="active_customer">
                            <div class="box_header common_table_header ">
                                <div class="main-title d-md-flex align-items-center">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('Active Buyer')}}</h3>
                                    @if (permissionCheck('admin.customer.destroy'))
                                    <button type="button" class="primary-btn fix-gr-bg small d-none bulk_delete_buyers" data-table="activeCustomerTable">
                                        <i class="ti-trash"></i> {{ __('common.bulk_delete') }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table">
                                    <!-- table-responsive -->
                                    <div class="">
                                        @include('customer::customers.components.active_lists')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (permissionCheck('customer.list_inactive'))
                        <div role="tabpanel" class="tab-pane fade" id="in_active_customer">
                            <div class="box_header common_table_header ">
                                <div class="main-title d-md-flex align-items-center">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('Inactive Buyer') }}
                                    </h3>
                                    @if (permissionCheck('admin.customer.destroy'))
                                    <button type="button" class="primary-btn fix-gr-bg small d-none bulk_delete_buyers" data-table="inactiveCustomerTable">
                                        <i class="ti-trash"></i> {{ __('common.bulk_delete') }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table">
                                    <!-- table-responsive -->
                                    <div class="">
                                        @include('customer::customers.components.in_active_lists')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('backEnd.partials.delete_modal',['item_name' => __('common.customer')])

    <div class="modal fade" id="confirm-bulk-delete-buyer">
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
                        <button type="button" class="primary-btn fix-gr-bg" id="confirm_bulk_delete_buyer">{{ __('common.delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    <script type="text/javascript">
        (function($){
                "use strict";

                $(document).ready(function(){
                    var buyerExportColumns = "{{ permissionCheck('admin.customer.destroy') ? ':not(:first-child):not(:last-child)' : ':not(:last-child)' }}";
                    var bulkDeleteTableId = '';

                    function buyerTableColumns() {
                        return [
                            @if (permissionCheck('admin.customer.destroy'))
                            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                            @endif
                            { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                                return numbertrans(data)
                            }},
                            { data: 'avatar', name: 'avatar' },
                            { data: 'name', name: 'first_name' },
                            { data: 'email', name: 'email' },
                            { data: 'phone', name: 'username' },
                            { data: 'wallet_balance', name: 'wallet_balance' },
                            { data: 'orders', name: 'orders' },
                            { data: 'status', name: 'status' },
                            { data: 'action', name: 'action' }
                        ];
                    }

                    function reloadBuyerTables() {
                        allCustomerDataTable();
                        activeCustomerDataTable();
                        inactiveCustomerDataTable();
                    }

                    function toggleBulkDeleteButton(tableId) {
                        var hasChecked = $('#' + tableId + ' .buyer_row_checkbox:checked').length > 0;
                        $('.bulk_delete_buyers[data-table="' + tableId + '"]').toggleClass('d-none', !hasChecked);
                    }

                    activeCustomerDataTable();
                    inactiveCustomerDataTable();
                    allCustomerDataTable();

                    $(document).on('click', '.delete_customer', function(event){
                        event.preventDefault();
                        let value = $(this).data('value');
                        confirm_modal(value);
                    });

                    $(document).on('change', '.select_all_buyers', function() {
                        var tableId = $(this).data('table');
                        var checked = $(this).is(':checked');
                        $('#' + tableId + ' .buyer_row_checkbox').prop('checked', checked);
                        toggleBulkDeleteButton(tableId);
                    });

                    $(document).on('change', '.buyer_row_checkbox', function() {
                        var tableId = $(this).closest('table').attr('id');
                        var total = $('#' + tableId + ' .buyer_row_checkbox').length;
                        var checked = $('#' + tableId + ' .buyer_row_checkbox:checked').length;
                        $('#' + tableId).closest('.QA_table').find('.select_all_buyers[data-table="' + tableId + '"]').prop('checked', total > 0 && total === checked);
                        toggleBulkDeleteButton(tableId);
                    });

                    $(document).on('click', '.bulk_delete_buyers', function() {
                        bulkDeleteTableId = $(this).data('table');
                        var ids = [];
                        $('#' + bulkDeleteTableId + ' .buyer_row_checkbox:checked').each(function() {
                            ids.push($(this).val());
                        });

                        if (!ids.length) {
                            toastr.warning("{{ __('common.select_one') }}", "{{ __('common.warning') }}");
                            return;
                        }

                        $('#confirm-bulk-delete-buyer').modal('show');
                    });

                    $('#confirm_bulk_delete_buyer').on('click', function() {
                        var ids = [];
                        $('#' + bulkDeleteTableId + ' .buyer_row_checkbox:checked').each(function() {
                            ids.push($(this).val());
                        });

                        if (!ids.length) {
                            $('#confirm-bulk-delete-buyer').modal('hide');
                            return;
                        }

                        $('#pre-loader').removeClass('d-none');
                        $('#confirm-bulk-delete-buyer').modal('hide');

                        $.ajax({
                            url: "{{ route('admin.customer.bulk_destroy') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                ids: ids
                            },
                            success: function(response) {
                                if (response.deleted > 0) {
                                    toastr.success(response.message, "{{ __('common.success') }}");
                                } else {
                                    toastr.warning(response.message, "{{ __('common.warning') }}");
                                }
                                reloadBuyerTables();
                                $('.bulk_delete_buyers').addClass('d-none');
                                $('#pre-loader').addClass('d-none');
                            },
                            error: function(response) {
                                if (response.responseJSON && response.responseJSON.message) {
                                    toastr.error(response.responseJSON.message, "{{ __('common.error') }}");
                                } else {
                                    toastr.error("{{ __('common.error_message') }}", "{{ __('common.error') }}");
                                }
                                $('#pre-loader').addClass('d-none');
                            }
                        });
                    });

                    $(document).on('change', '.update_active_status', function(event){
                        let id = $(this).data('id');
                        let status = 0;

                        if($(this).prop('checked')){
                            status = 1;
                        }
                        else{
                            status = 0;
                        }
                        $("#pre-loader").removeClass('d-none');

                        $.post('{{ route('customer.update_active_status') }}', {_token:'{{ csrf_token() }}', id:id, status:status}, function(data){
                            if(data == 1){
                                toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                                activeCustomerDataTable();
                                inactiveCustomerDataTable();
                            }
                            else{
                                toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                            }
                            $("#pre-loader").addClass('d-none');
                        })

                        .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }

                                });
                    });

                    function activeCustomerDataTable(){
                        $('#activeCustomerTable').DataTable({
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            "ajax": ( {
                                url: "{{ route('cusotmer.list.get-data') }}" + '?table=active_customer'
                            }),
                            "initComplete":function(json){

                            },
                            columns: buyerTableColumns(),

                            bLengthChange: false,
                            "bDestroy": true,
                            language: {
                                search: "<i class='ti-search'></i>",
                                searchPlaceholder: trans('common.quick_search'),
                                paginate: {
                                    next: "<i class='ti-arrow-right'></i>",
                                    previous: "<i class='ti-arrow-left'></i>"
                                }
                            },
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'Copy',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    title: $("#header_title").text(),
                                    margin: [10, 10, 10, 0],
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    },

                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    },
                                    pageSize: 'A4',
                                    margin: [0, 0, 0, 0],
                                    alignment: 'center',
                                    header: true,

                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    title: $("#header_title").text(),
                                    exportOptions: {
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fa fa-columns"></i>',
                                    postfixButtons: ['colvisRestore']
                                }
                            ],
                            columnDefs: [{
                                visible: false
                            }],
                            responsive: true,
                        });
                    }

                    function allCustomerDataTable(){
                        $('#allCustomerTable').DataTable({
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            "ajax": ( {
                                url: "{{ route('cusotmer.list.get-data') }}" + '?table=all_customer'
                            }),
                            "initComplete":function(json){

                            },
                            columns: buyerTableColumns(),

                            bLengthChange: false,
                            "bDestroy": true,
                            language: {
                                search: "<i class='ti-search'></i>",
                                searchPlaceholder: trans('common.quick_search'),
                                paginate: {
                                    next: "<i class='ti-arrow-right'></i>",
                                    previous: "<i class='ti-arrow-left'></i>"
                                }
                            },
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'Copy',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    title: $("#header_title").text(),
                                    margin: [10, 10, 10, 0],
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    },

                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    },
                                    pageSize: 'A4',
                                    margin: [0, 0, 0, 0],
                                    alignment: 'center',
                                    header: true,

                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    title: $("#header_title").text(),
                                    exportOptions: {
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fa fa-columns"></i>',
                                    postfixButtons: ['colvisRestore']
                                }
                            ],
                            columnDefs: [{
                                visible: false
                            }],
                            responsive: true,
                        });
                    }

                    function inactiveCustomerDataTable(){
                        $('#inactiveCustomerTable').DataTable({
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            "ajax": ( {
                                url: "{{ route('cusotmer.list.get-data') }}" + '?table=inactive_customer'
                            }),
                            "initComplete":function(json){

                            },
                            columns: buyerTableColumns(),

                            bLengthChange: false,
                            "bDestroy": true,
                            language: {
                                search: "<i class='ti-search'></i>",
                                searchPlaceholder: trans('common.quick_search'),
                                paginate: {
                                    next: "<i class='ti-arrow-right'></i>",
                                    previous: "<i class='ti-arrow-left'></i>"
                                }
                            },
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'Copy',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    title: $("#header_title").text(),
                                    margin: [10, 10, 10, 0],
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    },

                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: buyerExportColumns
                                    },
                                    pageSize: 'A4',
                                    margin: [0, 0, 0, 0],
                                    alignment: 'center',
                                    header: true,

                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    title: $("#header_title").text(),
                                    exportOptions: {
                                        columns: buyerExportColumns
                                    }
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fa fa-columns"></i>',
                                    postfixButtons: ['colvisRestore']
                                }
                            ],
                            columnDefs: [{
                                visible: false
                            }],
                            responsive: true,
                        });
                    }

                });
            })(jQuery);

    </script>
@endpush
