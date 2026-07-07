@if(in_array(auth()->user()->role->type, ['superadmin', 'admin', 'staff']))
<label class="switch_toggle" for="active_checkbox{{ $customer->id }}">
    <input type="checkbox" id="active_checkbox{{ $customer->id }}" @if ($customer->is_active == 1) checked @endif value="{{ $customer->id }}" class="update_active_status" data-id="{{ $customer->id }}">
    <div class="slider round"></div>
</label>
@else
{{ $customer->is_active == 1 ? __('common.active') : __('common.inactive') }}
@endif
