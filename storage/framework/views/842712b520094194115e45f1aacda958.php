<h1>  you are logged in </h1>
<form method="POST" action="<?php echo e(route('logout')); ?>">
    <?php echo csrf_field(); ?>
    <button type="submit">تسجيل الخروج</button>
</form>
<?php /**PATH C:\laragon\www\task\resources\views/products/index.blade.php ENDPATH**/ ?>