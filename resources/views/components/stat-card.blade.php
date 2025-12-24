@php
    $colors = $getColorClasses();
@endphp

<div class="bg-white rounded-lg border border-border p-6 hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="text-sm text-secondary mb-1">{{ $title }}</p>
            <h3 class="text-2xl font-bold text-primary">{{ $value }}</h3>
            
            @if($subtitle)
            <p class="text-xs text-tertiary mt-1">{{ $subtitle }}</p>
            @endif

            @if($trend)
            <div class="mt-3 flex items-center text-xs">
                @if($trendDirection === 'up')
                <svg class="w-4 h-4 text-success mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span class="text-success font-medium">{{ $trend }}</span>
                @elseif($trendDirection === 'down')
                <svg class="w-4 h-4 text-danger mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                </svg>
                <span class="text-danger font-medium">{{ $trend }}</span>
                @else
                <span class="text-secondary">{{ $trend }}</span>
                @endif
            </div>
            @endif
        </div>

        @if($icon)
        <div class="w-12 h-12 {{ $colors['bg'] }} rounded-lg flex items-center justify-center flex-shrink-0 ml-4">
            <div class="{{ $colors['icon'] }}">
                {!! $icon !!}
            </div>
        </div>
        @endif
    </div>
</div>