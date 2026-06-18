<table class="table" id="inactiveCustomerTable">
    <thead>
        <tr>
            @if (permissionCheck('admin.customer.destroy'))
            <th>
                <label class="primary_checkbox d-flex mr-0 mb-0">
                    <input type="checkbox" class="select_all_designers" data-table="inactiveCustomerTable">
                    <span class="checkmark"></span>
                </label>
            </th>
            @endif
            <th>{{__('common.sl')}}</th>
            <th>{{ __('common.avatar') }}</th>
            <th>{{ __('common.name') }}</th>
            <th>{{ __('common.email') }}</th>
            <th>{{ __('common.phone') }}</th>
            <th>{{ __('Total Balance') }}</th>
            <th>{{ __('common.total_orders') }}</th>
            <th>{{ __('common.is_active') }}</th>
            <th>{{ __('common.action') }}</th>
        </tr>
    </thead>
    
</table>
