<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(__('messages.register_title')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

    
    <div class="mb-4 text-center">
        <a href="<?php echo e(route('lang.switch', 'ar')); ?>" class="text-sm text-blue-600 hover:underline px-2">عربي</a> |
        <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="text-sm text-blue-600 hover:underline px-2">English</a>
    </div>

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600"><?php echo e(__('messages.register_title')); ?></h1>

        <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700"><?php echo e(__('messages.name')); ?></label>
                <input type="text" name="name" id="name"
                    value="<?php echo e(old('name')); ?>"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700"><?php echo e(__('messages.email')); ?></label>
                <input type="email" name="email" id="email"
                    value="<?php echo e(old('email')); ?>"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700"><?php echo e(__('messages.password')); ?></label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700"><?php echo e(__('messages.password_confirmation')); ?></label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                    <?php echo e(__('messages.register')); ?>

                </button>
            </div>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            <?php echo e(__('messages.already_have_account')); ?>

            <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline">
                <?php echo e(__('messages.login_here')); ?>

            </a>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\task\resources\views/auth/register.blade.php ENDPATH**/ ?>