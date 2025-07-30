<?php

namespace App\Http\Controllers;

use App\Actions\StoreProductAction;
use App\Actions\UpdateProductAction;
use App\Enums\ProductStatusEnum;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function create(): View
    {
        // TODO: what is the difference between get and all?
        $categories = Category::get();
        $tags = Tag::all();
        $statuses = ProductStatusEnum::cases();

        return view('products.create', compact('categories', 'tags', 'statuses'));
    }

    public function index(): View
    {

        $products = QueryBuilder::for(Product::query()->withTrashed())
            ->allowedFilters([
                'status',
                'category_id',
                AllowedFilter::exact('tag_id', 'tags.id'),
                AllowedFilter::operator('price', FilterOperator::DYNAMIC),
            ])->paginate(6);

        $products->load(['tags', 'category']);

        return view('products.index', compact('products'));

    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        $product->load(['category', 'tags', 'media']);
        $statuses = ProductStatusEnum::cases();
        return view('products.edit', compact('product', 'categories', 'tags','statuses'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('products.index')->with('success', __('messages.product_soft_deleted'));
    }

    public function restore(Product $productWithTrashed): RedirectResponse
    {
        $productWithTrashed->restore();

        return redirect()->route('products.index')->with('success', __('messages.product_restored'));
    }

    public function forceDelete(Product $productWithTrashed): RedirectResponse
    {
        $productWithTrashed->forceDelete();

        return redirect()->route('products.index')->with('success', __('messages.product_deleted'));

    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        StoreProductAction::make()->handle($request->validated());

        return redirect()->route('products.index')->with('success', __('messages.product_stored'));

    }

    public function update(Product $product, UpdateProductRequest $request): RedirectResponse
    {
        UpdateProductAction::make()->handle($request->validated(), $product);

        return redirect()->route('products.index')->with('success', __('messages.product_updated'));
    }
}
