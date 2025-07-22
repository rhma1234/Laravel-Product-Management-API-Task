<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// =========================== Product ===============================
Route::apiResource('products', ProductController::class);
Route::post('{product}/restore', [ProductController::class, 'restore'])->withTrashed();
Route::delete('{productWithTrashed}/force', [ProductController::class, 'forceDelete'])->withTrashed();
// =========================== Product ===============================
// =========================== Auth ===============================
Route::post('logout', [UserController::class, 'logout']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
// =========================== Auth ===============================
