<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');