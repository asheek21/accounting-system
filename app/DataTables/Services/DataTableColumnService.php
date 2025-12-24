<?php

namespace App\DataTables\Services;

use App\DataTables\DataTableRegistry;
use App\Http\Requests\DataTableRequest;

class DataTableColumnService
{
    public function __construct(protected DataTableRegistry $registry) {}

    public function getColumns(DataTableRequest $request): array
    {
        return $this->registry->columns($request->type);
    }
}
