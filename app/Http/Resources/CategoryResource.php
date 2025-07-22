<?php

namespace App\Http\Resources;

// use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   $lang = App::getLocale();
        return [
            'id' => $this->id,
            'name' => $this->name[$lang],
        ];
    }
}
