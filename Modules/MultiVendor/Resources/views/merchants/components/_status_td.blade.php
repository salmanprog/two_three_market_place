@if(in_array(auth()->user()->role->type, ['superadmin', 'admin', 'staff']))
<label class="switch_toggle" for="active_checkbox{{ $seller->user->id }}">
    <input type="checkbox" id="active_checkbox{{ $seller->user->id }}" @if ($seller->user->is_active == 1) checked @endif value="{{ $seller->user->id }}" class="update_merchant_status" data-id="{{ $seller->user->id }}">
    <div class="slider round"></div>
</label>
@else
{{ $seller->user->is_active == 1 ? __('common.active') : __('common.inactive') }}
@endif
