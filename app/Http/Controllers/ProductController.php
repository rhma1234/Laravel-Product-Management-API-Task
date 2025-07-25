<?php

namespace App\Http\Controllers;

use App\Actions\StoreProductAction;
use App\Actions\UpdateProductAction;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\View\View;
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

    public function index(): View
    {
        // TODO: what is the difference between all pagination methods?

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'status',
                'category_id',
                AllowedFilter::exact('tag_id', 'tags.id'),
                AllowedFilter::operator('price', FilterOperator::DYNAMIC),
            ])->paginate(10);

        $products->load(['tags', 'category']);

        return view('products.index');
    }

    public function edit(Product $product): View
    {
        $product->load(['category', 'tags', 'media']);

        return $this->success(data: ProductResource::make($product));
    }

    public function destroy(Product $product): View
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
