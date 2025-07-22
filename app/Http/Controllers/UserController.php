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

        return response()->json($user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], Response::HTTP_UNAUTHORIZED);

        }

        $user = User::whereEmail($request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        // TODO: fix this response

        return response()->json([
            'message' => 'Login Successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        // TODO: fix this response
        return response()->json([
            'message' => 'Logout Successful',
        ]);
    }
}
