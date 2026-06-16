<script>
(function ($) {
    'use strict';

    function resetSelect($select, placeholder) {
        if (!$select.length) {
            return;
        }
        $select.empty().append($('<option>', { value: '', text: placeholder }));
    }

    function appendStateOptions($state, states, selectedState) {
        $.each(states || [], function (index, stateObj) {
            var isSelected = String(selectedState) === String(stateObj.name) || String(selectedState) === String(stateObj.id);
            $state.append(
                $('<option>', {
                    value: stateObj.name,
                    text: stateObj.name,
                    'data-state-id': stateObj.id,
                    selected: isSelected
                })
            );
        });
    }

    function appendCityOptions($city, cities, selectedCity) {
        $.each(cities || [], function (index, cityObj) {
            $city.append(
                $('<option>', {
                    value: cityObj.name,
                    text: cityObj.name,
                    selected: String(selectedCity) === String(cityObj.name) || String(selectedCity) === String(cityObj.id)
                })
            );
        });
    }

    function resolveStateId($state, states, selectedState) {
        if ($state.find('option:selected').data('state-id')) {
            return $state.find('option:selected').data('state-id');
        }

        var stateId = null;
        $.each(states || [], function (index, stateObj) {
            if (String(selectedState) === String(stateObj.name) || String(selectedState) === String(stateObj.id)) {
                stateId = stateObj.id;
                return false;
            }
        });

        return stateId;
    }

    function loadStates($form) {
        var $country = $form.find('[id$="filter-country"]');
        var $state = $form.find('.filter-art-state-select');
        var $city = $form.find('.filter-art-city-select');
        var countryId = $country.val();
        var selectedState = $state.data('selected') || '';
        var selectedCity = $city.data('selected') || '';
        var baseUrl = $('#url').val() || '';

        if (!countryId) {
            return;
        }

        resetSelect($state, @json(__('Choose State')));
        resetSelect($city, @json(__('Choose City')));

        $.get(baseUrl + '/seller/profile/get-state?country_id=' + countryId, function (data) {
            appendStateOptions($state, data, selectedState);

            if (selectedState) {
                var stateId = resolveStateId($state, data, selectedState);
                if (stateId) {
                    loadCities($form, stateId, selectedCity);
                }
            }
        });
    }

    function loadCities($form, stateId, selectedCity) {
        var $city = $form.find('.filter-art-city-select');
        var baseUrl = $('#url').val() || '';

        resetSelect($city, @json(__('Choose City')));

        if (!stateId) {
            return;
        }

        $.get(baseUrl + '/seller/profile/get-city?state_id=' + stateId, function (data) {
            appendCityOptions($city, data, selectedCity);
        });
    }

    $(document).ready(function () {
        $('form').has('[id$="filter-country"]').each(function () {
            loadStates($(this));
        });
    });

    $(document).on('change', '.filter-art-state-select', function () {
        var $form = $(this).closest('form');
        var stateId = $(this).find('option:selected').data('state-id');

        loadCities($form, stateId || '', '');
    });
})(jQuery);
</script>
