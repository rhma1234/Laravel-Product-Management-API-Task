<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo app('translator')->get('messages.product_list'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">

<div class="container mt-5">

    <h1 class="mb-4"><?php echo e(__('messages.product_list')); ?></h1>

    
    <a href="<?php echo e(route('lang.switch', 'ar')); ?>">عربي</a> |
    <a href="<?php echo e(route('lang.switch', 'en')); ?>">English</a>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        
        <button type="submit" class="btn btn-secondary mb-3"><?php echo e(__('messages.logout')); ?></button>
    </form>

    
    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary mb-3"><?php echo e(__('messages.add_new_product')); ?></a>

    
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th><?php echo e(__('messages.name')); ?></th>
                <th><?php echo e(__('messages.description')); ?></th>
                <th><?php echo e(__('messages.price')); ?></th>
                <th><?php echo e(__('messages.currency')); ?></th>
                <th><?php echo e(__('messages.status')); ?></th>
                <th><?php echo e(__('messages.category')); ?></th>
                <th><?php echo e(__('messages.tags')); ?></th>
                <th><?php echo e(__('messages.image')); ?></th>
                <th><?php echo e(__('messages.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="<?php echo e($product->trashed() ? 'table-danger' : ''); ?>">
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->description); ?></td>
                    <td><?php echo e($product->price); ?></td>
                    <td><?php echo e($product->currency); ?></td>
                    <td><?php echo e($product->status); ?></td>
                   <td><?php echo e($product->category?->name); ?></td>
                    <td>
                        <?php $__currentLoopData = $product->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-info text-dark">
                                <?php echo e($tag->name); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $product->getMedia('images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e($media->getUrl()); ?>" alt="<?php echo e(__('messages.image')); ?>" width="60" height="60" class="rounded mb-1">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php if($product->trashed()): ?>
                            <form action="<?php echo e(route('products.restore', $product->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-warning btn-sm"><?php echo e(__('messages.restore')); ?></button>
                            </form>

                            <form action="<?php echo e(route('products.forceDelete', $product->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo e(__('messages.confirm_force_delete')); ?>')">
                                    <?php echo e(__('messages.force_delete')); ?>

                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-success btn-sm"><?php echo e(__('messages.edit')); ?></a>

                            <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm"><?php echo e(__('messages.delete')); ?></button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9"><?php echo e(__('messages.no_products')); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    
    <?php echo e($products->links()); ?>

</div>

</body>
</html>
<?php /**PATH C:\laragon\www\task\resources\views/products/index.blade.php ENDPATH**/ ?>