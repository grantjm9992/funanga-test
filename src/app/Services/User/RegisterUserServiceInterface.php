<?php

namespace App\Services\User;

use App\Http\Exceptions\UserAlreadyExistsException;

interface RegisterUserServiceInterface
{
    /**
     * @param string $email - Email for user
     * @param string $password - Plain password for user
     * @param string $name - Name of user
     * @throws UserAlreadyExistsException - When email is already taken
     * @return array
     */
    public function __invoke(
        string $email,
        string $password,
        string $name
    ): array;
}
