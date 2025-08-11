@include('products.form', [
    'title' => __('messages.edit_product'),
    'action' => route('products.update', $product),
    'product' => $product,
    'categories' => $categories,
    'tags' => $tags,
    'statuses' => $statuses
])