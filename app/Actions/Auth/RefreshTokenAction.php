<?php

namespace App\Actions\Auth;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class RefreshTokenAction
{
    use HttpResponse;

    protected $loginAction;
    public function __construct(LoginAction $loginAction) {
        $this->loginAction = $loginAction;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $token = Auth::guard('api')->refresh();

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string|null $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token = null): JsonResponse {
        if (! $token) {
            return $this->error('unauthenticated')->respond(JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->loginAction->generateToken($token);
    }
}
