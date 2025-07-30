<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\StoreProductAction;
use App\Actions\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
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
        // TODO: what is the difference between all pagination methods?
        // TODO: fix this pagination
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'status',
                'category_id',
                AllowedFilter::exact('tag_id', 'tags.id'),
                AllowedFilter::operator('price', FilterOperator::DYNAMIC),
            ])->paginate(3);

        $products->load(['tags', 'category']);
        $products = ProductResource::collection($products);

        return $this->success($products);
    }

    public function edit(Product $product): JsonResponse
    {
        $product->load(['category', 'tags', 'media']);

        return $this->success(data: ProductResource::make($product));
    }

    public function destroy(Product $product): JsonResponse
    {

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
        UpdateProductAction::make()->handle($request->validated(), $product);

        return $this->success(message: __('messages.product_updated'));
    }
}
