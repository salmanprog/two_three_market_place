@php
    $idPrefix = $idPrefix ?? '';
    $scopeId = $scopeId ?? null;
@endphp
<script>
(function () {
    var root = @json($scopeId) ? document.getElementById(@json($scopeId)) : document;
    if (!root) return;

    var grid = root.querySelector('#{{ $idPrefix }}artists-filter-grid');
    var emptyMsg = root.querySelector('#{{ $idPrefix }}artists-filter-empty');
    var filterFields = root.querySelectorAll('[data-artists-filter]');
    var searchBtn = root.querySelector('#{{ $idPrefix }}artists-filter-search');
    var nameInput = root.querySelector('#{{ $idPrefix }}artists-filter-name');
    var countrySelect = root.querySelector('#{{ $idPrefix }}artists-filter-location');
    var stateSelect = root.querySelector('#{{ $idPrefix }}artists-filter-state');
    var citySelect = root.querySelector('#{{ $idPrefix }}artists-filter-city');
    var baseUrl = @json(url('/'));

    function getVal(key) {
        var el = root.querySelector('[data-artists-filter="' + key + '"]');
        return el ? (el.value || '') : '';
    }

    function applyFilter() {
        if (!grid) return;
        var name = (getVal('name') || '').toLowerCase().trim();
        var loc = getVal('location');
        var st = getVal('state');
        var ct = getVal('city');
        var cards = grid.querySelectorAll('article.artists-list-card');
        var visible = 0;

        cards.forEach(function (card) {
            var n = (card.getAttribute('data-filter-name') || '').toLowerCase();
            var l = card.getAttribute('data-filter-location') || '';
            var s = card.getAttribute('data-filter-state') || '';
            var ci = card.getAttribute('data-filter-city') || '';
            var show =
                (!name || n.indexOf(name) !== -1) &&
                (!loc || l === loc) &&
                (!st || s === st) &&
                (!ct || ci === ct);
            var col = card.closest('.artists-filter-col');
            if (col) {
                col.style.display = show ? '' : 'none';
            } else {
                card.style.display = show ? '' : 'none';
            }
            if (show) visible++;
        });

        if (emptyMsg) {
            emptyMsg.hidden = visible > 0;
            emptyMsg.setAttribute('aria-hidden', visible > 0 ? 'true' : 'false');
        }
    }

    function bindSearchTriggers() {
        function runSearch() {
            applyFilter();
        }
        if (searchBtn) searchBtn.addEventListener('click', runSearch);
        filterFields.forEach(function (field) {
            field.addEventListener('keydown', function (ev) {
                if (ev.key === 'Enter') {
                    ev.preventDefault();
                    runSearch();
                }
            });
        });
        if (nameInput) {
            nameInput.addEventListener('input', runSearch);
        }
    }

    function resetSelectWithPlaceholder(selectEl, placeholder) {
        if (!selectEl) return;
        selectEl.innerHTML = '';
        var opt = document.createElement('option');
        opt.value = '';
        opt.textContent = placeholder;
        selectEl.appendChild(opt);
    }

    if (grid) {
        bindSearchTriggers();
        applyFilter();
    }

    if (countrySelect) {
        countrySelect.addEventListener('change', function () {
            var countryId = countrySelect.value || '';
            resetSelectWithPlaceholder(stateSelect, @json(__('Choose State')));
            resetSelectWithPlaceholder(citySelect, @json(__('Choose City')));
            if (!countryId) return;
            fetch(baseUrl + '/get-state?country_id=' + encodeURIComponent(countryId), {
                headers: { 'Accept': 'application/json' }
            })
                .then(function (r) { return r.ok ? r.json() : []; })
                .then(function (states) {
                    (states || []).forEach(function (stateObj) {
                        var opt = document.createElement('option');
                        opt.value = stateObj.id;
                        opt.textContent = stateObj.name;
                        stateSelect.appendChild(opt);
                    });
                })
                .catch(function () {});
        });
    }

    if (stateSelect) {
        stateSelect.addEventListener('change', function () {
            var stateId = stateSelect.value || '';
            resetSelectWithPlaceholder(citySelect, @json(__('Choose City')));
            if (!stateId) return;
            fetch(baseUrl + '/get-city?state_id=' + encodeURIComponent(stateId), {
                headers: { 'Accept': 'application/json' }
            })
                .then(function (r) { return r.ok ? r.json() : []; })
                .then(function (cities) {
                    (cities || []).forEach(function (cityObj) {
                        var opt = document.createElement('option');
                        opt.value = cityObj.id;
                        opt.textContent = cityObj.name;
                        citySelect.appendChild(opt);
                    });
                })
                .catch(function () {});
        });
    }
})();
</script>
