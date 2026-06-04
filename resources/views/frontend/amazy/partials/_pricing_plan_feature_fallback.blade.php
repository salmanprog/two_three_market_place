@if(($context ?? null) === 'art-gallery')
    <li><i class="fas fa-calendar"></i> {{ __('Art Galleries') }} : {{ __('defaultTheme.unlimited') }}</li>
    <li><i class="fas fa-percentage"></i> {{ __('defaultTheme.transaction_charge') }} : {{ $plan->transaction_fee }} % </li>
@elseif(($context ?? null) === 'event')
    <li><i class="fas fa-calendar"></i> {{ __('Events') }} : {{ __('defaultTheme.unlimited') }}</li>
    <li><i class="fas fa-percentage"></i> {{ __('defaultTheme.transaction_charge') }} : {{ $plan->transaction_fee }} % </li>
@elseif(($context ?? null) === 'artist' && $plan->id == 1)
    <li><i class="fas fa-eye"></i> 60% commission on art & service sales</li>
    <li><i class="fas fa-layer-group"></i> Unlimited Digital Gallery and Service Listing Space</li>
    <li><i class="fas fa-user-circle"></i> Customizable Online Profile</li>
    <li><i class="fas fa-shipping-fast"></i> Delivery & Shipping Services</li>
@elseif(($context ?? null) === 'artist' && $plan->id == 2)
    <li><i class="fas fa-eye"></i> 75% commission on art & service sales</li>
    <li><i class="fas fa-check"></i> All services in the Basic Tier</li>
    <li><i class="fas fa-building"></i> Priority connections to physical gallery spaces.</li>
    <li><i class="fab fa-facebook-square"></i> Profile Advertisements & Features on Social Media and marketing campaigns</li>
    <li><i class="fas fa-search"></i> Search Optimization/Increased Exposure</li>
@else
    <li><i class="fas fa-users"></i> {{ __('defaultTheme.team_member') }} : {{ $plan->team_size }}</li>
    <li><i class="fas fa-box"></i> {{ __('defaultTheme.products') }} : {{ $plan->stock_limit }}</li>
    <li><i class="fas fa-list"></i> {{ __('defaultTheme.categories') }} : {{ $plan->category_limit }}</li>
    <li><i class="fas fa-percentage"></i> {{ __('defaultTheme.transaction_charge') }} : {{ $plan->transaction_fee }} % </li>
@endif
