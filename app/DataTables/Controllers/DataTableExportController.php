<?php

namespace App\DataTables\Controllers;

use App\DataTables\Exports\DataTableExport;
use App\DataTables\Services\DataTableColumnService;
use App\DataTables\Services\DataTableQueryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataTableRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Single controller endpoint for all DataTable requests.
 */
class DataTableExportController extends Controller
{
    public function __construct(public DataTableQueryService $service, public DataTableColumnService $serviceColumns) {}

    public function __invoke(DataTableRequest $request): BinaryFileResponse|Response
    {
        $query = $this->service->getQuery($request);

        $columns = $this->serviceColumns->getColumns($request);

        $fileName = Str::snake($request->type).'_'.now()->timestamp.'.xlsx';

        return (new DataTableExport)
            ->setQuery($query)
            ->setMappingAndHeading($columns)
            ->download($fileName);
    }
}
