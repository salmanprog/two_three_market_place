@php
    /** @var \Modules\Product\Entities\Product|null $productForAddress */
    $addr = $productForAddress ?? null;
@endphp
<div class="col-lg-12">
    <div class="primary_input mb-25 seller-product-address-wrap position-relative">
        <label class="primary_input_label" for="seller_product_address_autocomplete">{{ __('common.address') }}</label>
        <input type="text" name="location" id="seller_product_address_autocomplete" class="primary_input_field"
            value="{{ old('location', $addr->location ?? '') }}" placeholder="{{ __('common.address') }}" autocomplete="off">
        <ul id="seller_product_address_suggestions" class="seller-address-suggestions d-none" role="listbox" aria-label="{{ __('common.address') }}"></ul>
    </div>
</div>
<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label" for="seller_product_city">{{ __('common.city') }}</label>
        <input type="text" name="city" id="seller_product_city" class="primary_input_field"
            value="{{ old('city', $addr->city ?? '') }}">
    </div>
</div>
<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label" for="seller_product_state">{{ __('common.state') }}</label>
        <input type="text" name="state" id="seller_product_state" class="primary_input_field"
            value="{{ old('state', $addr->state ?? '') }}">
    </div>
</div>
<div class="col-lg-3">
    <div class="primary_input mb-25">
        <label class="primary_input_label" for="seller_product_zip_code">{{ __('common.zip_code') }}</label>
        <input type="text" name="zip_code" id="seller_product_zip_code" class="primary_input_field"
            value="{{ old('zip_code', $addr->zip_code ?? '') }}">
    </div>
</div>
<input type="hidden" name="latitude" id="seller_product_latitude" value="{{ old('latitude', $addr->latitude ?? '') }}">
<input type="hidden" name="longitude" id="seller_product_longitude" value="{{ old('longitude', $addr->longitude ?? '') }}">
