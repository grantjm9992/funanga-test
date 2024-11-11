<?php

namespace App\Services\User;

use App\Http\Exceptions\CredentialsIncorrectException;
use Illuminate\Support\Facades\Auth;

class LoginUserService implements LoginUserServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws CredentialsIncorrectException
     */
    public function __invoke(string $email, string $password): array
    {
        $token = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);

        if (!$token) {
            throw new CredentialsIncorrectException();
        }

        $user = Auth::user()->toArray();

        return [
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ];
    }
}
