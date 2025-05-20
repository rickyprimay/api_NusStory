<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\Dashboard\HistoricalTopicsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/historical-topics', [HistoricalTopicsController::class, 'index'])->name('historical-topics.index');
        Route::get('/historical-topics/create', [HistoricalTopicsController::class, 'create'])->name('historical-topics.create');
        Route::post('/historical-topics', [HistoricalTopicsController::class, 'store'])->name('historical-topics.store');
        Route::get('/historical-topics/{id}/edit', [HistoricalTopicsController::class, 'edit'])->name('historical-topics.edit');
        Route::put('/historical-topics/{id}', [HistoricalTopicsController::class, 'update'])->name('historical-topics.update');
        Route::delete('/historical-topics/{id}', [HistoricalTopicsController::class, 'destroy'])->name('historical-topics.destroy');
    });
});
