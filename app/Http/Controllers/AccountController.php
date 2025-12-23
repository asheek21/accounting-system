<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('account.index');
    }
}
