<?php

namespace App\Http\Controllers;

use App\Services\ExpenseStatService;
use Illuminate\Http\Request;

class ExpenseStatController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ExpenseStatService $service)
    {
        return response()->json($service->execute($request));
    }
}
