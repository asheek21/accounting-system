<?php

namespace App\DataTables\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    use Exportable;

    public function __construct(protected array $stats, protected array $columns, protected Collection $rows) {}

    public function view(): View
    {
        return view('exports.transaction', [
            'stats' => $this->stats,
            'columns' => $this->columns,
            'rows' => $this->rows,
        ]);
    }
}
