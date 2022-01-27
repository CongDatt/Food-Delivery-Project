<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use Flugg\Responder\Exceptions\Http\PageNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use League\Flysystem\Config;

class MerchantLoginAction extends BaseAction
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
        if ( !$token = auth('merchants')->attempt($this->credentials($credentials))) {
            return $this->error('unauthenticated')->respond(JsonResponse::HTTP_UNAUTHORIZED);
        }
        else {
            return $this->generateToken($token);
        }

//         if (optional(auth()->user()->roles)->first()->name === Arr::get($credentials, 'guard')) {
//             return $this->generateToken($token);
//         }
//                throw new PageNotFoundException();
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
        if (filter_var(Arr::get($credentials, 'username'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
        }
        if (Arr::get($credentials, 'guard') === RoleType::ADMIN) {
            return ['name' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
        }

        return ['phone' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
    }
}
