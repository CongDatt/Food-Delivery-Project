<?php

namespace App\Exceptions;

use App\Enums\ResponseStatus;
use Flugg\Responder\Exceptions\Http\HttpException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DeleteRoleDefaulException extends HttpException
{
    /**
     * An HTTP status code.
     *
     * @var int
     */
    protected $status = ResponseAlias::HTTP_FORBIDDEN;

    /**
     * An error code.
     *
     * @var string|null
     */
    protected $errorCode = ResponseStatus::DO_NOT_DELETE_DEFAULT_ROLE;
}
