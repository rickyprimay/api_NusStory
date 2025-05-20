<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\Dashboard\HistoricalFigureController;
use App\Http\Controllers\Web\Dashboard\HistoricalTopicsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('historical-topics')->group(function () {
        Route::get('/', [HistoricalTopicsController::class, 'index'])->name('historical-topics.index');
        Route::get('/create', [HistoricalTopicsController::class, 'create'])->name('historical-topics.create');
        Route::post('/', [HistoricalTopicsController::class, 'store'])->name('historical-topics.store');
        Route::get('/{id}/edit', [HistoricalTopicsController::class, 'edit'])->name('historical-topics.edit');
        Route::put('/{id}', [HistoricalTopicsController::class, 'update'])->name('historical-topics.update');
        Route::delete('/{id}', [HistoricalTopicsController::class, 'destroy'])->name('historical-topics.destroy');
    });

    Route::prefix('historical-figure')->group(function () {
        Route::get('/', [HistoricalFigureController::class, 'index'])->name('historical-figure.index');
    });
});
