<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(__('messages.update_product')); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body dir="rtl">

<div class="container mt-5">
    <h1 class="mb-4"><?php echo e(__('messages.edit_product')); ?></h1>

    <form action="<?php echo e(route('products.update', $product)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="name_ar" class="form-label"><?php echo e(__('messages.name_ar')); ?></label>
            <input type="text" name="name[ar]" id="name_ar" class="form-control"
                   value="<?php echo e(old('name.ar', $product->name )); ?>">
        </div>

        <div class="mb-3">
            <label for="name_en" class="form-label"><?php echo e(__('messages.name_en')); ?></label>
            <input type="text" name="name[en]" id="name_en" class="form-control"
                   value="<?php echo e(old('name.en', $product->name )); ?>">
        </div>

        <div class="mb-3">
            <label for="description_ar" class="form-label"><?php echo e(__('messages.description_ar')); ?></label>
            <textarea name="description[ar]" id="description_ar" class="form-control" rows="3"><?php echo e(old('description.ar', $product->description )); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="description_en" class="form-label"><?php echo e(__('messages.description_en')); ?></label>
            <textarea name="description[en]" id="description_en" class="form-control" rows="3"><?php echo e(old('description.en', $product->description )); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label"><?php echo e(__('messages.price')); ?></label>
            <input type="number" name="price" id="price" class="form-control" step="0.01"
                   value="<?php echo e(old('price', $product->price)); ?>">
        </div>

        <div class="mb-3">
            <label for="currency" class="form-label"><?php echo e(__('messages.currency')); ?></label>
            <select name="currency" id="currency" class="form-select select2">
                <option value=""><?php echo e(__('messages.select_currency')); ?></option>
                <?php $__currentLoopData = \App\Enums\CurrencyEnum::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($currency->value); ?>" <?php echo e(old('currency', $product->currency->value) == $currency->value ? 'selected' : ''); ?>>
                        <?php echo e($currency->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label"><?php echo e(__('messages.status')); ?></label>
          <select name="status" id="status" class="form-select select2">
    <option value=""><?php echo e(__('messages.select_status')); ?></option>
    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($status->value); ?>" <?php echo e(old('status', $product->status->value) == $status->value ? 'selected' : ''); ?>>
            <?php echo e($status->value); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

        </div>



















        <div class="mb-3">
            <label for="category_id" class="form-label"><?php echo e(__('messages.category')); ?></label>
            <select name="category_id" id="category_id" class="form-select select2">
                <option value=""><?php echo e(__('messages.select_category')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tag_ids" class="form-label"><?php echo e(__('messages.tags')); ?></label>
            <select name="tag_ids[]" id="tag_ids" class="form-select select2" multiple>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tag->id); ?>" <?php echo e(in_array($tag->id, old('tag_ids', $product->tags->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                        <?php echo e($tag->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label"><?php echo e(__('messages.update_images')); ?></label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-success"><?php echo e(__('messages.submit_update')); ?></button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "<?php echo e(__('messages.select')); ?>",
            width: '100%',
            dir: "rtl"
        });
    });
</script>

</body>
</html>
<?php /**PATH C:\laragon\www\task\resources\views/products/edit.blade.php ENDPATH**/ ?>