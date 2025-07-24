<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

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
            'media' => [
                // TODO:
            ],

        ];
    }
}
