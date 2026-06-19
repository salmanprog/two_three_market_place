<div class="contact-profile-item white_box_30px box_shadow_white mb-20 p-20" data-index="{{ $index }}">
    <div class="d-flex justify-content-between align-items-center mb-20">
        <h5 class="mb-0">{{ __('frontendCms.contact_profile') }} #<span class="profile-number">{{ is_numeric($index) ? $index + 1 : '' }}</span></h5>
        <button type="button" class="primary-btn tr-bg small remove-contact-profile">
            <i class="ti-trash"></i> {{ __('common.delete') }}
        </button>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.name') }} <span class="text-danger">*</span></label>
                <input name="profiles[{{ $index }}][name]" class="primary_input_field" type="text"
                    value="{{ old("profiles.$index.name", $profile['name'] ?? '') }}">
            </div>
            <span class="text-danger profile-error" data-field="name"></span>
        </div>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.phone') }} <span class="text-danger">*</span></label>
                <input name="profiles[{{ $index }}][phone]" class="primary_input_field" type="text"
                    value="{{ old("profiles.$index.phone", $profile['phone'] ?? '') }}">
            </div>
            <span class="text-danger profile-error" data-field="phone"></span>
        </div>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.email') }} <span class="text-danger">*</span></label>
                <input name="profiles[{{ $index }}][email]" class="primary_input_field" type="email"
                    value="{{ old("profiles.$index.email", $profile['email'] ?? '') }}">
            </div>
            <span class="text-danger profile-error" data-field="email"></span>
        </div>
        <div class="col-xl-6">
            <input type="hidden" name="profiles[{{ $index }}][existing_image]" value="{{ $profile['image'] ?? '' }}">
            <div class="primary_input mb-25">
                <label class="primary_input_label">{{ __('common.avatar') }}</label>
                <div class="primary_file_uploader">
                    <input class="primary-input profile-image-label" type="text"
                        placeholder="{{ __('common.browse_image_file') }}" readonly>
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg mb-0">
                            <span class="ripple rippleEffect browse_file_label"></span>{{ __('common.browse') }}
                            <input name="profiles[{{ $index }}][image]" type="file" class="d-none profile-image-input" accept="image/*">
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger profile-error" data-field="image"></span>
        </div>
        <div class="col-xl-12">
            <div class="contact-profile-avatar-wrap mb-10">
                <img src="{{ showImage($profile['image'] ?? null) }}" alt="profile" class="contact-profile-avatar profile-preview">
            </div>
        </div>
    </div>
</div>
