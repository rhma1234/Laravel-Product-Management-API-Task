@extends('layouts.layout')

@section('content')
    <h1 class="mb-4">{{ __('messages.product_list') }}</h1>

    {{-- رسالة نجاح --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- زر إضافة منتج --}}
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_new_product') }}</a>

    {{-- جدول المنتجات --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.description') }}</th>
                <th>{{ __('messages.price') }}</th>
                <th>{{ __('messages.currency') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.category') }}</th>
                <th>{{ __('messages.tags') }}</th>
                <th>{{ __('messages.image') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="{{ $product->trashed() ? 'table-danger' : '' }}">
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->currency }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->category?->name }}</td>
                    <td>
                        @foreach ($product->tags as $tag)
                            <span class="badge bg-info text-dark">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($product->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="{{ __('messages.image') }}" width="60" height="60" class="rounded mb-1">
                        @endforeach
                    </td>
                    <td>
                        @if ($product->trashed())
                            <form action="{{ route('products.restore', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">{{ __('messages.restore') }}</button>
                            </form>

                            <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('messages.confirm_force_delete') }}')">
                                    {{ __('messages.force_delete') }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-success btn-sm">{{ __('messages.edit') }}</a>

                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">{{ __('messages.no_products') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- روابط الصفحات --}}
    {{ $products->links() }}
@endsection