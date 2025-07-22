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

        return response()->json(ProductResource::collection($products));
    }

    public function show(Product $product): JsonResponse
    {
        $product->load(['category', 'tags']);

        return $this->success(data: ProductResource::make($product));
    }

    public function destroy(Product $product): JsonResponse
    {

        $userId = Auth::user()->id;
        if ($product->user_id !== $userId) {
            return response()->json([
                'message' => 'You are not authorized to update this product.',
            ]);
        }
        $product->delete();

        return $this->success(ProductResource::make($product));

    }

    // public function restore(Product $product)
    // {
    //     $product->restore();

    //     return $this->success(ProductResource::make($product) ) ;
    // }

    public function forceDelete(Product $productWithTrashed): JsonResponse
    {
        $productWithTrashed->forceDelete();

        return $this->success(ProductResource::make($productWithTrashed), __('messages.product_deleted'));
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
        if ($request->hasFile('image')) {
            $product->clearMediaCollection('image');
            $product->addMediaFromRequest('image')->toMediaCollection('image');

            return $this->success(ProductResource::make($product), __('messages.product_updated'));

        }
    }
}
