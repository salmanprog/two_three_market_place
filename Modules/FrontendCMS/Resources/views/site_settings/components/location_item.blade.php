<div class="white_box_30px box_shadow_white mb-20 p-20 location-item" data-index="{{ $index }}">
    <h5 class="mb-20">{{ __('frontendCms.location_step') }} #{{ $index + 1 }}</h5>
    <div class="row">
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.title') }} <span class="text-danger">*</span></label>
                <input name="location_artists[items][{{ $index }}][title]" class="primary_input_field" type="text"
                    value="{{ old("location_artists.items.$index.title", $item['title'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="location_artists.items.{{ $index }}.title"></span>
        </div>
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.description') }} <span class="text-danger">*</span></label>
                <textarea name="location_artists[items][{{ $index }}][description]" class="primary_input_field" rows="3">{{ old("location_artists.items.$index.description", $item['description'] ?? '') }}</textarea>
            </div>
            <span class="text-danger home-error" data-field="location_artists.items.{{ $index }}.description"></span>
        </div>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.button_text') }}</label>
                <input name="location_artists[items][{{ $index }}][button_text]" class="primary_input_field" type="text"
                    value="{{ old("location_artists.items.$index.button_text", $item['button_text'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="location_artists.items.{{ $index }}.button_text"></span>
        </div>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.button_url') }}</label>
                <input name="location_artists[items][{{ $index }}][button_url]" class="primary_input_field" type="text"
                    value="{{ old("location_artists.items.$index.button_url", $item['button_url'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="location_artists.items.{{ $index }}.button_url"></span>
        </div>
        <div class="col-xl-6">
            <input type="hidden" name="location_artists[items][{{ $index }}][existing_number_image]" value="{{ $item['number_image'] ?? '' }}">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.number_image') }}</label>
                <div class="primary_file_uploader">
                    <input class="primary-input home-image-label" type="text"
                        placeholder="{{ __('common.browse_image_file') }}" readonly>
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg mb-0">
                            <span class="ripple rippleEffect browse_file_label"></span>{{ __('common.browse') }}
                            <input name="location_artists[items][{{ $index }}][number_image]" type="file" class="d-none home-image-input" accept="image/*" data-preview=".location-number-preview-{{ $index }}">
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger home-error" data-field="location_artists.items.{{ $index }}.number_image"></span>
            <img src="{{ showImage($item['number_image'] ?? null) }}" alt="number" class="img-fluid mb-10 location-number-preview-{{ $index }}" style="max-height: 100px;">
        </div>
        <div class="col-xl-6">
            <input type="hidden" name="location_artists[items][{{ $index }}][existing_icon_image]" value="{{ $item['icon_image'] ?? '' }}">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.icon_image') }}</label>
                <div class="primary_file_uploader">
                    <input class="primary-input home-image-label" type="text"
                        placeholder="{{ __('common.browse_image_file') }}" readonly>
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg mb-0">
                            <span class="ripple rippleEffect browse_file_label"></span>{{ __('common.browse') }}
                            <input name="location_artists[items][{{ $index }}][icon_image]" type="file" class="d-none home-image-input" accept="image/*" data-preview=".location-icon-preview-{{ $index }}">
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger home-error" data-field="location_artists.items.{{ $index }}.icon_image"></span>
            <img src="{{ showImage($item['icon_image'] ?? null) }}" alt="icon" class="img-fluid mb-10 location-icon-preview-{{ $index }}" style="max-height: 60px;">
        </div>
    </div>
</div>
