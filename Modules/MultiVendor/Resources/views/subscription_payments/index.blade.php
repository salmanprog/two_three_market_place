@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex align-items-center">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('seller.subscription_payment') }}  {{ __('common.list') }}</h3>
                            @if (permissionCheck('admin.subscription_payment_list'))
                            <button type="button" class="primary-btn fix-gr-bg small d-none bulk_delete_subscription_payments">
                                <i class="ti-trash"></i> {{ __('common.bulk_delete') }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <div class="">
                                <table class="table" id="sellerTable">
                                    <thead>
                                        <tr>
                                            @if (permissionCheck('admin.subscription_payment_list'))
                                            <th>
                                                <label class="primary_checkbox d-flex mr-0 mb-0">
                                                    <input type="checkbox" class="select_all_subscription_payments">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            @endif
                                            <th>{{ __('common.sl') }}</th>
                                            <th>{{ __('common.seller') }}</th>
                                            <th>{{ __('common.subscription') }}</th>
                                            <th>{{ __('common.type') }}</th>
                                            <th>{{ __('common.create_date') }}</th>
                                            <th>{{ __('common.expire_date') }}</th>
                                            <th>{{ __('common.method') }}</th>
                                            <th>{{ __('common.amount') }}</th>
                                            <th>{{ __('common.txn_id') }}</th>
                                            <th>{{ __('common.is_approve') }}</th>
                                            <th>{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('multivendor::merchants.confirm_modal')
@include('backEnd.partials.delete_modal',['item_name' => __('seller.subscription_payment')])

<div class="modal fade" id="confirm-bulk-delete-subscription-payment">
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
                    <button type="button" class="primary-btn fix-gr-bg" id="confirm_bulk_delete_subscription_payment">{{ __('common.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">

        (function($){
            "use strict";
            $(document).on('change','.is_approve', function(){
                if($(this).is(':checked') == true){
                    var status = 1;
                }
                else{
                    var status = 0;
                }
                $("#pre-loader").removeClass('d-none');
                $.post('{{ route("admin.subscription_payment_approve") }}', {_token:'{{ csrf_token() }}', id:this.value, status:status}, function(data){
                    if(data == 1){
                        toastr.success("{{__('common.successful')}}","{{__('common.success')}}")
                        $("#pre-loader").addClass('d-none');
                    }
                    else{
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");

                        $("#pre-loader").addClass('d-none');
                    }
                })

                .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

                    });
            });
            $(document).ready(function(){
                var subscriptionExportColumns = "{{ permissionCheck('admin.subscription_payment_list') ? ':not(:first-child):not(:last-child)' : ':not(:last-child)' }}";

                function subscriptionTableColumns() {
                    var cols = [];
                    @if (permissionCheck('admin.subscription_payment_list'))
                    cols.push({ data: 'checkbox', name: 'checkbox', orderable: false, searchable: false });
                    @endif
                    cols.push(
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'name', name: 'name' },
                        { data: 'subcription', name: 'subcription' },
                        { data: 'type', name: 'type' },
                        { data: 'date', name: 'date' },
                        { data: 'expire_date', name: 'expire_date' },
                        { data: 'payment_method', name: 'payment_method' },
                        { data: 'amount', name: 'amount' },
                        { data: 'txn_id', name: 'txn_id' },
                        { data: 'is_approved', name: 'is_approved' },
                        { data: 'action', name: 'action' }
                    );
                    return cols;
                }

                function reloadSubscriptionTable() {
                    $('#sellerTable').DataTable().ajax.reload();
                }

                function toggleSubscriptionBulkDeleteButton() {
                    var hasChecked = $('#sellerTable .subscription_payment_row_checkbox:checked').length > 0;
                    $('.bulk_delete_subscription_payments').toggleClass('d-none', !hasChecked);
                }

                $(document).on('click', '.delete_subscription_payment', function(event){
                    event.preventDefault();
                    let value = $(this).data('value');
                    confirm_modal(value);
                });

                $(document).on('change', '.select_all_subscription_payments', function() {
                    var checked = $(this).is(':checked');
                    $('#sellerTable .subscription_payment_row_checkbox').prop('checked', checked);
                    toggleSubscriptionBulkDeleteButton();
                });

                $(document).on('change', '.subscription_payment_row_checkbox', function() {
                    var total = $('#sellerTable .subscription_payment_row_checkbox').length;
                    var checked = $('#sellerTable .subscription_payment_row_checkbox:checked').length;
                    $('.select_all_subscription_payments').prop('checked', total > 0 && total === checked);
                    toggleSubscriptionBulkDeleteButton();
                });

                $(document).on('click', '.bulk_delete_subscription_payments', function() {
                    if (!$('#sellerTable .subscription_payment_row_checkbox:checked').length) {
                        toastr.warning("{{ __('common.select_one') }}", "{{ __('common.warning') }}");
                        return;
                    }
                    $('#confirm-bulk-delete-subscription-payment').modal('show');
                });

                $('#confirm_bulk_delete_subscription_payment').on('click', function() {
                    var ids = [];
                    $('#sellerTable .subscription_payment_row_checkbox:checked').each(function() {
                        ids.push($(this).val());
                    });

                    if (!ids.length) {
                        $('#confirm-bulk-delete-subscription-payment').modal('hide');
                        return;
                    }

                    $('#pre-loader').removeClass('d-none');
                    $('#confirm-bulk-delete-subscription-payment').modal('hide');

                    $.ajax({
                        url: "{{ route('admin.subscription_payment.bulk_destroy') }}",
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
                            reloadSubscriptionTable();
                            $('.bulk_delete_subscription_payments').addClass('d-none');
                            $('.select_all_subscription_payments').prop('checked', false);
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

                $('#sellerTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": ( {
                        url: "{{ route('admin.subscription_payment_dtbl') }}"
                    }),
                    "initComplete":function(json){

                    },
                    columns: subscriptionTableColumns(),

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
                                columns: subscriptionExportColumns
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
                                columns: subscriptionExportColumns
                            },

                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible',
                                columns: subscriptionExportColumns
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible',
                                columns: subscriptionExportColumns
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
                                columns: subscriptionExportColumns
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

            });
        })(jQuery);


    </script>
@endpush
