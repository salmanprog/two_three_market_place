<form id="siteHomeForm" action="{{ route('admin.site-settings.home.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="main-title mb-20">
        <h4 class="mb-0">{{ __('frontendCms.marketplace_section') }}</h4>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.section_title') }} <span class="text-danger">*</span></label>
                <input name="marketplace[heading]" class="primary_input_field" type="text"
                    value="{{ old('marketplace.heading', $homeSettings['marketplace']['heading'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="marketplace.heading"></span>
        </div>
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.intro_text') }} <span class="text-danger">*</span></label>
                <textarea name="marketplace[intro]" class="primary_input_field" rows="3">{{ old('marketplace.intro', $homeSettings['marketplace']['intro'] ?? '') }}</textarea>
            </div>
            <span class="text-danger home-error" data-field="marketplace.intro"></span>
        </div>
    </div>

    @foreach(old('marketplace.cards', $homeSettings['marketplace']['cards'] ?? []) as $index => $card)
        @include('frontendcms::site_settings.components.marketplace_card_item', ['index' => $index, 'card' => $card])
    @endforeach

    <div class="main-title mb-20 mt-30">
        <h4 class="mb-0">{{ __('frontendCms.location_artists_section') }}</h4>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.section_title') }} <span class="text-danger">*</span></label>
                <input name="location_artists[heading]" class="primary_input_field" type="text"
                    value="{{ old('location_artists.heading', $homeSettings['location_artists']['heading'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="location_artists.heading"></span>
        </div>
    </div>

    @foreach(old('location_artists.items', $homeSettings['location_artists']['items'] ?? []) as $index => $item)
        @include('frontendcms::site_settings.components.location_item', ['index' => $index, 'item' => $item])
    @endforeach

    <div class="row">
        <div class="col-lg-12 text-center mt-20">
            <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="siteHomeSubmit">
                <i class="ti-check"></i> {{ __('common.update') }}
            </button>
        </div>
    </div>
</form>
