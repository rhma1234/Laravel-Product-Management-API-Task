<?php

namespace App\ViewModels;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Product;
use Spatie\ViewModels\ViewModel;
use App\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Collection;

// TODO: change it to ProductViewModel
class ProductFormViewModel extends ViewModel
{
    public function __construct(public ?Product $product = null)
    {
        //
    }

    // return type
    public function categories(): Collection
    {
        return Category::all();
    }
     public function tags()
    {
        return Tag::all();
    }
      public function statuses()
    {
        return ProductStatusEnum::cases();
    }
    public function currencies()
    {
        return CurrencyEnum::cases();
    }

}
