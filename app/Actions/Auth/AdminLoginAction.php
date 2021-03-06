<?php

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use Flugg\Responder\Exceptions\Http\PageNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use App\Models\Admin;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use League\Flysystem\Config;

class AdminLoginAction extends BaseAction
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
        if ( !$token = auth('api')->attempt($this->credentials($credentials))) {
            return $this->error('unauthenticated')->respond(JsonResponse::HTTP_UNAUTHORIZED);
        }
        else {
            return $this->generateToken($token);
        }
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
            'expires_in'   => JWTAuth::factory()->getTTL() * 1000,
        ]);
    }

    /**
     * @param $credentials
     * @return array
     */
    protected function credentials($credentials): array
    {
        if($credentials['username'] === 'admin' || $credentials['password'] === '123456') {
            return ['name' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
        }
    }
}
