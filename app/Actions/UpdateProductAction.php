<?php

namespace App\Actions;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductAction
{
    use AsAction;

    public function handle(array $data, Product $product): Product
    {

        $data = collect($data);
        $product->update(
            $data->except(['tag_ids', 'image'])->toArray()
        );

        $product->syncTags($data->get('tag_ids'));

        if ($data->isNotEmpty($data[Product::MEDIA_COLLECTION_IMAGES])) {
            $product->clearMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
            collect($data->get('images'))->each(function ($image, $key) use ($product) {
                $product
                    ->addMediaFromRequest("images.$key")
                    ->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);

            });

        }

        return $product;
    }
}
