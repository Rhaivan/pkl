<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users', PenggunaController::class)
    ->except(['show'])
    ->parameters(['users' => 'pengguna']);