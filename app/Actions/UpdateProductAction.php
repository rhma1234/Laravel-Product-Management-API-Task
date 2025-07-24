<?php

namespace App\Actions;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductAction
{
    use AsAction;

    public function handle(array $data, Product $product): Product
    {
        // TODO: use each function
        $data = collect($data);
        $product->update(
            $data->except(['tag_ids', 'image'])->toArray()
        );

        $product->syncTags($data->get('tag_ids'));

        if ($data->isNotEmpty($data[Product::MEDIA_COLLECTION_IMAGES])) {
            $product->clearMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
  $product->clearMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
   foreach (array_keys($data->get('images')) as $index) {
        $product
            ->addMediaFromRequest("images.$index")
            ->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
    }
}
        return $product;
}
}