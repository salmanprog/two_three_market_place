@extends('frontend.amazy.layouts.app')

@section('title')
{{ __('common.merchants') }}
@endsection

@section('content')
<div class="artists-list-page amazy_section_padding">
    <div class="container">
        @include('frontend.amazy.partials._artists_filter_section', ['idPrefix' => ''])

        @if ($sellers->isNotEmpty())
        <div class="row">
            <div class="col-12">
                <div class="pagination_part pt-2">
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
    @include('frontend.amazy.partials._artists_filter_script', [
        'idPrefix' => '',
        'scopeId' => null,
    ])
@endpush
