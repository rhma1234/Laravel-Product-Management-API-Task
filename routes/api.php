<?php

use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// =========================== Product ===============================
Route::resource('products', ProductController::class)->except(['create', 'show']);
Route::post('products/{productWithTrashed}/restore', [ProductController::class, 'restore'])->withTrashed();
Route::delete('products/{productWithTrashed}/force', [ProductController::class, 'forceDelete'])->withTrashed();
// =========================== Product ===============================
// =========================== Auth ===============================
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
// =========================== Auth ===============================
