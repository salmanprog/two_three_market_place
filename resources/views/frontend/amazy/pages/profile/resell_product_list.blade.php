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
                            @if (isset($resellProducts) && $resellProducts->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Original Price</th>
                                                <th>Resell Price</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($resellProducts as $product)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($product->thumbnail_image_source)
                                                                <img src="{{ showImage($product->thumbnail_image_source) }}"
                                                                    alt="{{ $product->product_name }}"
                                                                    class="img-thumbnail me-3"
                                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                            @endif
                                                            <div>
                                                                <h6 class="mb-0">{{ $product->product_name }}</h6>
                                                                @if($product->resell_description)
                                                                    <small class="text-muted">{{ \Illuminate\Support\Str::limit($product->resell_description, 50) }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @php
                                                            // Find the original product this was duplicated from
                                                            $originalProductName = str_replace(' (Resell)', '', $product->product_name);
                                                            $originalProduct = \Modules\Product\Entities\Product::where('product_name', $originalProductName)
                                                                ->where('resell_product', '!=', 1)
                                                                ->first();

                                                            // If not found by name, try to get from resell table
                                                            if (!$originalProduct) {
                                                                $resellRecord = \DB::table('resell')->where('product_id', $product->id)->first();
                                                                if ($resellRecord) {
                                                                    // Get the original product price from order history or seller products
                                                                    $originalPrice = 0; // Default fallback
                                                                }
                                                            }
                                                        @endphp
                                                        @if($originalProduct && $originalProduct->skus->count() > 0)
                                                            <span class="text-muted">{{ single_price($originalProduct->skus->first()->selling_price ?? 0) }}</span>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong class="text-primary" id="resell-price-{{ $product->id }}">{{ single_price($product->resell_price) }}</strong>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                                    </td>
                                                    <td>{{ $product->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <div class="d-flex gap-2 align-items-center" role="group">
                                                            <button type="button" class="btn btn-sm mb-1"
                                                                style="background-color: #000; color: white; border: 1px solid #333;"
                                                                onclick="openEditModal({{ $product->id }})">
                                                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                            </button>
                                                            <button type="button" class="btn btn-sm mb-1"
                                                                style="background-color: #000; color: white; border: 1px solid #333;"
                                                                onclick="viewProduct({{ $product->id }})">
                                                                <i class="fas fa-eye"></i> {{ __('View') }}
                                                            </button>
                                                            <button type="button" class="btn btn-sm"
                                                                style="background-color: #000; color: white; border: 1px solid #333;"
                                                                onclick="deleteProduct({{ $product->id }})">
                                                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if ($resellProducts->lastPage() > 1)
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $resellProducts->links() }}
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

    <!-- Edit Resell Product Modal -->
    <div class="modal fade" id="editResellModal" tabindex="-1" role="dialog" aria-labelledby="editResellModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #000; color: white;">
                    <h5 class="modal-title text-white" id="editResellModalLabel">
                        <i class="fas fa-edit"></i> Edit Resell Product
                    </h5>
                    <button type="button" class="close text-white" style="opacity: 1; font-size: 30px;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editResellForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Product Image -->
                            <div class="col-md-4">
                                <div class="text-center">
                                    <img id="modal-product-image" src="" alt="Product Image"
                                         class="img-fluid rounded" style="max-height: 200px; width: 100%; object-fit: cover;">
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="font-weight-bold">Product Name</label>
                                    <input type="text" id="modal-product-name" class="form-control" readonly>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Original Price</label>
                                            <input type="text" id="modal-original-price" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Current Resell Price</label>
                                            <input type="text" id="modal-current-price" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">New Resell Price <span class="text-danger">*</span></label>
                                    <input type="number" id="modal-new-price" class="form-control"
                                           step="0.01" min="0" placeholder="Enter new resell price" required>
                                    <small class="text-muted">Enter the new price you want to sell this product for</small>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Description</label>
                                    <textarea id="modal-description" class="form-control" rows="3" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn text-white" style="background-color: #000;">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Resell Product Modal -->
    <div class="modal fade" id="viewResellModal" tabindex="-1" role="dialog" aria-labelledby="viewResellModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #000; color: white;">
                    <h5 class="modal-title text-white" id="viewResellModalLabel">
                        <i class="fas fa-eye"></i> View Resell Product Details
                    </h5>
                    <button type="button" class="close text-white" style="opacity: 1; font-size: 30px;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-md-4">
                            <div class="text-center">
                                <img id="view-modal-product-image" src="" alt="Product Image"
                                     class="img-fluid rounded" style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-weight-bold">Product Name</label>
                                <input type="text" id="view-modal-product-name" class="form-control" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Original Price</label>
                                        <input type="text" id="view-modal-original-price" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Resell Price</label>
                                        <input type="text" id="view-modal-resell-price" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Status</label>
                                        <input type="text" id="view-modal-status" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Created Date</label>
                                        <input type="text" id="view-modal-created-date" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Description</label>
                                <textarea id="view-modal-description" class="form-control" rows="3" readonly></textarea>
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
        let currentProductId = null;

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            // Handle form submission
            $('#editResellForm').on('submit', function(e) {
                e.preventDefault();
                updateResellPrice();
            });
        });

        function openEditModal(productId) {
            currentProductId = productId;

            // Get product data from the table row
            const row = $(`button[onclick="openEditModal(${productId})"]`).closest('tr');
            const productName = row.find('h6').text().trim();
            const productImage = row.find('img').attr('src');
            const originalPrice = row.find('td:nth-child(2) span').text().trim();
            const currentPrice = row.find(`#resell-price-${productId}`).text().trim();
            const description = row.find('small.text-muted').text().trim();

            // Populate modal fields
            $('#modal-product-image').attr('src', productImage);
            $('#modal-product-name').val(productName);
            $('#modal-original-price').val(originalPrice);
            $('#modal-current-price').val(currentPrice);
            $('#modal-description').val(description || 'No description available');
            $('#modal-new-price').val('');

            // Show modal
            $('#editResellModal').modal('show');
        }

        function updateResellPrice() {
            const newPrice = $('#modal-new-price').val();

            if (!newPrice || parseFloat(newPrice) <= 0) {
                toastr.error('Please enter a valid price greater than 0.');
                return;
            }

            // Show loading state
            const submitBtn = $('#editResellForm button[type="submit"]');
            const originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Updating...').prop('disabled', true);

            $.ajax({
                url: `/resell-product/update-price/${currentProductId}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    new_price: newPrice
                },
                success: function(response) {
                    if (response.success) {
                        // Update the price in the table
                        $(`#resell-price-${currentProductId}`).html(`<strong class="text-primary">${response.formatted_price}</strong>`);

                        // Close modal
                        $('#editResellModal').modal('hide');

                        // Show success message
                        toastr.success('Resell price updated successfully!');
                    } else {
                        toastr.error(response.message || 'Failed to update price.');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred while updating the price.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage);
                },
                complete: function() {
                    // Reset button state
                    submitBtn.html(originalText).prop('disabled', false);
                }
            });
        }

        function viewProduct(productId) {
            // Get product data from the table row
            const row = $(`button[onclick="viewProduct(${productId})"]`).closest('tr');
            const productName = row.find('h6').text().trim();
            const productImage = row.find('img').attr('src');
            const originalPrice = row.find('td:nth-child(2) span').text().trim();
            const resellPrice = row.find(`#resell-price-${productId}`).text().trim();
            const status = row.find('.badge').text().trim();
            const createdDate = row.find('td:nth-child(5)').text().trim();
            const description = row.find('small.text-muted').text().trim();

            // Populate view modal fields
            $('#view-modal-product-image').attr('src', productImage);
            $('#view-modal-product-name').val(productName);
            $('#view-modal-original-price').val(originalPrice);
            $('#view-modal-resell-price').val(resellPrice);
            $('#view-modal-status').val(status);
            $('#view-modal-created-date').val(createdDate);
            $('#view-modal-description').val(description || 'No description available');

            // Show view modal
            $('#viewResellModal').modal('show');
        }

        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this resell product? This action cannot be undone.')) {
                $.ajax({
                    url: `/resell-product/delete/${productId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Resell product deleted successfully!');
                            location.reload();
                        } else {
                            toastr.error(response.message || 'Failed to delete product.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred while deleting the product.');
                    }
                });
            }
        }

        // Reset modal when hidden
        $('#editResellModal').on('hidden.bs.modal', function() {
            $('#editResellForm')[0].reset();
            currentProductId = null;
        });
    </script>
@endpush
