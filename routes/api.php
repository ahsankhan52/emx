<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['norobots'])->group(function () {
    // Public API Routes (Read-only)
    Route::get('pages', [PageController::class, 'index']);
    Route::get('pages/{slug}', [PageController::class, 'show']);
    Route::get('settings', [SettingController::class, 'index']);
    Route::get('services', [ServiceController::class, 'index']);
    Route::get('services/{id}', [ServiceController::class, 'show']);
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::get('gallery', [GalleryController::class, 'index']);

    // Protected Admin API Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        // Profile management
        Route::get('/profile', [ProfileController::class, 'show']);
        Route::post('/profile', [ProfileController::class, 'update']);

        // Content Management (Writers/Deleters)
        Route::post('gallery', [GalleryController::class, 'store']);
        Route::delete('gallery/{id}', [GalleryController::class, 'destroy']);

        Route::post('reviews', [ReviewController::class, 'store']);
        Route::put('reviews/{id}', [ReviewController::class, 'update']);
        Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);

        Route::post('services', [ServiceController::class, 'store']);
        Route::put('services/{id}', [ServiceController::class, 'update']);
        Route::delete('services/{id}', [ServiceController::class, 'destroy']);

        Route::apiResource('users', UserController::class);

        Route::put('pages/{slug}', [PageController::class, 'update']);
        Route::post('settings', [SettingController::class, 'update']);
    });
});
