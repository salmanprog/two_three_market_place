@extends('frontend.amazy.layouts.app')
@section('styles')

@section('title')
    {{ __('My Resell Products') }}
@endsection

@section('content')
    <div class="amazy_dashboard_area dashboard_bg section_spacing6">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    @include('frontend.amazy.pages.profile.partials._menu')
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="font_20 f_w_700 mb-0">{{ __('My Resell Products') }}</h3>
                        </div>
                        <div class="card-body">
                            @if (isset($resellRequests) && $resellRequests->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Original Price</th>
                                                <th>Resell Price</th>
                                                <th>Condition</th>
                                                <th>Status</th>
                                                <th>Submitted Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($resellRequests as $request)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($request->product && $request->product->thumbnail_image_source)
                                                                <img src="{{ asset($request->product->thumbnail_image_source) }}"
                                                                    alt="{{ $request->product->product_name }}"
                                                                    class="img-thumbnail"
                                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                            @endif

                                                        </div>
                                                    </td>
                                                    <td>{{ single_price($request->actual_price) }}</td>
                                                    <td>{{ single_price($request->selling_price) }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $request->product_condition == 'new' ? 'success' : 'warning' }}">
                                                            {{ ucfirst($request->product_condition) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($request->status == 'pending')
                                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                        @elseif($request->status == 'approved')
                                                            <span class="badge badge-success">{{ __('Approved') }}</span>
                                                        @elseif($request->status == 'rejected')
                                                            <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $request->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        @if ($request->status == 'pending')
                                                            <button class="btn btn-sm btn-warning"
                                                                disabled>{{ __('Under Review') }}</button>
                                                        @elseif($request->status == 'approved')
                                                            <span class="text-success">{{ __('Ready for Sale') }}</span>
                                                        @elseif($request->status == 'rejected')
                                                            @if ($request->admin_note)
                                                                <button type="button" class="btn btn-sm btn-info"
                                                                    data-toggle="tooltip"
                                                                    title="{{ $request->admin_note }}">
                                                                    {{ __('View Reason') }}
                                                                </button>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if ($resellRequests->lastPage() > 1)
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $resellRequests->links() }}
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">{{ __('No Resell Products Found') }}</h5>
                                    <p class="text-muted">{{ __('You haven\'t submitted any products for resale yet.') }}
                                    </p>
                                    <a href="{{ route('frontend.my_purchase_order_list') }}" class="btn btn-primary">
                                        {{ __('Go to My Orders') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
