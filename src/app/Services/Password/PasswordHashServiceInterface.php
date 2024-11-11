<?php

namespace App\Services\Password;

interface PasswordHashServiceInterface
{
    public function hash(string $password): string;
}
