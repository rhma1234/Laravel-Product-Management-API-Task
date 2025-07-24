<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function register(RegisterRequest $request) :RedirectResponse
    {
        /** @var User $user */
        $user = User::create($request->validated());
        Auth::login($user);

        return redirect()->intended(route('products.index'));
    }

    public function login(LoginRequest $request) : RedirectResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            // TODO: redirect response
            return redirect()->intended(route('products.index'));

        }
        $user = User::whereEmail($request->email)->firstOrFail();

        return redirect()->intended(route('products.index'));

    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request) // :view
    {
        // TODO: adding middleware
        auth()->logout();

        return redirect('/login');

    }
}
