<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (TokenInvalidException $exception, $request) {
            return $this->sendResponse($exception->getMessage());
        });

        $this->renderable(function (TokenExpiredException $exception, $request) {
            return $this->sendResponse($exception->getMessage());
        });

        $this->renderable(function (JWTException $exception, $request) {
            return $this->sendResponse($exception->getMessage());
        });
    }

    private function sendResponse($message, $status = 500)
    {
        $response = [
            'metadata' => [
                'status' => $status,
                'message' => $message,
            ],
        ];

        return response()->json($response, $status);
    }
}
