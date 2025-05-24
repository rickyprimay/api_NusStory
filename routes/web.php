<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Dashboard\CategoryController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\Dashboard\HistoricalFigureController;
use App\Http\Controllers\Web\Dashboard\HistoricalTopicsController;
use App\Http\Controllers\Web\GuessFigureQuizController;
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
        Route::get('/create', [HistoricalFigureController::class, 'create'])->name('historical-figure.create');
        Route::post('/', [HistoricalFigureController::class, 'store'])->name('historical-figure.store');
        Route::get('/{id}/edit', [HistoricalFigureController::class, 'edit'])->name('historical-figure.edit');
        Route::put('/{id}', [HistoricalFigureController::class, 'update'])->name('historical-figure.update');
        Route::delete('/{id}', [HistoricalFigureController::class, 'destroy'])->name('historical-figure.destroy');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    });

    // Story Province Routes
    Route::get('/story-provinces', [App\Http\Controllers\Web\Dashboard\StoryProvinceController::class, 'index'])->name('story-provinces.index');
    Route::get('/story-provinces/{id}', [App\Http\Controllers\Web\Dashboard\StoryProvinceController::class, 'show'])->name('story-provinces.show');
    
    // Story Province Detail Routes
    Route::resource('story-province-details', App\Http\Controllers\Web\Dashboard\StoryProvinceDetailController::class);

    Route::resource('guess-figure', GuessFigureQuizController::class);
});
