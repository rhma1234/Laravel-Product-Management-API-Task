@extends('layouts.layout')

@section('content')
    <h1 class="mb-4">{{ $title ?? __('messages.add_new_product') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- زرار الرجوع للصفحة الرئيسية -->
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">{{ __('messages.back_to_home') }}</a>

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <!-- الاسم بالعربي -->
        <div class="mb-3">
            <label for="name_ar" class="form-label">{{ __('messages.name_ar') }}</label>
            <input type="text" name="name[ar]" id="name_ar" class="form-control"
                   value="{{ old('name.ar', isset($product) ? $product->name : '') }}">
            @error('name.ar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- الاسم بالإنجليزي -->
        <div class="mb-3">
            <label for="name_en" class="form-label">{{ __('messages.name_en') }}</label>
            <input type="text" name="name[en]" id="name_en" class="form-control"
                   value="{{ old('name.en', isset($product) ? $product->name : '') }}">
            @error('name.en')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- الوصف بالعربي -->
        <div class="mb-3">
            <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
            <textarea name="description[ar]" id="description_ar" class="form-control" rows="3">{{ old('description.ar', isset($product) ? $product->description : '') }}</textarea>
            @error('description.ar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- الوصف بالإنجليزي -->
        <div class="mb-3">
            <label for="description_en" class="form-label">{{ __('messages.description_en') }}</label>
            <textarea name="description[en]" id="description_en" class="form-control" rows="3">{{ old('description.en', isset($product) ? $product->description : '') }}</textarea>
            @error('description.en')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- السعر -->
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('messages.price') }}</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01"
                   value="{{ old('price', isset($product) ? $product->price : '') }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- العملة -->
        <div class="mb-3">
            <label for="currency" class="form-label">{{ __('messages.currency') }}</label>
            <select name="currency" id="currency" class="form-select select2">
                <option value="">{{ __('messages.select_currency') }}</option>
           @foreach ($currencies as $currency)
                    <option value="{{ $currency->value }}" {{ old('currency', isset($product) ? $product->currency->value : '') == $currency->value ? 'selected' : '' }}>
                        {{ $currency->name }}
                    </option>
                @endforeach
            </select>
            @error('currency')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- الحالة -->
        <div class="mb-3">
            <label for="status" class="form-label">{{ __('messages.status') }}</label>
            <select name="status" id="status" class="form-select select2">
                <option value="">{{ __('messages.select_status') }}</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" {{ old('status', isset($product) ? $product->status->value : '') == $status->value ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- القسم -->
        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('messages.category') }}</label>
            <select name="category_id" id="category_id" class="form-select select2">
                <option value="">{{ __('messages.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', isset($product) ? $product->category_id : '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name['ar'] ?? $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- العلامات -->
        <div class="mb-3">
            <label for="tag_ids" class="form-label">{{ __('messages.tags') }}</label>
            <select name="tag_ids[]" id="tag_ids" class="form-select select2" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ isset($product) && in_array($tag->id, old('tag_ids', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
            @error('tag_ids')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- صور المنتج -->
        <div class="mb-3">
            <label for="images" class="form-label">{{ isset($product) ? __('messages.update_images') : __('messages.image') }}</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            @error('images')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn {{ isset($product) ? 'btn-success' : 'btn-primary' }}">{{ isset($product) ? __('messages.submit_update') : __('messages.submit_create') }}</button>
    </form>
@endsection