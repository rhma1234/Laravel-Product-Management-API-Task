<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return $this->success($user, __('messages.register'));
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return $this->error(__('messages.login_error'), Response::HTTP_UNAUTHORIZED);
        }
        $user = User::whereEmail($request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success($token, __('messages.logged_in'));
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(__('messages.logged_out'));
    }
}
