<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function register(RegisterRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = User::create($request->validated());
        Auth::login($user);

        return redirect()->intended(route('products.index'));
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {

            return redirect()->route('login')->withInput()->withErrors([
                'email' => __('messages.login_error')
            ]);


        }

        $user = User::whereEmail($request->email)->firstOrFail();
        $request->session()->regenerate();

        return redirect()->intended(route('products.index'));

    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function logout(Request $request): RedirectResponse
    {

        Auth::logout();

        return redirect('/login');

    }
}
