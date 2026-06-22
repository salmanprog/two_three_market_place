@once
<div class="modal fade art-modal" id="filterArtsAgeModal" tabindex="-1" role="dialog" aria-labelledby="filterArtsAgeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 480px;">
        <div class="modal-content border-0" style="border-radius: 0;">
            <div class="modal-body p-40 text-center">
                <div class="mb-20">
                    <i class="fa-solid fa-user-shield fs-40 text-black" aria-hidden="true"></i>
                </div>
                <h4 class="secondry-font fw-400 mb-15" id="filterArtsAgeModalLabel">Age Verification Required</h4>
                <p class="primary-font fs-16 text-black mb-30 mb-0" style="line-height: 1.6;">
                    This category may contain mature content intended for adults only.<br>
                    Are you 18 years of age or older?
                </p>
                <div class="d-flex justify-content-center gap-15 mt-30 flex-wrap">
                    <button type="button" class="btn btn-compact-black primary-font px-40" id="filterArtsAgeYes">
                        Yes, I am 18+
                    </button>
                    <button type="button" class="btn btn-outline-dark primary-font px-40" id="filterArtsAgeNo" style="border-radius: 50px; padding-top: 10px; padding-bottom: 10px;">
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endonce

@push('scripts')
@once
<script>
(function($) {
    'use strict';

    var $ageModal = $('#filterArtsAgeModal');
    var activeSubjectSelect = null;

    function showAgeModal($select) {
        activeSubjectSelect = $select;
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            bootstrap.Modal.getOrCreateInstance($ageModal[0]).show();
        } else {
            $ageModal.modal('show');
        }
    }

    function hideAgeModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            var instance = bootstrap.Modal.getInstance($ageModal[0]);
            if (instance) {
                instance.hide();
            }
        } else {
            $ageModal.modal('hide');
        }
        activeSubjectSelect = null;
    }

    function isNudeVerified($form) {
        return $form.data('nude-age-verified') === true;
    }

    function setNudeVerified($form, verified) {
        $form.data('nude-age-verified', verified === true);
    }

    $(document).on('focus', '.js-filter-arts-form select[name="subject"]', function() {
        $(this).data('prev-subject', $(this).val());
    });

    $(document).on('change', '.js-filter-arts-form select[name="subject"]', function() {
        var $select = $(this);
        var $form = $select.closest('.js-filter-arts-form');

        if ($select.val() === 'nude') {
            setNudeVerified($form, false);
            showAgeModal($select);
            return;
        }

        setNudeVerified($form, false);
        $select.data('prev-subject', $select.val());
    });

    $('#filterArtsAgeYes').on('click', function() {
        if (!activeSubjectSelect) {
            hideAgeModal();
            return;
        }

        var $form = activeSubjectSelect.closest('.js-filter-arts-form');
        setNudeVerified($form, true);
        activeSubjectSelect.data('prev-subject', 'nude');
        hideAgeModal();
    });

    $('#filterArtsAgeNo').on('click', function() {
        if (!activeSubjectSelect) {
            hideAgeModal();
            return;
        }

        var $form = activeSubjectSelect.closest('.js-filter-arts-form');
        var previousValue = activeSubjectSelect.data('prev-subject') || '';

        activeSubjectSelect.val(previousValue);
        setNudeVerified($form, false);
        hideAgeModal();
    });

    $(document).on('submit', '.js-filter-arts-form', function(event) {
        var $form = $(this);
        var $subject = $form.find('select[name="subject"]');

        if (!$subject.length || $subject.val() !== 'nude') {
            return;
        }

        if (!isNudeVerified($form)) {
            event.preventDefault();
            showAgeModal($subject);
            return false;
        }
    });
})(jQuery);
</script>
@endonce
@endpush
