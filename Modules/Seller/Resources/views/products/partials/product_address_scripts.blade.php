@php
    $sellerMapsEnabled = $sellerMapsEnabled ?? false;
@endphp
<script>
(function ($) {
    'use strict';
    var sellerMapsEnabled = @json($sellerMapsEnabled);

    function sellerApplyGooglePlace(place) {
        var city = '', state = '', zip = '';
        if (place.address_components) {
            place.address_components.forEach(function (c) {
                var t = c.types[0];
                if (t === 'locality') { city = c.long_name; }
                if (t === 'administrative_area_level_1') { state = c.short_name || c.long_name; }
                if (t === 'postal_code') { zip = c.long_name; }
            });
        }
        $('#seller_product_address_autocomplete').val(place.formatted_address || place.name || '');
        $('#seller_product_city').val(city);
        $('#seller_product_state').val(state);
        $('#seller_product_zip_code').val(zip);
        if (place.geometry && place.geometry.location) {
            $('#seller_product_latitude').val(place.geometry.location.lat());
            $('#seller_product_longitude').val(place.geometry.location.lng());
        }
    }

    function sellerPhotonLabel(f) {
        var p = f.properties || {};
        var parts = [p.housenumber, p.street, p.city, p.state, p.postcode, p.country].filter(Boolean);
        return parts.length ? parts.join(', ') : (p.name || '');
    }

    function sellerHidePhotonSuggestions() {
        $('#seller_product_address_suggestions').addClass('d-none').empty();
    }

    window.initSellerProductAddressAutocomplete = function () {
        if (!sellerMapsEnabled) { return; }
        var input = document.getElementById('seller_product_address_autocomplete');
        if (!input || !window.google || !google.maps || !google.maps.places) { return; }
        var opts = {
            fields: ['formatted_address', 'geometry', 'name', 'address_components'],
            types: ['address'],
        };
        @if(config('app.map_api_country_1') != '')
        opts.componentRestrictions = { country: [
            @if(config('app.map_api_country_1') != '') "{{ config('app.map_api_country_1') }}" @endif
            @if(config('app.map_api_country_2') != '') ,"{{ config('app.map_api_country_2') }}" @endif
            @if(config('app.map_api_country_3') != '') ,"{{ config('app.map_api_country_3') }}" @endif
            @if(config('app.map_api_country_4') != '') ,"{{ config('app.map_api_country_4') }}" @endif
            @if(config('app.map_api_country_5') != '') ,"{{ config('app.map_api_country_5') }}" @endif
        ]};
        @endif
        var ac = new google.maps.places.Autocomplete(input, opts);
        ac.addListener('place_changed', function () {
            sellerApplyGooglePlace(ac.getPlace());
        });
    };

    $(document).ready(function () {
        if ($('#seller_product_address_autocomplete').length === 0) { return; }

        if (sellerMapsEnabled && window.google && window.google.maps && window.google.maps.places) {
            window.initSellerProductAddressAutocomplete();
        }

        if (!sellerMapsEnabled) {
            var photonTimer;
            $(document).on('input', '#seller_product_address_autocomplete', function () {
                clearTimeout(photonTimer);
                var q = $.trim($(this).val());
                if (q.length < 3) {
                    sellerHidePhotonSuggestions();
                    return;
                }
                photonTimer = setTimeout(function () {
                    $.getJSON('https://photon.komoot.io/api/', { q: q, limit: 8 })
                        .done(function (data) {
                            var $ul = $('#seller_product_address_suggestions');
                            $ul.empty();
                            var feats = data.features || [];
                            if (!feats.length) {
                                sellerHidePhotonSuggestions();
                                return;
                            }
                            feats.forEach(function (f) {
                                var coords = f.geometry && f.geometry.coordinates;
                                if (!coords || coords.length < 2) { return; }
                                var label = sellerPhotonLabel(f);
                                if (!label) { return; }
                                var p = f.properties || {};
                                $('<li role="option" tabindex="-1"></li>')
                                    .text(label)
                                    .attr('data-lon', coords[0])
                                    .attr('data-lat', coords[1])
                                    .attr('data-label', label)
                                    .attr('data-city', p.city || '')
                                    .attr('data-state', p.state || '')
                                    .attr('data-zip', p.postcode || '')
                                    .appendTo($ul);
                            });
                            if ($ul.children().length) { $ul.removeClass('d-none'); }
                            else { sellerHidePhotonSuggestions(); }
                        })
                        .fail(sellerHidePhotonSuggestions);
                }, 350);
            });
            $(document).on('mousedown', '#seller_product_address_suggestions li', function (e) {
                e.preventDefault();
                var $li = $(this);
                $('#seller_product_address_autocomplete').val($li.data('label'));
                $('#seller_product_city').val($li.data('city') || '');
                $('#seller_product_state').val($li.data('state') || '');
                $('#seller_product_zip_code').val($li.data('zip') || '');
                $('#seller_product_latitude').val($li.data('lat'));
                $('#seller_product_longitude').val($li.data('lon'));
                sellerHidePhotonSuggestions();
            });
            $(document).on('blur', '#seller_product_address_autocomplete', function () {
                setTimeout(sellerHidePhotonSuggestions, 200);
            });
        }
    });
})(jQuery);
</script>
