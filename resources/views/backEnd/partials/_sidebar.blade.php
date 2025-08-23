<!-- sidebar part here -->
@if(config('app.sync'))
<a target="_blank" href="https://aorasoft.com/" class="float_button"> <i class="ti-shopping-cart-full"></i>
    <h3>{{ __('common.Purchase Amazcart') }}</h3>
</a>
@endif
<nav id="sidebar" class="sidebar">
    @php
        $dashboard_url = '';
        if (auth()->user()->role->type == 'staff') {
            $dashboard_url = route('event.dashboard');
        } elseif (auth()->user()->role->type == 'seller') {
            $dashboard_url = route('seller.dashboard');
        } else {
            $dashboard_url = route('admin.dashboard');
        }
    @endphp
    <div class="sidebar-header update_sidebar">
        <a class="large_logo" href="{{$dashboard_url}}">
            <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
        </a>
        <a class="mini_logo" href="{{$dashboard_url}}">
            <img src="{{showImage(app('general_setting')->favicon)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    @php

        $sidebars = \Modules\SidebarManager\Entities\BackendmenuUser::with('children', 'backendMenu')->whereNull('parent_id')->where('user_id', auth()->id())->orderBy('position')->get();
        $paid_modules = [
            'AmazonS3',
            'Affiliate',
            'Otp',
            'Bkash',
            'SslCommerz',
            'Lead',
            'MercadoPago',
            'ShipRocket',
            'GoldPrice',
            'WholeSale',
            'StorageCDN',
            'FrontendMultiLang',
            'INTShipping',
            'ClubPoint',
            'GoogleMerchantCenter',
            'CheckPincode',
            'Tabby',
            'POS',
            'AuctionProducts',
            'Pincode'
        ];

    @endphp
    @if($sidebars->count())
        <ul id="sidebar_menu">
            @if(auth()->user()->role->type == 'seller' && !hasBusinessInfo())
                <li class="">
                    <a href="{{ route('seller.profile.index') }}" class="" aria-expanded="false">
                        <div class="nav_icon_small"><span class="fas fa-business-time"></span></div>
                        <div class="nav_title"><span>{{ __("seller.update_business_info") }}</span></div>
                    </a>
                </li>
            @endif
            @foreach($sidebars as $key => $section)

                @if($section->children->count() > 0)
                    @if(auth()->user()->role->type == 'staff')
                        @if(__(@$section->backendMenu->name) == 'Human Resource')
                           <span class="menu_seperator">
                                {{__(@$section->backendMenu->name)}}
                            </span>
                        @endif
                    @else
                    <span class="menu_seperator">
                        {{__(@$section->backendMenu->name)}}
                    </span>
                    @endif
                @endif





                @if($section->children->count())
                    @foreach($section->children as $menu)

                        @if(!@$menu->backendMenu->module or isModuleActive(@$menu->backendMenu->module))
                            @if(@$menu->backendMenu->route == 'payment_gateway.index' && auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment)
                                @continue
                            @elseif(permissionCheck(@$menu->backendMenu->route))
                                <li class="{{spn_active_link(childrenRoute($menu))}}">
                                    <a href="
                                        @if(\Illuminate\Support\Facades\Route::has(@$menu->backendMenu->route) && !$menu->children->count())
                                            @if(@$menu->backendMenu->route == 'my-wallet.index')
                                                @if(auth()->user()->role->type == 'seller')
                                                    {{route(@$menu->backendMenu->route, 'seller')}}
                                                @else
                                                    {{route(@$menu->backendMenu->route, 'admin')}}
                                                @endif
                                            @elseif(@$menu->backendMenu->route == 'seller.sub_seller.index')
                                                @if(auth()->user()->role->type == 'seller')
                                                {{route('frontend.seller.book.event')}}
                                                @endif
                                            @else
                                                @if(auth()->user()->role->type == 'staff')
                                                    @if(@$menu->backendMenu->route == 'admin.dashboard')
                                                        {{route('event.dashboard')}}
                                                    @else
                                                        {{route(@$menu->backendMenu->route)}}    
                                                    @endif    
                                                @else
                                                    {{route(@$menu->backendMenu->route)}}
                                                @endif    
                                            @endif
                                         @else
                                            javascript:void(0)
                                         @endif" class="@if($menu->children->count()) has-arrow @endif" aria-expanded="false">
                                        <div class="nav_icon_small">
                                            <span class="{{@$menu->backendMenu->icon?@$menu->backendMenu->icon:'fas fa-users'}}"></span>
                                        </div>
                                        <div class="nav_title">
                                            @if(auth()->user()->role->type == 'staff')
                                                @if($section->backendMenu?->name == 'common.user_manages')
                                                    <span class="abc">Event Managment</span>
                                                @else    
                                                    <span class="xyz">{{__($menu->backendMenu->name)}}</span>
                                                @endif
                                            @else
                                            @if(auth()->user()->role->type == 'seller')
                                                @if($section->backendMenu?->name == 'common.user_manages')
                                                    <span class="jhs">{{__('Event Booknigs')}}</span>
                                                @else                        
                                                    <span class="jhs">{{__($menu->backendMenu->name)}} </span>                            
                                                @endif    
                                            @endif                                                    
                                            @endif
                                            @php
                                                $exp = explode('.',$menu->backendMenu->name)

                                            @endphp
                                            @if(config('app.sync') && in_array($menu->backendMenu->module, $paid_modules))
                                              <span class="demo_addons" style="font-size: 10px;">
                                                Addon
                                              </span>
                                            @endif
                                            @if($menu->backendMenu->name == 'general_settings.file_storage' && isModuleActive('StorageCDN') && config('app.sync'))
                                              <span class="demo_addons" style="font-size: 10px;">
                                                Addon
                                              </span>
                                            @endif
                                        </div>
                                    </a>
                                    @if($menu->children->count())
                                        <ul class="mm-collapse">
                                            @foreach($menu->children as $submenu)
                                                @if(app('theme')->folder_path == 'amazy')
                                                    @if(@$submenu->backendMenu->route == 'frontendcms.features.index' || @$submenu->backendMenu->route == 'frontendcms.about-us.index')
                                                        @continue
                                                    @endif
                                                @elseif(app('theme')->folder_path == 'default')
                                                    @if(@$submenu->backendMenu->route == 'frontendcms.ads_bar.index' || @$submenu->backendMenu->route == 'frontendcms.promotionbar.index' || @$submenu->backendMenu->route == 'frontendcms.login_page')
                                                        @continue
                                                    @endif
                                                @endif
                                                @if(!@$submenu->backendMenu->module or isModuleActive(@$submenu->backendMenu->module))
                                                    @if(permissionCheck($submenu->backendMenu->route))
                                                        <li>
                                                            @if(auth()->user()->role->type == 'staff' && $submenu->backendMenu->id == 12 && $submenu->backendMenu->name == 'hr.holiday_setup' && $submenu->backendMenu->route == 'holidays.index' )
                                                            <a href="{{route('booking.events')}}"
                                                                class="{{spn_active_link(['booking.events'], 'active')}} @if(@$submenu->children->count()) has-arrow @endif">{{__('Event Bookings')}}</a>
                                                            @else
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Route::has($submenu->backendMenu->route) && !$submenu->children->count())
                                                                    @if(@$submenu->backendMenu->route == 'my-wallet.index')
                                                                        @if(auth()->user()->role->type == 'seller')
                                                                            {{route(@$submenu->backendMenu->route, 'seller')}}
                                                                        @else
                                                                            {{route(@$submenu->backendMenu->route, 'admin')}}
                                                                        @endif
                                                                    @else
                                                                        {{route(@$submenu->backendMenu->route)}}
                                                                    @endif
                                                                @else
                                                                    javascript:void(0)
                                                                @endif"
                                                                class="{{spn_active_link(childrenRoute($submenu), 'active')}} @if(@$submenu->children->count()) has-arrow @endif">{{__(@$submenu->backendMenu->name)}}</a>
                                                            @endif    
                                                            @if(@$submenu->children->count())
                                                                <ul class="metis_submenu">
                                                                    @foreach($submenu->children as $subsubmenu)
                                                                        <li>

                                                                            <a href="@if(\Illuminate\Support\Facades\Route::has(@$subsubmenu->backendMenu->route)) {{route(@$subsubmenu->backendMenu->route)}} @else javascript:void(0) @endif"> {{__(@$subsubmenu->backendMenu->name)}} </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    @endif
</nav>
<!-- sidebar part end -->
