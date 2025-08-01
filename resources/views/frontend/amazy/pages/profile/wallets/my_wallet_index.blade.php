@extends('frontend.amazy.layouts.app')
@section('content')
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25">
                    <div class="dashboard_white_box_header d-flex align-items-center">
                        <h4 class="font_24 f_w_700 mb_20">{{ __('wallet.my_wallet') }}</h4>
                    </div>
                    <div class="dashboard_wallet_boxes mb_40">
                        <div class="singl_dashboard_wallet green_box d-flex align-items-center justify-content-center flex-column">
                            <h4 class="font_16 f_w_400 lh-1">{{ __('wallet.running_balance') }}</h4>
                            <h3 class="f_w_700 m-0 lh-1">{{ auth()->check()?single_price(auth()->user()->SellerCurrentWalletAmounts):single_price(0.00) }}</h3>
                        </div>
                        <div class="singl_dashboard_wallet pink_box d-flex align-items-center justify-content-center flex-column">
                            <h4 class="font_16 f_w_400 lh-1">{{ __('wallet.withdraw_balance') }}</h4>
                            <!-- <h3 class="f_w_700 m-0 lh-1">{{ auth()->check()?single_price(auth()->user()->CustomerCurrentWalletPendingAmounts):single_price(0.00) }}</h3> -->
                            <h3 class="f_w_700 m-0 lh-1">{{ auth()->check()?single_price(auth()->user()->SellerWithdrawAmounts):single_price(0.00) }}</h3>
                        </div>
                        <div  data-bs-toggle="modal" data-bs-target="#recharge_walletss" class="singl_dashboard_wallet bordered d-flex align-items-center justify-content-center flex-column gj-cursor-pointer ">
                            <h4 class="font_16 f_w_400 lh-1 mb_10 mute_text">{{__('wallet.pending_withdraw_balance')}}</h4>
                            <h3 class="f_w_700 m-0 lh-1">{{ auth()->check()?single_price(auth()->user()->SellerPendingWithdrawAmounts):single_price(0.00) }}</h3>
                        </div>
                    </div>

                    <div class="dashboard_white_box_header d-flex align-items-center">
                        <h4 class="font_20 f_w_700 mb_20">{{__('wallet.wallet_recharge_history')}}</h4>
                        <ul class="d-flex">
                                <li><a class="amaz_primary_btn radius_30px mb_20 fix-gr-bg getNewForm" href="" style="padding:4.5px 9px;margin-left:5px"><i class="ti-plus"></i>{{ __('wallet.withdraw_now') }}</a></li>
                            </ul>
                    </div>
                    <div class="dashboard_white_box_body">
                        <div class="table_border_whiteBox mb_30">
                            <div class="table-responsive">
                                <table class="table amazy_table style3 mb-0">
                                    <thead>
                                        <tr>
                                        <th class="font_14 f_w_700 priamry_text" scope="col">{{ __('common.date') }}</th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">{{ __('common.txn_id') }}</th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">{{ __('common.amount') }}</th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">{{ __('common.type') }}</th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">{{ __('common.payment_method') }}</th>
                                        <th class="font_14 f_w_700 priamry_text" scope="col">{{ __('common.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $key => $transaction)
                                            <tr>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text">{{ dateConvert($transaction->created_at) }}</span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text">
                                                        @if ($transaction->txn_id)
                                                            @if ($transaction->txn_id = "None")
                                                                {{__("common.none") }}
                                                            @elseif ($transaction->txn_id == "Added By Admin")
                                                                {{__("wallet.added_by_admin") }}
                                                            @else
                                                            {{ $transaction->txn_id }}
                                                            @endif
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text">{{ single_price($transaction->amount) }}</span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text">
                                                        @php
                                                        switch ($transaction->type) {
                                                            case 'Deposite':
                                                            echo __("wallet.deposite");
                                                            break;
                                                            case 'Cart Payment':
                                                            echo __("wallet.cart_payment");
                                                            break;
                                                            case 'Refund Back':
                                                            echo __("wallet.refund_back");
                                                            break;
                                                            case 'Refund':
                                                            echo __("wallet.refund");
                                                            break;
                                                            case 'Withdraw':
                                                            echo __("wallet.withdraw");
                                                            break;
                                                            case 'point':
                                                            echo __("clubpoint.point");
                                                            break;
                                                            default:
                                                            echo $transaction->type;
                                                            break;
                                                        }
                                                        @endphp
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text">{{ $transaction->GatewayName }}</span>
                                                </td>
                                                <td>
                                                    @if ($transaction->status == 1)
                                                        <a class="table_badge_btn style4 text-nowrap">{{__('common.approved')}}</a>
                                                    @else
                                                        <a class="table_badge_btn style3 text-nowrap">{{__('common.pending')}}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if(count($transactions) < 1)
                                    <p class="empty_p">{{ __('common.empty_list') }}.</p>
                                @endif
                            </div>
                        </div>
                        @if($transactions->lastPage() > 1)
                            <x-pagination-component :items="$transactions" type=""/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="sign" class="sign" value="{{ app('general_setting')->currency_symbol }}">
        <input type="hidden" name="current_balance" class="current_balance" value="{{ auth()->user()->SellerCurrentWalletAmounts }}">
        <input type="hidden" name="pending_withdraw_balance" class="pending_withdraw_balance" value="{{ auth()->user()->SellerPendingWithdrawAmounts }}">
        <input type="hidden" name="remaining_balance" class="remaining_balance" value="{{ auth()->user()->SellerCurrentWalletAmounts - auth()->user()->SellerPendingWithdrawAmounts }}">
</div>
@include('wallet::backend.seller.withdraw_requests.withdraw_update_modal')
@include('wallet::backend.seller.withdraw_requests.withdraw_modal')
@endsection
@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                $(document).on('click', '.getNewForm', function(event){
                    event.preventDefault();
                    $('#amount_error_create').text('');
                    $("#Withdraw_Modal").modal('show');
                    var sign = $('.sign').val();
                    var current_balance = $('.current_balance').val();
                    var pending_withdraw_balance = $('.pending_withdraw_balance').val();
                    var remaining_balance = $('.remaining_balance').val();
                    var amount = $('.remaining_balance').val();
                    $(".running_balance").text(sign +' '+ current_balance);
                    $(".pending_withdraw_balance").text(sign +' '+ pending_withdraw_balance);
                    $(".remaining_balance").text(sign +' '+ remaining_balance);
                    $(".amount").val(remaining_balance);

                });

                $(document).on('click', '.getEditForm', function(event){
                    event.preventDefault();
                    $('#amount_error_update').text('');
                    let el = $(this).data('value');
                    $('#this_data_amount').val(el.amount);
                    $("#Withdraw_EditModal").modal('show');
                    var sign = $('.sign').val();
                    var current_balance = $('.current_balance').val();
                    var pending_withdraw_balance = $('.pending_withdraw_balance').val();
                    var remaining_balance = $('.remaining_balance').val();
                    var amount = $('.remaining_balance').val();
                    $(".id").val(el.id);
                    $(".edit_amount").val(el.amount);
                    $(".edit_running_balance").text(sign +' '+ current_balance);
                    $(".edit_pending_withdraw_balance").text(sign +' '+ pending_withdraw_balance);
                    $(".edit_remaining_balance").text(sign +' '+ remaining_balance);
                });

                $(document).on('submit', '#withdraw_form', function(event){
                    $('#amount_error_create').text('');
                    var remaining_balance = $('.remaining_balance').val();
                    let withdarw_amount = $('#withdraw_amount_add').val();
                    if(withdarw_amount == '' || withdarw_amount < 1){
                        $('#amount_error_create').text('The Amount is Required.');
                        event.preventDefault();
                    }
                    else if(parseFloat(remaining_balance) < parseFloat(withdarw_amount)){
                        $('#amount_error_create').text('Withdraw Amount Must be Smaller Than Remaining Balance.');
                        event.preventDefault();
                    }
                });

                $(document).on('submit', '#withdraw_update_form', function(event){
                    $('#amount_error_update').text('');
                    var remaining_balance = $('.remaining_balance').val();
                    let withdarw_amount = $('.edit_amount').val();
                    let this_data = $('#this_data_amount').val();
                    let total = parseFloat(this_data) + parseFloat(remaining_balance);
                    if(withdarw_amount == '' || withdarw_amount < 1){
                        $('#amount_error_update').text('The Amount is Required.');
                        event.preventDefault();
                    }
                    else if(parseFloat(total) < parseFloat(withdarw_amount)){
                        $('#amount_error_update').text('Withdraw Amount Must be Smaller Than Remaining Balance.');
                        event.preventDefault();
                    }
                });

                $('#myWithdrawTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": ( {
                        url: "{{ route('my-wallet.withdraw_get_data') }}"
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'txn_id', name: 'txn_id' },
                        { data: 'amount', name: 'amount' },
                        { data: 'type', name: 'type' },
                        { data: 'payment_method', name: 'payment_method' },
                        { data: 'approval', name: 'approval' },
                        { data: 'action', name: 'action' }

                    ],

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
                                columns: ':not(:last-child)',
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
                                columns: ':not(:last-child)',
                            },

                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
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
                                columns: ':not(:last-child)',
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

                $(document).on('submit', '#recharge_form', function(event){
                    $('#error_amount').text('');

                    let amount = $('#recharge_amount').val();
                    let val_check = 0;
                    if(amount == '' || amount < 1){
                        $('#error_amount').text('{{__("validation.the_amount_field_is_required")}}');
                        val_check = 1;
                    }

                    if(val_check == 1){
                        event.preventDefault();
                    }
                });

                $(document).on('submit', '#redeem_form', function(event){
                    $('#error_secret_code').text('');

                    let secret_code = $('#secret_code').val();
                    let val_check = 0;
                    if(secret_code == ''){
                        $('#error_secret_code').text('{{__("validation.the_secret_code_field_is_required")}}');
                        val_check = 1;
                    }

                    if(val_check == 1){
                        event.preventDefault();
                    }
                });

            });
        })(jQuery);
    </script>
@endpush
