<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Str;

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
    public function report(Throwable $exception)
    {
        $statusCode = 500;
        $error = true;
        $message = null;
        $uuid = Str::uuid();

        if ($exception instanceof AuthorizationException) {
            $statusCode = 403;
            $message = 'not authorized';
        }
        if ($exception instanceof \Exception) {
            $statusCode = 400;
            $message = $exception->getMessage() ?? 'error exception';
        }

        dd($statusCode,$uuid, $error, $exception->getMessage(), $message);
    
        parent::report($exception);
    }
}
