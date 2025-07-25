<?php

namespace App\Http\Requests\Product;

use App\Enums\CurrencyEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.en' => ['required', 'string'],
            'name.ar' => ['required', 'string'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'array'],
            'description.en' => ['nullable', 'string', 'max:225'],
            'description.ar' => ['nullable', 'string', 'max:225'],
            'price' => ['required', 'numeric', 'min:0', 'max:1000000000'],
            'currency' => ['required', Rule::enum(CurrencyEnum::class)],
            'status' => ['required', Rule::enum(ProductStatusEnum::class)],
            'category_id' => ['required',  Rule::exists('categories', 'id')],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => [Rule::exists('tags', 'id')],
        ];
    }
}
