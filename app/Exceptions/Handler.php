<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
//use Spatie\Permission\Exceptions\UnauthorizedException;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e) {

            if ($e instanceof UnauthorizedException) {
                return response(
                    [
                      'success' => false,
                      'message' => 'You do not have required authorization.',
                    ], 403
                  );

            }
            if ($e instanceof ApiException) {
                //Log::info('test');
                return response(
                  [
                    'success' => false,
                    'message' => $e->getMessage(),
                  ], $e->getCode() ?: 400
                );
            }
            if ($e instanceof ValidateException) {
                return response(
                    [
                      'success' => false,
                      'message' => json_decode($e->getMessage()),
                    ], $e->getCode() ?: 400
                );
            }

        });
    }
}
