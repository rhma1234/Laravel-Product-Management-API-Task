@include('products.form', [
    'title' => __('messages.add_new_product'),
    'action' => route('products.store'),
    'categories' => $categories,
    'tags' => $tags,
    'statuses' => $statuses
])