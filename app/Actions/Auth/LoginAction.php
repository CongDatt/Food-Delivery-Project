<?php

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use Flugg\Responder\Exceptions\Http\PageNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginAction extends BaseAction
{
    /**
     * @param $credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($credentials): JsonResponse
    {
        return $this->execute($credentials);
    }

    /**
     * @param $credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute($credentials): JsonResponse
    {
        if (! $token = JWTAuth::attempt($this->credentials($credentials))) {
            return $this->error('unauthenticated')->respond(JsonResponse::HTTP_UNAUTHORIZED);
        }

        if (optional(auth()->user()->roles)->first()->name === Arr::get($credentials, 'guard')) {
            return $this->generateToken($token);
        }
        throw new PageNotFoundException();
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL(),
        ]);
    }

    /**
     * @param $credentials
     * @return array
     */
    protected function credentials($credentials): array
    {
        if (filter_var(Arr::get($credentials, 'username'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
        }
        if (Arr::get($credentials, 'guard') === RoleType::ADMIN) {
            return ['name' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
        }

        return ['phone' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
    }
}
