@if (permissionCheck('admin.customer.destroy'))
<label class="primary_checkbox d-flex mr-0 mb-0">
    <input type="checkbox" class="buyer_row_checkbox" value="{{ $customer->id }}">
    <span class="checkmark"></span>
</label>
@endif
