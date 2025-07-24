<?php

namespace App\Actions;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProductAction
{
    use AsAction;

    public function handle(array $data): Product
    {
        $data = collect($data);

        /** @var Product $product */
        $product = Product::create($data->except(['tag_ids', 'images'])->toArray());

        $product->syncTags($data->get('tag_ids'));

        if (($data->isNotEmpty($data[Product::MEDIA_COLLECTION_IMAGES]))) {
            collect($data->get('images'))->each(function ($image, $key) use ($product) {
                $product->addMediaFromRequest("images.$key")->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
            });
        }

        return $product;
    }
}
