@php
    $locationPrefix = $locationPrefix ?? '';
    $usCountryId = $usCountryId ?? 231;
@endphp
<input type="hidden" name="country" id="{{ $locationPrefix }}filter-country" value="{{ $usCountryId }}">

<div class="col-12 col-md-6 col-lg-3 d-flex flex-column filter-art-location-field">
    <label class="minimal-label" for="{{ $locationPrefix }}filter-state">Region Name</label>
    <div class="position-relative w-100">
        <select class="compact-select primary-font filter-art-state-select" name="state" id="{{ $locationPrefix }}filter-state" data-selected="{{ request('state') }}" autocomplete="off">
            <option value="">{{ __('Choose State') }}</option>
        </select>
        <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
    </div>
</div>

<div class="col-12 col-md-6 col-lg-3 d-flex flex-column filter-art-location-field">
    <label class="minimal-label" for="{{ $locationPrefix }}filter-city">{{ __('City') }}</label>
    <div class="position-relative w-100">
        <select class="compact-select primary-font filter-art-city-select" name="city" id="{{ $locationPrefix }}filter-city" data-selected="{{ request('city') }}" autocomplete="off">
            <option value="">{{ __('Choose City') }}</option>
        </select>
        <i class="fa-solid fa-chevron-down position-absolute end-0 top-50 translate-middle-y fs-11 text-gray-400 me-3 pe-none"></i>
    </div>
</div>
