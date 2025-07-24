<?php

namespace App\Http\Requests\Product;

use App\Enums\CurrencyEnum;
use Illuminate\Validation\Rule;
use App\Enums\ProductStatusEnum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', $this->route('product'));
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'array'],
            'name.en' => ['sometimes', 'string'],
            'name.ar' => ['sometimes', 'string'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.ar' => ['nullable', 'string'],

            'price' => ['sometimes', 'numeric', 'min:0'],
            'currency' => ['sometimes', new Enum(CurrencyEnum::class)],
            'status' => ['sometimes', new Enum(ProductStatusEnum::class)],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => [Rule::exists('tags', 'id')],
        ];
    }
}
