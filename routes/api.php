<?php

use App\Http\Controllers\Api\Auth\GoogleController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Historical\HistoricalFigureController;
use App\Http\Controllers\Api\Historical\HistoricalTopicsController;
use App\Http\Controllers\Api\Location\LocationController;
use App\Http\Controllers\Api\Story\StoryProvinceController;
use App\Http\Controllers\Api\Story\StoryProvinceDetailController;
use App\Http\Controllers\Api\GuessFigure\GuessFigureQuizController;
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

Route::prefix('story-provinces')->group(function () {
    Route::get('/', [StoryProvinceController::class, 'index']);
    Route::post('/', [StoryProvinceController::class, 'store']);
    Route::get('/{id}', [StoryProvinceController::class, 'show']);
    Route::get('/slug/{slug}', [StoryProvinceController::class, 'showBySlug']);
    Route::put('/{id}', [StoryProvinceController::class, 'update']);
    Route::delete('/{id}', [StoryProvinceController::class, 'destroy']);
});

Route::prefix('province-details')->group(function () {
    Route::get('/', [StoryProvinceDetailController::class, 'index']);
    Route::post('/', [StoryProvinceDetailController::class, 'store']);
    Route::get('/{id}', [StoryProvinceDetailController::class, 'show']);
    Route::put('/{id}', [StoryProvinceDetailController::class, 'update']);
    Route::delete('/{id}', [StoryProvinceDetailController::class, 'destroy']);
});

Route::prefix('guess-figure')->group(function () {
    Route::get('/quizzes', [GuessFigureQuizController::class, 'index']);
    Route::get('/quizzes/{id}', [GuessFigureQuizController::class, 'show']);
    Route::post('/quizzes/{quizId}/questions/{questionId}/check', [GuessFigureQuizController::class, 'checkAnswer']);
});