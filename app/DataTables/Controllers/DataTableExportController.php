<?php

namespace App\DataTables\Controllers;

use App\DataTables\DataTableRegistry;
use App\DataTables\Exports\DataTableExport;
use App\DataTables\Traits\DataTableResponse;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

/**
 * Single controller endpoint for all DataTable requests.
 */
class DataTableExportController extends Controller
{
    use DataTableResponse;

    public function __construct(protected DataTableRegistry $registry) {}

    public function __invoke(Request $request): Response
    {
        $handler = $this->registry->resolve($request->type);

        /** @var Builder $query */
        $query = $handler->query();
        $searchable = $handler->searchableColumns();
        $filterable = $handler->filterableColumns();

        $query = $this->applyFilters($query, $request, $filterable);

        $query = $this->applySearch($query, $request, $searchable);

        $columns = $this->registry->columns($request->type);

        $fileName = Str::snake($request->type).'_'.now()->timestamp.'.xlsx';

        return (new DataTableExport)
            ->setQuery($query)
            ->setMappingAndHeading($columns)
            ->download($fileName);
    }
}
