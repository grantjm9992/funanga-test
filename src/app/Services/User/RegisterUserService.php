<?php

namespace App\Services\User;

use App\Http\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\Models\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

readonly class RegisterUserService implements RegisterUserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function __invoke(
        string $email,
        string $password,
        string $name
    ): array
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user !== null) {
            throw new UserAlreadyExistsException();
        }

        $user = User::create([
            'email' => $email,
            'password' => Hash::make($password),
            'name' => $name,
        ]);

        $token = Auth::login($user);

        return [
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ];
    }
}
