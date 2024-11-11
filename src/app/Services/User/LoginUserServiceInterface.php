<?php

namespace App\Services\User;

use App\Http\Exceptions\CredentialsIncorrectException;

interface LoginUserServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws CredentialsIncorrectException
     */
    public function __invoke(string $email, string $password): array;
}
