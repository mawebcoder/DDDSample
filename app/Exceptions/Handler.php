<?php

namespace App\Exceptions;

use Codestoon\Domains\BaseException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render(
        $request,
        Throwable $e
    ): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response {

        if ($request->expectsJson() && $e instanceof BaseException) {
            return response()
                ->json([
                    'message' => $e->getMessage(),
                    'code' => $e->getCode()
                ], $e->getCode());
        }

        return parent::render($request, $e);
    }
}
