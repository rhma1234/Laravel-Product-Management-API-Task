<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'tags']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('tag_id')) {
            $query->whereHas('tags', fn ($q) => $q->where('id', $request->tag_id));
        }

        return response()->json($query->get());

    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    public function destroy(Product $product): JsonResponse
    {
        // TODO: use laravel policy
        $userId = Auth::user()->id;
        if ($product->user_id !== $userId) {
            return response()->json([
                'message' => 'You are not authorized to update this product.',
            ]);
        }

        $product->delete();

        return response()->json([
            'message' => __('messages.product_soft_deleted'),
        ]);

        // TODO: messages in ar and en
    }

    public function restore(Product $product) // TODO:  function
    {

        $product->restore();

        return response()->json(['message' => __('messages.product_restored')]);
    }

    public function forceDelete(Product $product): JsonResponse // TODO:
    {
        $product->forceDelete();

        return response()->json(['message' => __('messages.product_deleted')]);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $data = $request->validated();

        $product = Product::create($data);

        if (! empty($data['tag_ids'])) {
            $product->tags()->sync($data['tag_ids']);
        }

        if ($request->hasFile('image')) {
            $product->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return response()->json($product);
    }

  public function update(UpdateProductRequest $request, Product $product): JsonResponse
{
    $data = $request->validated();
    $product->update($data);

    if (! empty($data['tag_ids'])) {
        $product->tags()->sync($data['tag_ids']);
    }

    return response()->json([
        'message' => __('messages.product_updated'),
    ]);
}

}
