<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'getData']);
        Route::post('/', [ProductController::class, 'addData']);
        Route::get('/{id}', [ProductController::class, 'getDetail']);
        Route::put('/{id}', [ProductController::class, 'updateData']);
        Route::delete('/{id}', [ProductController::class, 'deleteData']);
    });
});
