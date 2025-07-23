<?php

namespace App\Actions;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProductAction
{
    use AsAction;
    // TODO: change it to array, line 14

    public function handle(Product $product, array $request): Product
    {$product = Product::create($request->safe()->except(['tag_ids', 'image']));
         $product->syncTags($request->tag_ids);

        if ($request->hasFile(Product::MEDIA_COLLECTION_IMAGES)) {
            $product->addMedia($request->file(Product::MEDIA_COLLECTION_IMAGES))->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
        }
        return $product;
    }
}
