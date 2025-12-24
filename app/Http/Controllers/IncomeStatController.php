<?php

namespace App\Http\Controllers;

use App\Services\IncomeStatService;
use Illuminate\Http\Request;

class IncomeStatController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, IncomeStatService $service)
    {
        return response()->json($service->execute($request));
    }
}
