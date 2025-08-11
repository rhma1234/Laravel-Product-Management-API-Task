<?php echo $__env->make('products.form', [
    'title' => __('messages.edit_product'),
    'action' => route('products.update', $product),
    'product' => $product,
    'categories' => $categories,
    'tags' => $tags,
    'statuses' => $statuses
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\task\resources\views/products/edit.blade.php ENDPATH**/ ?>