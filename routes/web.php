<?php

use App\DataTables\Controllers\DataTableController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginShowController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginShowController::class)->name('login.show');
    Route::post('/login', LoginController::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('account', AccountController::class)->only('index');
    Route::resource('category', CategoryController::class)->only('index');
    Route::resource('transactions', TransactionController::class);

    Route::get('/data-table', DataTableController::class)->name('data-table');

    Route::redirect('/', route('dashboard.index', absolute: false))->name('home');
});
