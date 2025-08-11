<div class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <!-- لينكات تغيير اللغة -->
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="<?php echo e(route('lang.switch', 'ar')); ?>">عربي</a>
            <a class="nav-link" href="<?php echo e(route('lang.switch', 'en')); ?>">English</a>
        </div>

        <!-- زرار اللوج آوت -->
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-secondary"><?php echo e(__('messages.logout')); ?></button>
        </form>
    </div>
</div><?php /**PATH C:\laragon\www\task\resources\views/products/navbar.blade.php ENDPATH**/ ?>