<?php

namespace App\Http\Controllers;

use App\Services\User\RegisterUserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

readonly class AuthController
{
    public function __construct(
        private RegisterUserServiceInterface $registerUserService
    ) {
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'User or email incorrect',
            ], 401);
        }

        $user = Auth::user()->toArray();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $response = $this->registerUserService->__invoke(
            $request->get('email'),
            $request->get('password'),
            $request->get('name', 'TestUser'),
        );

        return response()->json($response);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
