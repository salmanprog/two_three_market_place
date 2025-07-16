@extends('frontend.amazy.layouts.app')
<style>
    @media (max-width:767px){
        .sumery_product_details .table-responsive table{
            width: 700px
        }
        .summery_pro_content{
            padding-left: 40px;
        }
        .sumery_product_details .amazy_table3 tbody tr td{
            padding: 10px
        }
    }
    
    .resell_product_card {
        border: 1px solid #e4e6ea;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .resell_product_card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .product_image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .resell_price {
        color: #28a745;
        font-weight: 600;
        font-size: 16px;
    }
    
    .status_badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .empty_state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }
    
    .empty_state i {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 20px;
    }
</style>

@section('content')
    <div class="amazy_dashboard_area dashboard_bg section_spacing6">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    @include('frontend.amazy.pages.profile.partials._menu')
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard_white_box_header d-flex align-items-center gap_20  mb_20">
                        <h3 class="font_20 f_w_700 mb-0 ">{{__('My Resell Products')}}</h3>
                    </div>
                    <div class="dashboard_white_box bg-white mb_25 pt-0 ">
                        <div class="dashboard_white_box_body">
                            @if(isset($resellProducts) && $resellProducts->count() > 0)
                                <div class="row">
                                    @foreach($resellProducts as $product)
                                        <div class="col-lg-12">
                                            <div class="resell_product_card">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2">
                                                        <img src="{{ asset($product->thumbnail_image_source) }}" alt="{{ $product->product_name }}" class="product_image">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="product_info">
                                                            <h4 class="font_16 f_w_600 mb-2">{{ $product->product_name }}</h4>
                                                            <p class="font_14 f_w_500 mb-1"><strong>Brand:</strong> {{ $product->brand->name ?? 'N/A' }}</p>
                                                            <p class="font_14 f_w_500 mb-1"><strong>Category:</strong> 
                                                                @if($product->categories->count() > 0)
                                                                    {{ $product->categories->first()->name }}
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </p>
                                                            <p class="font_14 f_w_500 mb-0"><strong>Status:</strong> 
                                                                <span class="status_badge">Active</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="text-end">
                                                            <p class="resell_price mb-1">{{ single_price($product->resell_price) }}</p>
                                                            <p class="font_14 f_w_500 text-muted">Resell Price</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                @if($resellProducts->lastPage() > 1)
                                    <x-pagination-component :items="$resellProducts" type=""/>
                                @endif
                            @else
                                <div class="empty_state">
                                    <i class="ti-package"></i>
                                    <h4>No Resell Products Found</h4>
                                    <p>You haven't submitted any products for resale yet.</p>
                                    <a href="{{ route('frontend.my_purchase_order_index') }}" class="btn btn-primary">
                                        <i class="ti-plus"></i> Browse My Purchases
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
