<?php

use App\Http\Controllers\Api\Auth\GoogleController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Historical\HistoricalFigureController;
use App\Http\Controllers\Api\Historical\HistoricalTopicsController;
use App\Http\Controllers\Api\Location\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/provinces', [LocationController::class, 'getProvince']);
Route::get('/cities/{id}', [LocationController::class, 'getCity']);

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('google', [GoogleController::class, 'redirectToProvider']);
    Route::get('google-callback', [GoogleController::class, 'handleProvideCallback']);
    Route::get('verify', [AuthController::class, 'verifyToken'])->middleware('jwt.auth');
});

Route::group(['prefix' => 'historical-topics', 'as' => 'historical-topics.'], function () {
    Route::get('/', [HistoricalTopicsController::class, 'index']);
    Route::get('/{id}', [HistoricalTopicsController::class, 'getById']);
    Route::get('/slug/{slug}', [HistoricalTopicsController::class, 'getBySlug']);
    Route::post('/', [HistoricalTopicsController::class, 'store']);
    Route::put('/{id}', [HistoricalTopicsController::class, 'update']);
    Route::delete('/{id}', [HistoricalTopicsController::class, 'destroy']);
});

Route::group(['prefix' => 'historical-figures', 'as' => 'historical-figures.'], function () {
    Route::get('/', [HistoricalFigureController::class, 'index']);
    Route::get('/{id}', [HistoricalFigureController::class, 'getById']);
    Route::get('/slug/{slug}', [HistoricalFigureController::class, 'getBySlug']);
    Route::post('/', [HistoricalFigureController::class, 'store']);
    Route::put('/{id}', [HistoricalFigureController::class, 'update']);
    Route::delete('/{id}', [HistoricalFigureController::class, 'destroy']);
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'getById']);
    Route::get('/slug/{slug}', [CategoryController::class, 'getBySlug']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});