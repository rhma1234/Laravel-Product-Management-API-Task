<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{product}', [ProductController::class, 'show']);
    Route::post('/{id}/restore', [ProductController::class, 'restore']);
    Route::delete('/{product}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');
    Route::delete('/{id}/force', [ProductController::class, 'forceDelete']);
    Route::put('/{product}', [ProductController::class, 'update'])->middleware('auth:sanctum');

});
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
