<?php

namespace App\Exceptions;

use App\Traits\HandleErrorException;
use Flugg\Responder\Exceptions\Http\PageNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    use HandleErrorException;
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param \Throwable $e
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function render($request, Throwable $e): \Illuminate\Http\JsonResponse
    {
        switch (true) {
            case $e instanceof ValidationException:
                return $this->validationError($e);
            case $e instanceof UnauthorizedException:
            case $e instanceof AuthenticationException:
            case $e instanceof AuthorizationException:
                return $this->unauthorized();
            case $e instanceof DeleteRoleDefaulException:
            case $e instanceof TokenInvalidException:
                return $this->forbidden();
            case $e instanceof NotFoundHttpException:
            case $e instanceof ModelNotFoundException:
            case $e instanceof PageNotFoundException:
                return $this->notFound();
            default:
                return $this->serverError($e->getMessage());
        }
    }
}
