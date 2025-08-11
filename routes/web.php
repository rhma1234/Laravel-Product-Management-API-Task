<?php
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserController::class, 'login']);
    Route::get('register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [UserController::class, 'register']);
});
Route::resource('products', ProductController::class);
Route::post('/products/{productWithTrashed}/restore', [ProductController::class, 'restore'])->name('products.restore');
Route::delete('/products/{productWithTrashed}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');