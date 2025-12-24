<?php

namespace App\DataTables\Services;

use App\DataTables\DataTableRegistry;
use App\DataTables\Traits\DataTableResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Database\Eloquent\Builder;

class DataTableQueryService
{
    use DataTableResponse;

    public function __construct(protected DataTableRegistry $registry) {}

    public function getQuery(DataTableRequest $request): Builder
    {
        $handler = $this->registry->resolve($request->type);

        /** @var Builder $query */
        $query = $handler->query();
        $searchable = $handler->searchableColumns();
        $filterable = $handler->filterableColumns();

        $query = $this->applyFilters($query, $request, $filterable);

        $query = $this->applySearch($query, $request, $searchable);

        return $query;
    }
}
