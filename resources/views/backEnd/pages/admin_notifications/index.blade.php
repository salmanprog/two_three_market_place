@extends('backEnd.master')
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('common.notifications') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table">
                        <div class="table-responsive">
                            <table class="table Crm_table_active3">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.sl') }}</th>
                                        <th scope="col">{{ __('common.message') }}</th>
                                        <th scope="col">{{ __('common.status') }}</th>
                                        <th scope="col">{{ __('common.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $index => $row)
                                        <tr>
                                            <td>{{ $items->firstItem() + $index }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($row->message, 120) }}</td>
                                            <td>
                                                @if($row->is_read === '1')
                                                    <span class="badge badge-success">{{ __('Read') }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ __('Un-Read') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(str_starts_with((string) ($row->slug ?? ''), 'seller-product-request-'))
                                                    <a href="{{ url('/products#order_complete_data') }}" class="primary-btn small fix-gr-bg mr-2">{{ __('review.review') }}</a>
                                                @endif
                                                @php
                                                    $chatReceiverId = $row->chat_receiver_user_id ?? null;
                                                    $chatHref = $chatReceiverId
                                                        ? route('chat.messages.index', ['receiver_id' => $chatReceiverId])
                                                        : route('chat.messages.index');
                                                @endphp
                                                <a href="{{ $chatHref }}" class="primary-btn small fix-gr-bg">{{ __('common.chat') }}</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">{{ __('common.no_notification_found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
