@extends('layouts.admin')

@section('title', 'Reseller Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reseller Dashboard</h4>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $statistics['total_requests'] }}</h4>
                                            <p class="mb-0">Total Requests</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-file-alt fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $statistics['pending_requests'] }}</h4>
                                            <p class="mb-0">Pending Requests</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $statistics['approved_requests'] }}</h4>
                                            <p class="mb-0">Approved Requests</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $statistics['total_resale_products'] }}</h4>
                                            <p class="mb-0">Resale Products</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-tags fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profit Summary -->
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Profit Summary</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Total Customer Profit</h6>
                                            <h4 class="text-success">${{ number_format($statistics['total_customer_profit'], 2) }}</h4>
                                        </div>
                                        <div class="col-6">
                                            <h6>Total Admin Profit</h6>
                                            <h4 class="text-primary">${{ number_format($statistics['total_admin_profit'], 2) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('admin.resell-requests.index', ['status' => 'pending']) }}" class="btn btn-warning btn-block">
                                                <i class="fas fa-clock"></i> Review Pending
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin.resale-products.index') }}" class="btn btn-info btn-block">
                                                <i class="fas fa-tags"></i> View Resale Products
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Requests -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Resell Requests</h5>
                                </div>
                                <div class="card-body">
                                    @if($recentRequests->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Condition</th>
                                                        <th>Selling Price</th>
                                                        <th>Status</th>
                                                        <th>Created</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($recentRequests as $request)
                                                        <tr>
                                                            <td>#{{ $request->id }}</td>
                                                            <td>{{ $request->customer->name ?? 'N/A' }}</td>
                                                            <td>{{ $request->product->product_name ?? 'N/A' }}</td>
                                                            <td>
                                                                <span class="badge badge-{{ $request->product_condition == 'new' ? 'success' : 'warning' }}">
                                                                    {{ ucfirst($request->product_condition) }}
                                                                </span>
                                                            </td>
                                                            <td>${{ number_format($request->selling_price, 2) }}</td>
                                                            <td>
                                                                @if($request->status == 'pending')
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @elseif($request->status == 'approved')
                                                                    <span class="badge badge-success">Approved</span>
                                                                @else
                                                                    <span class="badge badge-danger">Rejected</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.resell-requests.show', $request->id) }}" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted"></i>
                                            <p class="mt-2 text-muted">No resell requests found.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any JavaScript for dashboard functionality
    $(document).ready(function() {
        // Auto-refresh statistics every 30 seconds
        setInterval(function() {
            // You can add AJAX call here to refresh statistics
        }, 30000);
    });
</script>
@endpush 