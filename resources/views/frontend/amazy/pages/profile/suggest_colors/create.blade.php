@extends('frontend.amazy.layouts.app')
@php
    $selectedHex = strtoupper(old('colors', $palette[0] ?? ''));
@endphp
@push('styles')
    <style>
        .suggest_color_palette {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            max-width: 420px;
        }
        .suggest_color_swatch {
            width: 52px;
            height: 52px;
            padding: 0;
            border: 2px solid rgba(0, 18, 78, 0.12);
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.25);
        }
        .suggest_color_swatch:hover {
            transform: scale(1.06);
        }
        .suggest_color_swatch:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 18, 78, 0.35);
        }
        .suggest_color_swatch.is-selected {
            box-shadow: 0 0 0 3px #00124e, 0 4px 12px rgba(0, 18, 78, 0.2);
            transform: scale(1.05);
        }
    </style>
@endpush
@section('content')
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25">
                    <div class="dashboard_white_box_header d-flex align-items-center justify-content-between flex-wrap gap-2 mb_20">
                        <h4 class="font_24 f_w_700 m-0">{{ __('customer_panel.my_palette') }}</h4>
                        <a href="{{ route('frontend.suggest-colors.index') }}" class="amaz_primary_btn3 style2 text-nowrap">{{ __('common.cancel') }}</a>
                    </div>
                    <div class="dashboard_white_box_body">
                        <p class="font_14 f_w_500 mb_3">{{ __('appearance.add_new_color') }}</p>
                        <form action="{{ route('frontend.suggest-colors.store') }}" method="post" id="suggest_colors_form">
                            @csrf
                            <input type="hidden" name="colors" id="suggest_colors_value" value="{{ $selectedHex }}">
                            <div class="suggest_color_picker mb_3">
                                <label for="suggest_color_picker" class="form-label font_14 f_w_500 mb_2">{{ __('appearance.color') }}</label>
                                <input type="color"
                                    class="form-control form-control-color"
                                    id="suggest_color_picker"
                                    value="{{ $selectedHex }}"
                                    title="{{ __('Choose a color') }}">
                            </div>
                            <div class="mb_3">
                                <label for="job_name" class="form-label font_14 f_w_500 mb_2">{{ __('customer_panel.job_name') }} <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="primary_input_field"
                                    id="job_name"
                                    name="job_name"
                                    list="existing_job_names"
                                    value="{{ old('job_name') }}"
                                    placeholder="{{ __('customer_panel.job_name') }}"
                                    maxlength="191"
                                    required>
                                @if(isset($existingJobNames) && $existingJobNames->isNotEmpty())
                                    <datalist id="existing_job_names">
                                        @foreach ($existingJobNames as $jobName)
                                            <option value="{{ $jobName }}"></option>
                                        @endforeach
                                    </datalist>
                                @endif
                                @error('job_name')
                                    <p class="text-danger font_14 mb-0 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <p class="font_14 f_w_500 mute_text mb_4" id="suggest_colors_preview_wrap" @if(!$selectedHex) style="display:none" @endif>
                                <span class="mute_text">{{ __('appearance.color') }}:</span>
                                <span id="suggest_colors_preview">{{ $selectedHex }}</span>
                            </p>
                            @error('colors')
                                <p class="text-danger font_14 mb-3">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="amaz_primary_btn style2">{{ __('common.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        (function () {
            var form = document.getElementById('suggest_colors_form');
            var picker = document.getElementById('suggest_color_picker');
            var hidden = document.getElementById('suggest_colors_value');
            if (!form || !picker || !hidden) return;

            function syncColor() {
                hidden.value = picker.value.toUpperCase();
                var preview = document.getElementById('suggest_colors_preview');
                var previewWrap = document.getElementById('suggest_colors_preview_wrap');
                if (preview) preview.textContent = hidden.value;
                if (previewWrap) previewWrap.style.display = '';
            }

            picker.addEventListener('input', syncColor);
            picker.addEventListener('change', syncColor);
            form.addEventListener('submit', syncColor);
        })();
    </script>
@endpush
