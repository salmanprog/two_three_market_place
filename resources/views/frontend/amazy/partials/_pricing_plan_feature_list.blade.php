@php
    $planFeatures = $plan->relationLoaded('activeFeatures')
        ? $plan->activeFeatures
        : $plan->activeFeatures()->get();
@endphp

<ul class="feature_list">
    @if($planFeatures->count() > 0)
        @foreach($planFeatures as $feature)
            <li><i class="{{ $feature->icon ?: 'fas fa-check' }}"></i> {{ $feature->title }}</li>
        @endforeach
    @else
        @include('frontend.amazy.partials._pricing_plan_feature_fallback', [
            'plan' => $plan,
            'context' => $context ?? null,
        ])
    @endif
</ul>
