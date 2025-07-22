<?php

namespace App\Http\Requests;

use App\Enums\CurrencyEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO 7: use policy https://laravel.com/docs/12.x/authorization
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'array'],
            'name.en' => ['sometimes', 'string'],
            'name.ar' => ['sometimes', 'string'],

            'description' => ['nullable', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.ar' => ['nullable', 'string'],

            'price' => ['sometimes', 'numeric', 'min:0'],
            'currency' => ['sometimes', new Enum(CurrencyEnum::class)],
            'status' => ['sometimes', new Enum(ProductStatusEnum::class)],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['exists:tags,id'],
        ];
    }
}
