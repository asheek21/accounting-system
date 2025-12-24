<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $currentMonth = now()->format('Y-m');

        $accounts = Account::pluck('account_name', 'id')->toArray();
        $categories = Category::pluck('category_name', 'id')->toArray();

        return view('reports.index', compact('accounts', 'categories', 'currentMonth'));
    }
}
