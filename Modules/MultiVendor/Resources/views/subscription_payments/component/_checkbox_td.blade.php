@if (permissionCheck('admin.subscription_payment_list'))
<label class="primary_checkbox d-flex mr-0 mb-0">
    <input type="checkbox" class="subscription_payment_row_checkbox" value="{{ $subscription->id }}">
    <span class="checkmark"></span>
</label>
@endif
