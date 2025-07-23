<?php

namespace App\Actions;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductAction
{
    use AsAction;

    public function handle(Product $product, array $data): Product
    {
        $product->update($data->safe()->except(['tag_ids', 'image']));
        $product->syncTags($data->tag_ids);

        if ($data->hasFile(Product::MEDIA_COLLECTION_IMAGES)) {
            $product->clearMediaCollection(Product::MEDIA_COLLECTION_IMAGES);

            $product->addMediaFromRequest(Product::MEDIA_COLLECTION_IMAGES)
                ->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
        }
    }
}
