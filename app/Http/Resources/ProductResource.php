<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        $lang = App::getLocale();

        return [
            'id' => $this->id,
            'name' => $this->name[$lang],
            'description' => $this->description[$lang],
            'price' => $this->price,
            'status' => $this->status,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'images' => ImageResource::collection($this->getMedia(Product::MEDIA_COLLECTION_IMAGES)),

        ];
    }
}
