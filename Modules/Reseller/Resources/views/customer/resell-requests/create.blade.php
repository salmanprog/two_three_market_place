@extends('layouts.app')

@section('title', 'Submit Resell Request')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Submit Resell Request</h4>
                </div>
                <div class="card-body">
                    @if(isset($product) && isset($sellerProductSku))
                        <!-- Product Information -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <img src="{{ $product->thumbnail_image_source }}" alt="{{ $product->product_name }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h5>{{ $product->product_name }}</h5>
                                <p class="text-muted">{{ $product->description }}</p>
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Actual Price:</strong> ${{ number_format($sellerProductSku->selling_price, 2) }}
                                    </div>
                                    <div class="col-6">
                                        <strong>Brand:</strong> {{ $product->brand->name ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Resell Request Form -->
                        <form method="POST" action="{{ route('customer.resell-requests.store') }}" id="resellForm">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="seller_product_sku_id" value="{{ $sellerProductSku->id }}">

                            <div class="form-group">
                                <label for="product_condition">Product Condition *</label>
                                <select name="product_condition" id="product_condition" class="form-control" required>
                                    <option value="">Select Condition</option>
                                    <option value="new" {{ old('product_condition') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="used" {{ old('product_condition') == 'used' ? 'selected' : '' }}>Used</option>
                                </select>
                                @error('product_condition')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="selling_price">Selling Price *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" name="selling_price" id="selling_price" class="form-control" 
                                           step="0.01" min="{{ $sellerProductSku->selling_price * 1.1 }}" 
                                           value="{{ old('selling_price') }}" required>
                                </div>
                                <small class="form-text text-muted">
                                    Minimum selling price: ${{ number_format($sellerProductSku->selling_price * 1.1, 2) }}
                                </small>
                                @error('selling_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="customer_note">Additional Notes</label>
                                <textarea name="customer_note" id="customer_note" class="form-control" rows="3" 
                                          placeholder="Any additional information about the product condition, etc.">{{ old('customer_note') }}</textarea>
                                @error('customer_note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Profit Preview -->
                            <div class="card bg-light mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Profit Preview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Your Profit:</strong>
                                            <span id="customerProfit" class="text-success">$0.00</span>
                                        </div>
                                        <div class="col-6">
                                            <strong>Admin Commission:</strong>
                                            <span id="adminProfit" class="text-primary">$0.00</span>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <small class="text-muted">
                                                <strong>Formula:</strong> You get Actual Price + 50% of Profit, Admin gets 50% of Profit
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Submit Request
                                </button>
                                <a href="{{ route('customer.resell-requests.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Requests
                                </a>
                            </div>
                        </form>
                    @else
                        <!-- Product Selection -->
                        <div class="text-center">
                            <h5>Select a Product to Resell</h5>
                            <p class="text-muted">Choose from your available products to submit a resell request.</p>
                            
                            @if(isset($products) && $products->count() > 0)
                                <div class="row">
                                    @foreach($products as $product)
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img src="{{ $product->thumbnail_image_source }}" class="card-img-top" alt="{{ $product->product_name }}">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $product->product_name }}</h6>
                                                    <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                                                    <a href="{{ route('customer.resell-requests.create', ['product_id' => $product->id, 'seller_product_sku_id' => $product->skus->first()->id ?? 1]) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        Select Product
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                {{ $products->links() }}
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    No products available for resale at the moment.
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const actualPrice = {{ $sellerProductSku->selling_price ?? 0 }};
    
    function calculateProfit() {
        const sellingPrice = parseFloat($('#selling_price').val()) || 0;
        
        if (sellingPrice > actualPrice) {
            const profit = sellingPrice - actualPrice;
            const profitShare = profit * 0.5;
            const customerProfit = actualPrice + profitShare;
            const adminProfit = profitShare;
            
            $('#customerProfit').text('$' + customerProfit.toFixed(2));
            $('#adminProfit').text('$' + adminProfit.toFixed(2));
        } else {
            $('#customerProfit').text('$0.00');
            $('#adminProfit').text('$0.00');
        }
    }
    
    $('#selling_price').on('input', calculateProfit);
    
    // Initial calculation
    calculateProfit();
    
    // Form validation
    $('#resellForm').on('submit', function(e) {
        const sellingPrice = parseFloat($('#selling_price').val()) || 0;
        const minPrice = actualPrice * 1.1;
        
        if (sellingPrice < minPrice) {
            e.preventDefault();
            alert('Selling price must be at least 10% higher than the actual price.');
            return false;
        }
    });
});
</script>
@endpush 