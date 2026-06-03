    <div class="modal fade art-modal" id="local_artist_modal" tabindex="-1" role="dialog" aria-labelledby="local_artist_modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div data-bs-dismiss="modal" class="close_modal d-flex justify-content-end">
                    <i class="ti-close"></i>
                </div>

                @include('frontend.amazy.partials._artists_filter_section', [
                    'idPrefix' => 'modal-',
                    'showArtistGrid' => false,
                ])
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @include('frontend.amazy.partials._artists_filter_script', [
        'idPrefix' => 'modal-',
        'scopeId' => 'local_artist_modal',
    ])
@endpush
