@push('scripts')
<script>
    (function($){
        "use strict";

        var pricingBaseUrl = "{{ url('/pricing') }}";

        function pricingUrl(path) {
            return pricingBaseUrl + (path || '');
        }

        function pricingFeatureRowHtml(index, title, icon) {
            title = title || '';
            icon = icon || 'fas fa-check';
            return `
                <div class="pricing-feature-row row align-items-end mb-15" data-index="${index}">
                    <div class="col-lg-7">
                        <div class="primary_input mb-0">
                            <label class="primary_input_label">{{ __('frontendCms.feature_title') }}</label>
                            <input class="primary_input_field" type="text" name="features[${index}][title]" value="${title.replace(/"/g, '&quot;')}" placeholder="{{ __('frontendCms.feature_title') }}">
                            <input type="hidden" name="features[${index}][sort_order]" value="${index}">
                            <input type="hidden" name="features[${index}][status]" value="1">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="primary_input mb-0">
                            <label class="primary_input_label">{{ __('frontendCms.feature_icon') }}</label>
                            <input class="primary_input_field" type="text" name="features[${index}][icon]" value="${icon.replace(/"/g, '&quot;')}" placeholder="fas fa-check">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="primary-btn small fix-gr-bg remove_pricing_feature_row w-100" title="{{ __('frontendCms.remove_feature') }}">
                            <span class="ti-trash"></span>
                        </button>
                    </div>
                </div>
            `;
        }

        function reindexPricingFeatureRows() {
            $('#pricing_features_wrapper .pricing-feature-row').each(function(rowIndex) {
                $(this).attr('data-index', rowIndex);
                $(this).find('input[name*="[title]"]').attr('name', `features[${rowIndex}][title]`);
                $(this).find('input[name*="[icon]"]').attr('name', `features[${rowIndex}][icon]`);
                $(this).find('input[name*="[sort_order]"]').attr('name', `features[${rowIndex}][sort_order]`).val(rowIndex);
                $(this).find('input[name*="[status]"]').attr('name', `features[${rowIndex}][status]`);
            });
        }

        function addPricingFeatureRow(title, icon) {
            var index = $('#pricing_features_wrapper .pricing-feature-row').length;
            $('#pricing_features_wrapper').append(pricingFeatureRowHtml(index, title, icon));
        }

        function renderPricingFeatures(features) {
            $('#pricing_features_wrapper').empty();
            if (!features || !features.length) {
                return;
            }
            features.forEach(function(feature, index) {
                addPricingFeatureRow(feature.title || '', feature.icon || 'fas fa-check');
            });
            reindexPricingFeatureRows();
        }

        function fillPricingEditForm(item) {
            if (!item) {
                return;
            }

            $('#item_id').val(item.id);
            @if(isModuleActive('FrontendMultiLang'))
            if (item.name != null) {
                $.each(item.name, function(key, value) {
                    $('#name_' + key).val(value);
                });
            } else {
                $('#name_{{auth()->user()->lang_code}}').val(item.translateName);
            }
            @else
            $('#name').val(item.name).addClass('has-content');
            @endif

            $('#team_size').val(item.team_size).addClass('has-content');
            $('#plan_price').val(item.plan_price).addClass('has-content');
            $('#expire_in').val(item.expire_in).addClass('has-content');
            $('#stock_limit').val(item.stock_limit).addClass('has-content');
            $('#category_limit').val(item.category_limit).addClass('has-content');
            $('#transaction_fee').val(item.transaction_fee).addClass('has-content');
            $('#best_for').val(item.best_for).addClass('has-content');
            $('#old_image').val(item.image).addClass('has-content');
            $('#discount').val(item.discount).addClass('has-content');

            if (item.discount_type == 1) {
                $('#discount_type_percentage').prop('checked', true);
            } else {
                $('#discount_type_amount').prop('checked', true);
            }

            if (item.status == 1) {
                $('#pricing_edit_form #status_active').prop('checked', true);
                $('#pricing_edit_form #status_inactive').prop('checked', false);
            } else {
                $('#pricing_edit_form #status_active').prop('checked', false);
                $('#pricing_edit_form #status_inactive').prop('checked', true);
            }

            if (item.is_featured == 1) {
                $('#pricing_edit_form #is_featured').prop('checked', true);
            } else {
                $('#pricing_edit_form #is_featured').prop('checked', false);
            }

            $('#gst_id').val(item.gst_tax_id).change();
        }

        $(document).ready(function() {
            if ($('#pricing_features_wrapper').length && $('#pricing_features_wrapper').children().length === 0) {
                renderPricingFeatures([]);
            }

            $(document).on('click', '#add_pricing_feature_row', function() {
                addPricingFeatureRow('', 'fas fa-check');
                reindexPricingFeatureRows();
            });

            $(document).on('click', '.remove_pricing_feature_row', function() {
                $(this).closest('.pricing-feature-row').remove();
                reindexPricingFeatureRows();
            });

            $(document).on('submit', '#item_delete_form', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', $('#delete_item_id').val());
                let id = $('#delete_item_id').val();
                $('#deleteItemModal').modal('hide');
                $.ajax({
                    url: pricingUrl('/delete'),
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        resetAfterChange(response.TableData);
                        toastr.success("{{__('common.deleted_successfully')}}","{{__('common.success')}}");
                        $('#pre-loader').addClass('d-none');
                        $.ajax({
                            url: pricingUrl('/create'),
                            type: "GET",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $('#formHtml').empty();
                                $('#formHtml').html(response.editHtml);
                                renderPricingFeatures([]);
                                $('#monthly_cost').addClass(
                                    'has-content');
                                $('#yearly_cost').addClass(
                                    'has-content');
                                $('#team_size').addClass(
                                    'has-content');
                                $('#stock_limit').addClass(
                                    'has-content');
                                $('#commission').addClass(
                                    'has-content');
                                $('#transaction_fee')
                                    .addClass('has-content');
                                $('#pre-loader').addClass('d-none');
                            },
                            error: function(response) {
                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                                toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                            }
                        });
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                        }
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });


            $("#add_pricing_form").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $("#create_btn").prop('disabled', true);
                $('#create_btn').text('{{ __("common.submitting") }}');
                $('#pre-loader').removeClass('d-none');
                removeValidationError();

                $.ajax({
                    url: pricingUrl(''),
                    type: 'POST',
                    data: formData,
                    success: function () {
                        toastr.success("{{__('common.added_successfully')}}","{{__('common.success')}}");
                        location.reload();
                    },
                    error: function(response) {
                        $("#create_btn").prop('disabled', false);
                        $('#create_btn').text('{{ __("common.save") }}');
                        $('#pre-loader').addClass('d-none');
                        if (response.responseJSON && response.responseJSON.errors) {
                            showValidationErrors('#add_pricing_form', response.responseJSON.errors);
                        } else {
                            toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $(document).on('submit','#pricing_edit_form', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $("#edit_btn").prop('disabled', true);
                $('#edit_btn').text('{{ __("common.submitting") }}');
                $('#pre-loader').removeClass('d-none');
                removeValidationError();

                $.ajax({
                    url: pricingUrl('/update'),
                    type: 'POST',
                    data: formData,
                    success: function () {
                        toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                        location.reload();
                    },
                    error: function(response) {
                        $("#edit_btn").prop('disabled', false);
                        $('#edit_btn').text('{{ __("common.update") }}');
                        $('#pre-loader').addClass('d-none');
                        if (response.responseJSON && response.responseJSON.errors) {
                            showValidationErrors('#pricing_edit_form', response.responseJSON.errors);
                        } else {
                            toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });


            $(document).on('change', '.statusChange', function(event){
                let id = $(this).val();
                let status = $(this).data('status');
                $('#pre-loader').removeClass('d-none');
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', id);
                formData.append('status', status);
                $.ajax({
                    url: pricingUrl('/status-update'),
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        resetAfterChange(response.TableData);
                        toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                        }
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });

            $(document).on('click', '.show_pricing', function(event){
                event.preventDefault();
                let $item = $(this);
                $('#item_show').modal('show');
                $('#show_name').text($item.data('name') || '');
                $('#show_monthly_cost').text(numbertrans($item.data('monthly_cost') || 0));
                $('#show_yearly_cost').text(numbertrans($item.data('yearly_cost') || 0));
                $('#show_team_size').text(numbertrans($item.data('team_size') || 0));
                $('#show_stock_limit').text(numbertrans($item.data('stock_limit') || 0));
                $("#show_category_limit").text(numbertrans($item.data('category_limit') || 0));
                $('#show_transaction_fee').text(numbertrans($item.data('transaction_fee') || 0));
            });

            $(document).on('click', '.delete_pricing', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('#delete_item_id').val(id);
                $('#deleteItemModal').modal('show');
            });



            $(document).on('click', '.edit_pricing', function(event){
                event.preventDefault();
                let pricingId = $(this).attr('data-id');
                if (!pricingId) {
                    toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                    return;
                }
                $('#pre-loader').removeClass('d-none');
                $.ajax({
                    url: pricingUrl('/' + pricingId + '/edit'),
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        $('#formHtml').empty();
                        $('#formHtml').append(response.editHtml);
                        fillPricingEditForm(response.data);
                        renderPricingFeatures(response.data.features || []);
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        $('#pre-loader').addClass('d-none');
                        if (response.responseJSON && response.responseJSON.message) {
                            toastr.error(response.responseJSON.message, "{{__('common.error')}}");
                        } else {
                            toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        }
                    }
                });
            });
            function showValidationErrors(formType, errors) {
                @if(isModuleActive('FrontendMultiLang'))
                    $(formType + ' #error_name_{{auth()->user()->lang_code}}').text(errors['name.{{auth()->user()->lang_code}}']);
                @else
                    $(formType + ' #error_name').text(errors.name);
                @endif
                $(formType + ' #error_monthly_cost').text(errors.monthly_cost);
                $(formType + ' #error_yearly_cost').text(errors.yearly_cost);
                $(formType + ' #error_team_size').text(errors.team_size);
                $(formType + ' #error_stock_limit').text(errors.stock_limit);
                $(formType + ' #error_commission').text(errors.commission);
                $(formType + ' #error_transaction_fee').text(errors.transaction_fee);
                $(formType + ' #error_buyer_fee').text(errors.buyer_fee);
                $(formType + ' #status_error').text(errors.status);
            }
            function resetAfterChange(tableData) {
                $('#item_table').empty();
                $('#item_table').html(tableData);
                CRMTableThreeReactive();
            }
            function resetForm() {
                $('#add_pricing_form')[0].reset();
            }
            function removeValidationError(){
                @if(isModuleActive('FrontendMultiLang'))
                $('#error_name_{{auth()->user()->lang_code}}').text('');
                @else
                $('#error_name').text('');
                @endif
                $('#error_monthly_cost').text('');
                $('#error_yearly_cost').text('');
                $('#error_team_size').text('');
                $('#error_stock_limit').text('');
                $('#error_commission').text('');
                $('#error_transaction_fee').text('');
                $('#error_buyer_fee').text('');
                $('#status_error').text('');
            }
        });
    })(jQuery);
</script>
@endpush
