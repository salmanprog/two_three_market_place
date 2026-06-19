<form id="siteContactForm" action="{{ route('admin.site-settings.contact.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="contact_section_title">{{ __('frontendCms.section_title') }} <span class="text-danger">*</span></label>
                <input name="title" id="contact_section_title" class="primary_input_field" type="text"
                    value="{{ old('title', $contactSettings['title'] ?? 'Connect with us') }}">
            </div>
            <span class="text-danger" id="error_title"></span>
        </div>
    </div>

    <div class="main-title mb-20 mt-10">
        <h4 class="mb-0">{{ __('frontendCms.contact_profiles') }}</h4>
    </div>

    <div id="contactProfilesWrapper">
        @foreach(old('profiles', $contactSettings['profiles'] ?? []) as $index => $profile)
            @include('frontendcms::site_settings.components.profile_item', ['index' => $index, 'profile' => $profile])
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-12 mb-20">
            <button type="button" class="primary-btn tr-bg" id="addContactProfile">
                <i class="ti-plus"></i> {{ __('frontendCms.add_contact_profile') }}
            </button>
        </div>
        <div class="col-lg-12 text-center">
            <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="siteContactSubmit">
                <i class="ti-check"></i> {{ __('common.update') }}
            </button>
        </div>
    </div>
</form>

<template id="contactProfileTemplate">
    @include('frontendcms::site_settings.components.profile_item', [
        'index' => '__INDEX__',
        'profile' => ['name' => '', 'phone' => '', 'email' => '', 'image' => ''],
    ])
</template>
