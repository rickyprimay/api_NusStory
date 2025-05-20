<?php

use App\Http\Controllers\Api\Auth\GoogleController;
use App\Http\Controllers\Api\Auth\AuthController;
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
    Route::get('/{slug}', [HistoricalTopicsController::class, 'getBySlug']);
    Route::post('/', [HistoricalTopicsController::class, 'store']);
    Route::put('/{id}', [HistoricalTopicsController::class, 'update']);
    Route::delete('/{id}', [HistoricalTopicsController::class, 'destroy']);
});
