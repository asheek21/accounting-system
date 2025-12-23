<?php

namespace App\DataTables\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface DataTableInterface
{
    public function query(): Builder;

    public function searchableColumns(): array;
}
