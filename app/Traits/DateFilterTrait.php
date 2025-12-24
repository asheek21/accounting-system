<?php

namespace App\traits;

use Illuminate\Http\Request;

trait DateFilterTrait
{
    /**
     * Helper to apply date filter
     */
    private function applyDateFilter($query, Request $request)
    {
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }
    }
}
