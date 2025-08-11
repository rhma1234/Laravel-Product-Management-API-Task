<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen" dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">
    <div class="container mt-5 text-center">
        
        <a href="<?php echo e(route('lang.switch', 'ar')); ?>" class="text-sm text-blue-600 hover:underline px-2">عربي</a> |
        <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="text-sm text-blue-600 hover:underline px-2">English</a>
    </div>

    <div class="w-full max-w-md bg-white p-8 mt-6 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">
              <?php echo e(__('messages.login_title')); ?>

        </h2>

        <?php if($errors->any()): ?>
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                <ul class="list-disc pr-5 space-y-1 text-right">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    <?php echo e(__('messages.email')); ?>

                </label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    <?php echo e(__('messages.password')); ?>

                </label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-medium">
                    <?php echo e(__('messages.login')); ?>

                </button>
            </div>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            <?php echo e(__('messages.no_account')); ?>

            <a href="<?php echo e(route('register')); ?>" class="text-blue-600 hover:underline font-medium">
                <?php echo e(__('messages.register_here')); ?>

            </a>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\task\resources\views/auth/login.blade.php ENDPATH**/ ?>