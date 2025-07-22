<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth:sanctum',
        ];
    }

    public function index(Request $request): JsonResponse
    {
        // TODO: please enhance this filter query
        $query = Product::filter();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('tag_id')) {
            $query->whereHas('tags', fn ($q) => $q->where('id', $request->tag_id));
        }
        // TODO: please use resource

        return response()->json($query->get());

    }

    public function show(Product $product): JsonResponse
    {
        $product->load(['category', 'tags']);

        return $this->success(data: ProductResource::make($product));
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

        // TODO: use APi Response
        // return $this->success(data: ProductResource::make($product));

        return response()->json([
            'alert' => __('messages.product_soft_deleted'),
        ]);

    }

    public function restore(Product $product) // TODO: use binding model
    {
        $product->restore();

        return response()->json(['message' => __('messages.product_restored')]);
    }

    public function forceDelete(Product $product): JsonResponse // TODO: use binding model
    {
        $product->forceDelete();

        return $this->success(new ProductResource($product), __('messages.product_deleted'));
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $data = $request->validated();
        /** @var Product $product */
        $product = Product::create($request->safe()->except(['tag_ids', 'image']));
        $product->syncTags($request->tag_ids);
        if ($request->hasFile(Product::MEDIA_COLLECTION_IMAGES)) {
            $product->addMedia($request->file(Product::MEDIA_COLLECTION_IMAGES))->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
        }

        return $this->success(ProductResource::make($product), __('messages.product_stored'));
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        // TODO: update images
        $product->update($request->safe()->except(['tag_ids', 'image']));
        $product->syncTags($request->tag_ids);

        return $this->success(ProductResource::make($product), __('messages.product_updated'));

    }
}
