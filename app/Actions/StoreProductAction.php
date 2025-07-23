<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProductAction
{
    use AsAction;

    public function handle(array $data): Product
    {
        $data = collect($data);
        /** @var Product $product */
        $product = Product::create($data->except(['tag_ids', 'image'])->toArray());

        $product->syncTags($data->get('tag_ids'));

        if ($data->isNotEmpty(Product::MEDIA_COLLECTION_IMAGES)) {
            $product->addMediaFromRequest(Product::MEDIA_COLLECTION_IMAGES)
            ->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
        }

        return $product;
    }
}
