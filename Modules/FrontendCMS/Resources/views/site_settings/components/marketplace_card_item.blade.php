<div class="white_box_30px box_shadow_white mb-20 p-20 marketplace-card-item" data-index="{{ $index }}">
    <h5 class="mb-20">{{ __('frontendCms.marketplace_card') }} #{{ $index + 1 }}</h5>
    <div class="row">
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.title') }} <span class="text-danger">*</span></label>
                <input name="marketplace[cards][{{ $index }}][title]" class="primary_input_field" type="text"
                    value="{{ old("marketplace.cards.$index.title", $card['title'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="marketplace.cards.{{ $index }}.title"></span>
        </div>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.description') }} <span class="text-danger">*</span></label>
                <input name="marketplace[cards][{{ $index }}][description]" class="primary_input_field" type="text"
                    value="{{ old("marketplace.cards.$index.description", $card['description'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="marketplace.cards.{{ $index }}.description"></span>
        </div>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.button_text') }} <span class="text-danger">*</span></label>
                <input name="marketplace[cards][{{ $index }}][button_text]" class="primary_input_field" type="text"
                    value="{{ old("marketplace.cards.$index.button_text", $card['button_text'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="marketplace.cards.{{ $index }}.button_text"></span>
        </div>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.button_url') }} <span class="text-danger">*</span></label>
                <input name="marketplace[cards][{{ $index }}][button_url]" class="primary_input_field" type="text"
                    value="{{ old("marketplace.cards.$index.button_url", $card['button_url'] ?? '') }}">
            </div>
            <span class="text-danger home-error" data-field="marketplace.cards.{{ $index }}.button_url"></span>
        </div>
        <div class="col-xl-12">
            <input type="hidden" name="marketplace[cards][{{ $index }}][existing_image]" value="{{ $card['image'] ?? '' }}">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('frontendCms.card_image') }}</label>
                <div class="primary_file_uploader">
                    <input class="primary-input home-image-label" type="text"
                        placeholder="{{ __('common.browse_image_file') }}" readonly>
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg mb-0">
                            <span class="ripple rippleEffect browse_file_label"></span>{{ __('common.browse') }}
                            <input name="marketplace[cards][{{ $index }}][image]" type="file" class="d-none home-image-input" accept="image/*" data-preview=".marketplace-preview-{{ $index }}">
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger home-error" data-field="marketplace.cards.{{ $index }}.image"></span>
        </div>
        <div class="col-xl-12">
            <img src="{{ showImage($card['image'] ?? null) }}" alt="card" class="img-fluid mb-10 marketplace-preview-{{ $index }}" style="max-height: 120px;">
        </div>
    </div>
</div>
