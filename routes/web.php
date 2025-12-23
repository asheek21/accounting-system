<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginShowController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginShowController::class)->name('login.show');
    Route::post('/login', LoginController::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);

    Route::redirect('/', route('dashboard.index', absolute: false))->name('home');
});
