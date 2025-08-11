<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container mt-5 text-center">
        {{-- زرار تغيير اللغة --}}
        <a href="{{ route('lang.switch', 'ar') }}" class="text-sm text-blue-600 hover:underline px-2">عربي</a> |
        <a href="{{ route('lang.switch', 'en') }}" class="text-sm text-blue-600 hover:underline px-2">English</a>
    </div>

    <div class="w-full max-w-md bg-white p-8 mt-6 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">
              {{ __('messages.login_title') }}
        </h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                <ul class="list-disc pr-5 space-y-1 text-right">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    {{ __('messages.email') }}
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    {{ __('messages.password') }}
                </label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-medium">
                    {{ __('messages.login') }}
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            {{ __('messages.no_account') }}
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                {{ __('messages.register_here') }}
            </a>
        </p>
    </div>
</body>
</html>
