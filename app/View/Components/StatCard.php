<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public function __construct(
        public string $title,
        public string $value,
        public ?string $icon = null,
        public ?string $color = 'primary',
        public ?string $subtitle = null,
        public ?string $trend = null,
        public ?string $trendDirection = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.stat-card');
    }

    /**
     * Get color classes based on color prop
     */
    public function getColorClasses(): array
    {
        return match ($this->color) {
            'success' => [
                'bg' => 'bg-success-light',
                'text' => 'text-success',
                'icon' => 'text-success',
            ],
            'danger' => [
                'bg' => 'bg-danger-light',
                'text' => 'text-danger',
                'icon' => 'text-danger',
            ],
            'warning' => [
                'bg' => 'bg-warning-light',
                'text' => 'text-warning',
                'icon' => 'text-warning',
            ],
            'info' => [
                'bg' => 'bg-info-light',
                'text' => 'text-info',
                'icon' => 'text-info',
            ],
            default => [
                'bg' => 'bg-primary-50',
                'text' => 'text-primary-600',
                'icon' => 'text-primary-600',
            ],
        };
    }
}
