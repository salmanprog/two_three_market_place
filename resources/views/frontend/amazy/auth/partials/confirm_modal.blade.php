<script type="text/javascript">
    function confirm_modal()
    {
        jQuery('#confirm-modal').modal('show', {backdrop: 'static'});
    }
</script>

<div class="modal fade admin-query" id="confirm-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" style="display:block;">{{ __('Congratulations') }}</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4>{{__('You have successfully signed up. Your account is waiting for admin approval.')}}</h4>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <a id="confirm_link" class="amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25">{{__('Go to Home')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
