<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductAction
{
    use AsAction;

    public function handle(Product $product, array $data): Product
    {
        // TODO: convert it to collection
        $product->update(Arr::except($data,(['tag_ids', 'image'])));
        // TODO: optimize this line
        $product->syncTags($data['tag_ids'] ?? []);


         if (!empty($data[Product::MEDIA_COLLECTION_IMAGES]))   {
            $product->clearMediaCollection(Product::MEDIA_COLLECTION_IMAGES);

            $product->addMediaFromRequest(Product::MEDIA_COLLECTION_IMAGES)
                ->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
        }
        return $product;
    }
}
