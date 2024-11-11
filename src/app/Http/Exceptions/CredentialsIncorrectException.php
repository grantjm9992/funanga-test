<?php

namespace App\Http\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CredentialsIncorrectException extends HttpException
{
    public function __construct(
    ) {
        parent::__construct(
            statusCode: 404,
            message: 'User or email not found',
            code: 404
        );
    }
}
