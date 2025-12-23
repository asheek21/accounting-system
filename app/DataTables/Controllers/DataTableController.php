<?php

namespace App\DataTables\Controllers;

use App\DataTables\DataTableRegistry;
use App\DataTables\Traits\DataTableResponse;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Single controller endpoint for all DataTable requests.
 */
class DataTableController extends Controller
{
    use DataTableResponse;

    public function __construct(protected DataTableRegistry $registry) {}

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $handler = $this->registry->resolve($request->type);

        /** @var Builder $query */
        $query = $handler->query();
        $searchable = $handler->searchableColumns();
        $orderBy = $request->orderBy ?? [];

        return $this->dataTableResponse($query, $request, $searchable, $orderBy);
    }
}
