@extends('frontend.amazy.layouts.app')
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
                        <h4 class="font_24 f_w_700 m-0">{{ __('Suggest Artwork') }}</h4>
                        <a href="{{ route('frontend.suggest-colors.create') }}" class="amaz_primary_btn style2 text-nowrap">{{ __('common.add_new') }}</a>
                    </div>
                    <div class="dashboard_white_box_body">
                        @if ($suggestColors->isEmpty())
                            <p class="font_14 f_w_400 mute_text mb-0">{{ __('common.no_data_available_in_table') }}</p>
                        @else
                            <div class="table-responsive">
                                <table class="table amazy_table3 style2 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="font_14 f_w_600">{{ __('common.preview') }}</th>
                                            <th class="font_14 f_w_600">{{ __('appearance.color') }}</th>
                                            <th class="font_14 f_w_600">{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suggestColors as $row)
                                            <tr>
                                                <td>
                                                    <span class="d-inline-block rounded border" style="width:40px;height:40px;background:{{ $row->colors }};" title="{{ $row->colors }}"></span>
                                                </td>
                                                <td class="font_14 f_w_500">{{ $row->colors }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap_10 flex-wrap">
                                                        <a href="{{ route('frontend.suggest-colors.edit', $row) }}" class="font_14 theme_hover">{{ __('common.edit') }}</a>
                                                        <form action="{{ route('frontend.suggest-colors.destroy', $row) }}" method="post" class="d-inline" onsubmit="return confirm(@json(__('common.are_you_sure_to_delete_?')))">
                                                            @csrf
                                                            <button type="submit" class="btn btn-link p-0 font_14 text-danger">{{ __('common.delete') }}</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
