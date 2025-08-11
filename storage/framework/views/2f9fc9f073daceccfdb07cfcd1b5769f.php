<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($title ?? __('messages.app_name')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">

<!-- Defining the navigation bar -->
<div class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <!-- Brand or logo placeholder -->
        <a class="navbar-brand" href="<?php echo e(route('products.index')); ?>"><?php echo e(__('messages.app_name')); ?></a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Language switch links -->
            <div class="navbar-nav me-auto">
                <a class="nav-link <?php echo e(app()->getLocale() === 'ar' ? 'active' : ''); ?>" href="<?php echo e(route('lang.switch', 'ar')); ?>">عربي</a>
                <a class="nav-link <?php echo e(app()->getLocale() === 'en' ? 'active' : ''); ?>" href="<?php echo e(route('lang.switch', 'en')); ?>">English</a>
            </div>

            <!-- Logout button -->
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-outline-light btn-sm"><?php echo e(__('messages.logout')); ?></button>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "<?php echo e(__('messages.select')); ?>",
            width: '100%',
            dir: "<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>"
        });
    });
</script>

</body>
</html><?php /**PATH C:\laragon\www\task\resources\views/layouts/layout.blade.php ENDPATH**/ ?>