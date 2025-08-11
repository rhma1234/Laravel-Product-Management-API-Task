

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4"><?php echo e($title ?? __('messages.add_new_product')); ?></h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- زرار الرجوع للصفحة الرئيسية -->
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary mb-3"><?php echo e(__('messages.back_to_home')); ?></a>

    <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php if(isset($product)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <!-- الاسم بالعربي -->
        <div class="mb-3">
            <label for="name_ar" class="form-label"><?php echo e(__('messages.name_ar')); ?></label>
            <input type="text" name="name[ar]" id="name_ar" class="form-control"
                   value="<?php echo e(old('name.ar', isset($product) ? $product->name : '')); ?>">
            <?php $__errorArgs = ['name.ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- الاسم بالإنجليزي -->
        <div class="mb-3">
            <label for="name_en" class="form-label"><?php echo e(__('messages.name_en')); ?></label>
            <input type="text" name="name[en]" id="name_en" class="form-control"
                   value="<?php echo e(old('name.en', isset($product) ? $product->name : '')); ?>">
            <?php $__errorArgs = ['name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- الوصف بالعربي -->
        <div class="mb-3">
            <label for="description_ar" class="form-label"><?php echo e(__('messages.description_ar')); ?></label>
            <textarea name="description[ar]" id="description_ar" class="form-control" rows="3"><?php echo e(old('description.ar', isset($product) ? $product->description : '')); ?></textarea>
            <?php $__errorArgs = ['description.ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- الوصف بالإنجليزي -->
        <div class="mb-3">
            <label for="description_en" class="form-label"><?php echo e(__('messages.description_en')); ?></label>
            <textarea name="description[en]" id="description_en" class="form-control" rows="3"><?php echo e(old('description.en', isset($product) ? $product->description : '')); ?></textarea>
            <?php $__errorArgs = ['description.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- السعر -->
        <div class="mb-3">
            <label for="price" class="form-label"><?php echo e(__('messages.price')); ?></label>
            <input type="number" name="price" id="price" class="form-control" step="0.01"
                   value="<?php echo e(old('price', isset($product) ? $product->price : '')); ?>">
            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- العملة -->
        <div class="mb-3">
            <label for="currency" class="form-label"><?php echo e(__('messages.currency')); ?></label>
            <select name="currency" id="currency" class="form-select select2">
                <option value=""><?php echo e(__('messages.select_currency')); ?></option>
           <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($currency->value); ?>" <?php echo e(old('currency', isset($product) ? $product->currency->value : '') == $currency->value ? 'selected' : ''); ?>>
                        <?php echo e($currency->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- الحالة -->
        <div class="mb-3">
            <label for="status" class="form-label"><?php echo e(__('messages.status')); ?></label>
            <select name="status" id="status" class="form-select select2">
                <option value=""><?php echo e(__('messages.select_status')); ?></option>
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status->value); ?>" <?php echo e(old('status', isset($product) ? $product->status->value : '') == $status->value ? 'selected' : ''); ?>>
                        <?php echo e($status->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- القسم -->
        <div class="mb-3">
            <label for="category_id" class="form-label"><?php echo e(__('messages.category')); ?></label>
            <select name="category_id" id="category_id" class="form-select select2">
                <option value=""><?php echo e(__('messages.select_category')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', isset($product) ? $product->category_id : '') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name['ar'] ?? $category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- العلامات -->
        <div class="mb-3">
            <label for="tag_ids" class="form-label"><?php echo e(__('messages.tags')); ?></label>
            <select name="tag_ids[]" id="tag_ids" class="form-select select2" multiple>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tag->id); ?>" <?php echo e(isset($product) && in_array($tag->id, old('tag_ids', $product->tags->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                        <?php echo e($tag->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['tag_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- صور المنتج -->
        <div class="mb-3">
            <label for="images" class="form-label"><?php echo e(isset($product) ? __('messages.update_images') : __('messages.image')); ?></label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn <?php echo e(isset($product) ? 'btn-success' : 'btn-primary'); ?>"><?php echo e(isset($product) ? __('messages.submit_update') : __('messages.submit_create')); ?></button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\task\resources\views/products/form.blade.php ENDPATH**/ ?>