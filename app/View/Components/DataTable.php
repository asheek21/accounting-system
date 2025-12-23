<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public function __construct(
        public string $id,
        public array $columns,
        public string $type,
        public string $emptyMessage = 'No data found.',
        public bool $searchable = true,
        public int $perPage = 10
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-table');
    }
}
