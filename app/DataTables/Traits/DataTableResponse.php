<?php

namespace App\DataTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait DataTableResponse
{
    /**
     * Provides a standardized JSON response structure for paginated,
     */
    protected function dataTableResponse(
        Builder $query,
        Request $request,
        array $orderby = []
    ): JsonResponse {
        // Apply search filter
        if (! empty($orderby)) {
            $query->orderBy($orderby[0], $orderby[1]);
        } else {
            $query->orderBy('id', 'desc');
        }

        // Get per_page from request or use default
        $perPage = $request->input('per_page', 10);

        // Paginate results
        $results = $query->paginate($perPage);

        return response()->json([
            'data' => $results->items(),
            'current_page' => $results->currentPage(),
            'last_page' => $results->lastPage(),
            'per_page' => $results->perPage(),
            'total' => $results->total(),
            'from' => $results->firstItem() ?? 0,
            'to' => $results->lastItem() ?? 0,
        ]);
    }

    protected function applyFilters(
        Builder $query,
        Request $request,
        array $filterableColumns = []
    ): Builder {
        foreach ($filterableColumns as $column => $type) {

            if ($type === 'daterange') {
                $from = $request->input($column.'_from');
                $to = $request->input($column.'_to');

                $value = ! empty($from) || ! empty($to) ? true : false;
            } else {
                $value = $request->input($column);
            }

            if ($value === null || $value === '') {
                continue;
            }

            switch ($type) {
                case 'exact':
                    $query->where($column, $value);
                    break;

                case 'like':
                    $query->where($column, 'like', "%{$value}%");
                    break;

                case 'date':
                    $query->whereDate($column, $value);
                    break;

                case 'daterange':
                    $from = $request->input("{$column}_from");
                    $to = $request->input("{$column}_to");

                    if ($from) {
                        $query->whereDate($column, '>=', $from);
                    }
                    if ($to) {
                        $query->whereDate($column, '<=', $to);
                    }

                    break;

                default:
                    $query->where($column, $value);
            }
        }

        return $query;
    }

    protected function applySearch(
        Builder $query,
        Request $request,
        array $searchableColumns = []
    ): Builder {

        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($searchableColumns, $search) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }
            });
        }

        return $query;
    }
}
