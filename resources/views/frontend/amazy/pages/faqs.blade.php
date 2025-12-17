@extends('frontend.amazy.layouts.app')

@push('styles')
@endpush

@section('content')
<div class="flash_deal_banner">
    {{-- @if ($seller->role_id == "1") --}}
    <img src="{{app('general_setting')->shop_link_banner?showImage(app('general_setting')->shop_link_banner):showImage('frontend/default/img/breadcrumb_bg.png')}}" alt="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" title="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" class="img-fluid w-100">
    {{-- @else
    <img src="{{$seller->SellerAccount->banner?showImage($seller->SellerAccount->banner):showImage('frontend/default/img/breadcrumb_bg.png')}}" alt="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" title="@if(@$seller->role->type == 'seller') {{@$seller->SellerAccount->seller_shop_display_name}} @else {{app('general_setting')->company_name}} @endif" class="img-fluid w-100">
    @endif --}}
</div>
<div class="new_user_section section_spacing6 pt-0">
    <div class="container">
       
    </div>
</div>
@endsection