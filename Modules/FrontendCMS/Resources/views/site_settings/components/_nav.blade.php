<div class="white_box_50px box_shadow_white mb-20">
    <div class="main-title mb-20">
        <h3 class="mb-0">{{ __('frontendCms.site_settings') }}</h3>
    </div>
    <ul class="list-unstyled mb-0">
        <li class="mb-10">
            <a href="{{ route('admin.site-settings.contact') }}"
               class="d-block primary-btn tr-bg text-center {{ request()->routeIs('admin.site-settings.contact') ? 'fix-gr-bg text-white' : '' }}">
                {{ __('frontendCms.contact_us_settings') }}
            </a>
        </li>
    </ul>
</div>
