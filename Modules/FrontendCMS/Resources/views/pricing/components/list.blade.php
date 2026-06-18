<div class="row">
    <div class="col-lg-12">
        <table class="table Crm_table_active3">
            <thead>
                <tr>
                    <th scope="col">{{ __('common.sl') }}</th>
                    <th scope="col">{{ __('common.name') }}</th>
                    <th scope="col">{{ __('common.image') }}</th>
                    <th scope="col">{{__('frontendCms.plan_price')}}</th>
                    <th scope="col">{{__('frontendCms.team_size')}}</th>
                    <th scope="col">{{__('frontendCms.product_limit')}}</th>
                    <th scope="col">{{__('frontendCms.category_limit')}}</th>
                    <th scope="col">{{ __('common.status') }}</th>
                    <th scope="col">{{ __('common.action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($PricingList as $key => $item)
                    <tr>
                        <td>{{getNumberTranslate($key + 1)}}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <img style="width: 100px; height:100;" src="{{ showImage($item->image) }}" alt="">
                        </td>
                        <td>{{getNumberTranslate($item->plan_price) }}</td>
                        <td>{{getNumberTranslate( $item->team_size) }}</td>
                        <td>{{ getNumberTranslate($item->stock_limit) }}</td>
                        <td>{{ getNumberTranslate($item->category_limit) }}</td>
                        <td>
                            <label class="switch_toggle" for="checkbox{{ $item->id }}">
                                <input type="checkbox" id="checkbox{{ $item->id }}" {{$item->status?'checked':''}} class="statusChange" data-status="{{ $item->status }}" value="{{$item->id}}" @if (permissionCheck('admin.pricing.status'))
                                @endif>
                                <div class="slider round"></div>
                            </label>
                        </td>
                        <td>
                            <!-- shortby  -->
                            <div class="dropdown CRM_dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('common.select') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <a href="javascript:void(0)"
                                        class="dropdown-item show_pricing"
                                        data-name="{{ $item->name }}"
                                        data-monthly_cost="{{ $item->monthly_cost }}"
                                        data-yearly_cost="{{ $item->yearly_cost }}"
                                        data-team_size="{{ $item->team_size }}"
                                        data-stock_limit="{{ $item->stock_limit }}"
                                        data-category_limit="{{ $item->category_limit }}"
                                        data-transaction_fee="{{ $item->transaction_fee }}">{{ __('common.show') }}</a>
                                    @if (permissionCheck('admin.pricing.update'))
                                        <a href="javascript:void(0)" data-id="{{ $item->id }}" class="dropdown-item edit_pricing">{{ __('common.edit') }}</a>
                                    @endif
                                    @if (permissionCheck('admin.pricing.delete'))
                                        <a class="dropdown-item delete_pricing" data-id="{{$item->id}}">{{ __('common.delete') }}</a>
                                    @endif
                                </div>
                            </div>
                            <!-- shortby  -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
