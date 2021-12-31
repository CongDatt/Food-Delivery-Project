<?php

namespace App\Actions\Auth;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutAction
{
    use HttpResponse;

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return $this->success()->respond(JsonResponse::HTTP_NO_CONTENT);
    }
}
