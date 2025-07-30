<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrapFive();
        App::setLocale(Session::get('locale', config('app.locale')));
        Product::observe(ProductObserver::class);

        Route::bind('productWithTrashed', function (string $value) {
            return Product::withTrashed()->findOrFail($value);
        });
    }
}
