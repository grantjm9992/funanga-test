<?php

namespace App\Services\Password;

use Illuminate\Support\Facades\Hash;

class PasswordHashService implements PasswordHashServiceInterface
{
    public function hash(string $password): string
    {
        return Hash::make($password);
    }
}
