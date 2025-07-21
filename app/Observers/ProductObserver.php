<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function creating(Product $product): void
    {
        if (Auth::check()) {
            $product->user_id = Auth::id();
        }
    }
}
