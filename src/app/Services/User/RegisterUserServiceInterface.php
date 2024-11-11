<?php

namespace App\Services\User;

interface RegisterUserServiceInterface
{
    public function __invoke(
        string $email,
        string $password,
        string $name
    ): array;
}
