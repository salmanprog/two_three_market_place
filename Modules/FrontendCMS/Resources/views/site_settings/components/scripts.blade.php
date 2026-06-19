@push('scripts')
<script>
    (function($) {
        "use strict";

        function refreshProfileNumbers() {
            $('#contactProfilesWrapper .contact-profile-item').each(function(index) {
                $(this).attr('data-index', index);
                $(this).find('.profile-number').text(index + 1);
                $(this).find('[name^="profiles["]').each(function() {
                    var name = $(this).attr('name');
                    if (!name) {
                        return;
                    }
                    $(this).attr('name', name.replace(/profiles\[[^\]]+\]/, 'profiles[' + index + ']'));
                });
            });
        }

        function toggleRemoveButtons() {
            var count = $('#contactProfilesWrapper .contact-profile-item').length;
            $('.remove-contact-profile').toggle(count > 1);
        }

        function updateProfilePreviews(profiles) {
            if (!profiles || !profiles.length) {
                return;
            }

            $('#contactProfilesWrapper .contact-profile-item').each(function(index) {
                var profile = profiles[index];
                if (!profile) {
                    return;
                }

                var $item = $(this);
                $item.find('input[name$="[existing_image]"]').val(profile.image || '');
                $item.find('.profile-preview').attr('src', profile.image_url || profile.image || '');
            });
        }

        $(document).ready(function() {
            toggleRemoveButtons();

            $('#addContactProfile').on('click', function() {
                var index = $('#contactProfilesWrapper .contact-profile-item').length;
                var template = $('#contactProfileTemplate').html().replace(/__INDEX__/g, index);
                $('#contactProfilesWrapper').append(template);
                refreshProfileNumbers();
                toggleRemoveButtons();
            });

            $(document).on('click', '.remove-contact-profile', function() {
                if ($('#contactProfilesWrapper .contact-profile-item').length <= 1) {
                    toastr.warning("{{ __('frontendCms.at_least_one_contact_profile') }}", "{{ __('common.warning') }}");
                    return;
                }
                $(this).closest('.contact-profile-item').remove();
                refreshProfileNumbers();
                toggleRemoveButtons();
            });

            $(document).on('change', '.profile-image-input', function() {
                var file = this.files && this.files[0];
                var $item = $(this).closest('.contact-profile-item');
                var fileName = file ? file.name : '';
                $(this).closest('.primary_file_uploader').find('.profile-image-label').val(fileName);

                if (!file) {
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(event) {
                    $item.find('.profile-preview').attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            });

            $('#siteContactForm').on('submit', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $('.profile-error').text('');
                $('#error_title').text('');

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
                        if (response.profiles) {
                            updateProfilePreviews(response.profiles);
                            $('#contactProfilesWrapper .profile-image-input').val('');
                            $('#contactProfilesWrapper .profile-image-label').val('');
                        }
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.message) {
                            toastr.error(response.responseJSON.message, "{{ __('common.error') }}");
                        } else if (response.responseJSON && response.responseJSON.errors) {
                            var errors = response.responseJSON.errors;
                            if (errors.title) {
                                $('#error_title').text(errors.title[0]);
                            }
                            Object.keys(errors).forEach(function(key) {
                                var match = key.match(/^profiles\.(\d+)\.(\w+)$/);
                                if (!match) {
                                    return;
                                }
                                var item = $('#contactProfilesWrapper .contact-profile-item').eq(parseInt(match[1], 10));
                                item.find('.profile-error[data-field="' + match[2] + '"]').text(errors[key][0]);
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
