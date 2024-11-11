<?php

namespace App\Http\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserAlreadyExistsException extends HttpException
{
    public function __construct(
    ) {
        parent::__construct(
            statusCode: 429,
            message: 'User already exists',
            code: 429
        );
    }
}
