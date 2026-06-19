@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{ asset(asset_path('modules/frontendcms/css/style.css')) }}" />
<style>
    .contact-profile-avatar-wrap {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        background: #f5f5f5;
    }
    .contact-profile-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        border-radius: 50%;
    }
</style>
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    @include('frontendcms::site_settings.components._nav')
                </div>
                <div class="col-lg-9">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30">{{ __('frontendCms.contact_us_settings') }}</h3>
                        </div>
                    </div>
                    <div class="white_box_50px box_shadow_white">
                        @include('frontendcms::site_settings.components.form')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('frontendcms::site_settings.components.scripts')
