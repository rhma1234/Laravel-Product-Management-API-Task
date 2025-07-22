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
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'status',
                'category_id',
                AllowedFilter::exact('tag_id', 'tags.id'),
            ])
            ->get();
        $products->load(['tags', 'category']);

        return $this->success(data: ProductResource::collection($products));
    }

    public function show(Product $product): JsonResponse
    {
        $product->load(['category', 'tags']);

        return $this->success(data: ProductResource::make($product));
    }

    public function destroy(Product $product): JsonResponse
    {
        // TODO: use Policy
        $userId = Auth::user()->id;
        if ($product->user_id !== $userId) {
            return response()->json([
                'message' => 'You are not authorized to update this product.',
            ]);
        }
        $product->delete();

        return $this->success(ProductResource::make($product));

    }

    public function restore(Product $productWithTrashed)
    {
        $productWithTrashed->restore();

        return $this->success(ProductResource::make($productWithTrashed));
    }

    public function forceDelete(Product $productWithTrashed): JsonResponse
    {
        $productWithTrashed->forceDelete();

        return $this->success(ProductResource::make($productWithTrashed), __('messages.product_deleted'));
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $data = $request->validated();
        /** @var Product $product */
        // TODO: isolate this logic to Action
        $product = Product::create($request->safe()->except(['tag_ids', 'image']));
        $product->syncTags($request->tag_ids);
        if ($request->hasFile(Product::MEDIA_COLLECTION_IMAGES)) {
            $product->addMedia($request->file(Product::MEDIA_COLLECTION_IMAGES))->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);
        }

        return $this->success(message: __('messages.product_stored'));
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        // TODO: update images
        $product->update($request->safe()->except(['tag_ids', 'image']));
        // TODO: isolate it to Action
        $product->syncTags($request->tag_ids);

        if ($request->hasFile(Product::MEDIA_COLLECTION_IMAGES)) {
            $product->clearMediaCollection(Product::MEDIA_COLLECTION_IMAGES);

            $product->addMediaFromRequest(Product::MEDIA_COLLECTION_IMAGES)
                ->toMediaCollection(Product::MEDIA_COLLECTION_IMAGES);

        }

        return $this->success(message: __('messages.product_updated'));

    }
}
