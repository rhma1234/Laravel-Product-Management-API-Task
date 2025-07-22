<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(function () {
    // TODO: what is the difference resource and resourceApi?
    Route::resource('products', ProductController::class);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('{product}/restore', [ProductController::class, 'restore']);
    Route::delete('{product}/force', [ProductController::class, 'forceDelete']);
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
