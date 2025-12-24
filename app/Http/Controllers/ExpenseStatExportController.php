<?php

namespace App\Http\Controllers;

use App\DataTables\Exports\TransactionExport;
use App\DataTables\Services\DataTableColumnService;
use App\DataTables\Services\DataTableQueryService;
use App\Http\Requests\DataTableRequest;
use App\Services\ExpenseStatService;

class ExpenseStatExportController extends Controller
{
    public function __construct(public DataTableQueryService $queryService, public DataTableColumnService $columnService) {}

    public function __invoke(DataTableRequest $request, ExpenseStatService $service)
    {
        $stats = $service->execute($request);

        $query = $this->queryService->getQuery($request);

        $columns = $this->columnService->getColumns($request);

        $fileName = 'expense-report('.$request->date_from.'-'.$request->date_to.').xlsx';

        return (new TransactionExport(
            stats: $stats,
            columns: $columns,
            rows: $query->get()
        ))->download($fileName);
    }
}
