<?php

namespace App\Http\Exceptions;


use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are handled.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response|JsonResponse
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response|JsonResponse
    {
        return $this->handleApiException($e);
    }

    /**
     * Handle API exceptions and return a JSON response.
     *
     * @param Throwable $exception
     * @return JsonResponse
     */
    private function handleApiException(Throwable $exception): JsonResponse
    {
        return response()->json(
            data: [
                'status' => 'error',
                'message' => $exception->getMessage(),
            ],
            status: $exception->getStatusCode(),
        );
        if ($exception instanceof UserAlreadyExistsException) {
            return response()->json(
                data: [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                status: $exception->getStatusCode(),
            );
        }

        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred',
        ], 500);
    }
}
