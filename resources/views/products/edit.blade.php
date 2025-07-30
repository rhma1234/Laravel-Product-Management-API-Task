<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.update_product') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body dir="rtl">

<div class="container mt-5">
    <h1 class="mb-4">{{ __('messages.edit_product') }}</h1>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name_ar" class="form-label">{{ __('messages.name_ar') }}</label>
            <input type="text" name="name[ar]" id="name_ar" class="form-control"
                   value="{{ old('name.ar', $product->name ) }}">
        </div>

        <div class="mb-3">
            <label for="name_en" class="form-label">{{ __('messages.name_en') }}</label>
            <input type="text" name="name[en]" id="name_en" class="form-control"
                   value="{{ old('name.en', $product->name ) }}">
        </div>

        <div class="mb-3">
            <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
            <textarea name="description[ar]" id="description_ar" class="form-control" rows="3">{{ old('description.ar', $product->description ) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description_en" class="form-label">{{ __('messages.description_en') }}</label>
            <textarea name="description[en]" id="description_en" class="form-control" rows="3">{{ old('description.en', $product->description ) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">{{ __('messages.price') }}</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01"
                   value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label for="currency" class="form-label">{{ __('messages.currency') }}</label>
            <select name="currency" id="currency" class="form-select select2">
                <option value="">{{ __('messages.select_currency') }}</option>
                @foreach (\App\Enums\CurrencyEnum::cases() as $currency)
                    <option value="{{ $currency->value }}" {{ old('currency', $product->currency->value) == $currency->value ? 'selected' : '' }}>
                        {{ $currency->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">{{ __('messages.status') }}</label>
          <select name="status" id="status" class="form-select select2">
    <option value="">{{ __('messages.select_status') }}</option>
    @foreach ($statuses as $status)
        <option value="{{ $status->value }}" {{ old('status', $product->status->value) == $status->value ? 'selected' : '' }}>
            {{ $status->value }}
        </option>
    @endforeach
</select>

        </div>







{{-- <select name="status" id="status" class="form-select select2">
                <option value="">{{ __('messages.select_status') }}</option>
                <option value="active" {{ old('status', $product->status->value) == 'active' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                <option value="inactive" {{ old('status', $product->status->value) == 'inactive' ? 'selected' : '' }}>{{ __('messages.inactive') }}</option>
            </select> --}}











        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('messages.category') }}</label>
            <select name="category_id" id="category_id" class="form-select select2">
                <option value="">{{ __('messages.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name  }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tag_ids" class="form-label">{{ __('messages.tags') }}</label>
            <select name="tag_ids[]" id="tag_ids" class="form-select select2" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tag_ids', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $tag->name  }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">{{ __('messages.update_images') }}</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.submit_update') }}</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{ __('messages.select') }}",
            width: '100%',
            dir: "rtl"
        });
    });
</script>

</body>
</html>
