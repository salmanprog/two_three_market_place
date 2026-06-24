@push('scripts')
<script>
    (function($) {
        "use strict";

        function updateMarketplacePreviews(cards) {
            if (!cards || !cards.length) {
                return;
            }

            $('.marketplace-card-item').each(function(index) {
                var card = cards[index];
                if (!card) {
                    return;
                }

                var $item = $(this);
                $item.find('input[name$="[existing_image]"]').val(card.image || '');
                $item.find('.marketplace-preview-' + index).attr('src', card.image_url || '');
            });
        }

        function updateLocationPreviews(items) {
            if (!items || !items.length) {
                return;
            }

            $('.location-item').each(function(index) {
                var item = items[index];
                if (!item) {
                    return;
                }

                var $item = $(this);
                $item.find('input[name$="[existing_number_image]"]').val(item.number_image || '');
                $item.find('input[name$="[existing_icon_image]"]').val(item.icon_image || '');
                $item.find('.location-number-preview-' + index).attr('src', item.number_image_url || '');
                $item.find('.location-icon-preview-' + index).attr('src', item.icon_image_url || '');
            });
        }

        $(document).ready(function() {
            $(document).on('change', '.home-image-input', function() {
                var file = this.files && this.files[0];
                var previewSelector = $(this).data('preview');
                $(this).closest('.primary_file_uploader').find('.home-image-label').val(file ? file.name : '');

                if (!file || !previewSelector) {
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(event) {
                    $(previewSelector).attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            });

            $('#siteHomeForm').on('submit', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $('.home-error').text('');

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(response.message || "{{ __('common.updated_successfully') }}", "{{ __('common.success') }}");
                        if (response.marketplace && response.marketplace.cards) {
                            updateMarketplacePreviews(response.marketplace.cards);
                        }
                        if (response.location_artists && response.location_artists.items) {
                            updateLocationPreviews(response.location_artists.items);
                        }
                        $('#siteHomeForm .home-image-input').val('');
                        $('#siteHomeForm .home-image-label').val('');
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.message) {
                            toastr.error(response.responseJSON.message, "{{ __('common.error') }}");
                        } else if (response.responseJSON && response.responseJSON.errors) {
                            Object.keys(response.responseJSON.errors).forEach(function(key) {
                                $('.home-error[data-field="' + key + '"]').text(response.responseJSON.errors[key][0]);
                            });
                        } else {
                            toastr.error("{{ __('common.error_message') }}", "{{ __('common.error') }}");
                        }
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });
        });
    })(jQuery);
</script>
@endpush
