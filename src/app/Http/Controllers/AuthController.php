<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\CredentialsIncorrectException;
use App\Http\Exceptions\UserAlreadyExistsException;
use App\Services\User\LoginUserServiceInterface;
use App\Services\User\RegisterUserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

readonly class AuthController
{
    public function __construct(
        private RegisterUserServiceInterface $registerUserService,
        private LoginUserServiceInterface $loginUserService,
    ) {
    }

    /**
     * @param Request $request - email and password both required
     * @return JsonResponse
     * @throws CredentialsIncorrectException when user provides incorrect password or email
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $response = $this->loginUserService->__invoke(
            email: $request->get('email'),
            password: $request->get('password'),
        );

        return response()->json($response);
    }

    /**
     * @param Request $request - email and password both required
     * @throws UserAlreadyExistsException when user email is already taken
     * @return JsonResponse
     * Requires email and password to be passed via request body to register bew
     */
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
