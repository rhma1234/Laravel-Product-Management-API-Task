<?php

namespace App\Http\Controllers;

use App\Actions\StoreProductAction;
use App\Actions\UpdateProductAction;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
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

    public function index(): JsonResponse
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

    public function edit(Product $product): JsonResponse
    {
        $product->load(['category', 'tags']);

        return $this->success(data: ProductResource::make($product));
    }

    public function destroy(Product $product): JsonResponse
    {
        // TODO: handle custom errors: NotFoundHttpException
        $this->authorize('delete', $product);
        $product->delete();

        return $this->success(message: __('messages.product_soft_deleted'));
    }

    public function restore(Product $productWithTrashed)
    {
        $productWithTrashed->restore();

        return $this->success(message: __('messages.product_restored'));
    }

    public function forceDelete(Product $productWithTrashed): JsonResponse
    {
        $productWithTrashed->forceDelete();

        return $this->success(message: __('messages.product_deleted'));
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        StoreProductAction::make()->handle($request->validated());

        return $this->success(message: __('messages.product_stored'));
    }

    public function update(Product $product, UpdateProductRequest $request): JsonResponse
    {
        UpdateProductAction::make()->handle($product, $request->validated());

        return $this->success(message: __('messages.product_updated'));
    }
}
