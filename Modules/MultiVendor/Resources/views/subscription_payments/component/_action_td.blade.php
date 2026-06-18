<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"> {{ __('common.select') }}
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        @if (permissionCheck('admin.subscription_payment_list'))
            <a data-value="{{ route('admin.subscription_payment.destroy', $subscription->id) }}" class="dropdown-item delete_subscription_payment" type="button">{{ __('common.delete') }}</a>
        @endif
    </div>
</div>
