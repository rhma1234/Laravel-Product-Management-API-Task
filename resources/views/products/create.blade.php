<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.add_new_product') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<div class="container mt-5">
    <h1 class="mb-4">{{ __('messages.add_new_product') }}</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- الاسم بالعربي -->
        <div class="mb-3">
            <label for="name_ar" class="form-label">{{ __('messages.name_ar') }}</label>
            <input type="text" name="name[ar]" id="name_ar" class="form-control" value="{{ old('name.ar') }}">
        </div>

        <!-- الاسم بالإنجليزي -->
        <div class="mb-3">
            <label for="name_en" class="form-label">{{ __('messages.name_en') }}</label>
            <input type="text" name="name[en]" id="name_en" class="form-control" value="{{ old('name.en') }}">
        </div>

        <!-- الوصف بالعربي -->
        <div class="mb-3">
            <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
            <textarea name="description[ar]" id="description_ar" class="form-control" rows="3">{{ old('description.ar') }}</textarea>
        </div>

        <!-- الوصف بالإنجليزي -->
        <div class="mb-3">
            <label for="description_en" class="form-label">{{ __('messages.description_en') }}</label>
            <textarea name="description[en]" id="description_en" class="form-control" rows="3">{{ old('description.en') }}</textarea>
        </div>

        <!-- السعر -->
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('messages.price') }}</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}">
        </div>

        <!-- العملة -->
        <div class="mb-3">
            <label for="currency" class="form-label">{{ __('messages.currency') }}</label>
            <select name="currency" class="form-select select2">
                <option value="">{{ __('messages.select_currency') }}</option>
                @foreach (\App\Enums\CurrencyEnum::cases() as $currency)
                    <option value="{{ $currency->value }}" {{ old('currency') == $currency->value ? 'selected' : '' }}>
                        {{ $currency->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- الحالة -->
         <div class="mb-3">
            <label for="status" class="form-label">{{ __('messages.status') }}</label>
            <select name="status" id="status" class="form-select select2">
                <option value="">{{ __('messages.select_status') }}</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" {{ old('status') == $status->value ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- القسم -->
        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('messages.category') }}</label>
            <select name="category_id" id="category_id" class="form-select select2">
                <option value="">{{ __('messages.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name['ar'] ?? $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- العلامات -->
        <div class="mb-3">
            <label for="tag_ids" class="form-label">{{ __('messages.tags') }}</label>
            <select name="tag_ids[]" id="tag_ids" class="form-select select2" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tag_ids', [])) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- صور المنتج -->
        <div class="mb-3">
            <label for="images" class="form-label">{{ __('messages.image') }}</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.submit_create')  }}</button>
    </form>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- تفعيل Select2 -->
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{ __('messages.select_placeholder') }}",
            width: '100%',
            dir: "{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
        });
    });
</script>

</body>
</html>
