<?php

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use App\Models\Token;
use Exception;
use App\Models\User;
use Flugg\Responder\Exceptions\Http\PageNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use League\Flysystem\Config;

class LoginAction extends BaseAction
{

    /**
     * @param $credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($credentials): JsonResponse
    {
        $user = User::where('email', $credentials['username'])->first();

        try {
            $tokenFinded = Token::where('device_token', $credentials['divice_token'])->first();

            if($tokenFinded === null) {
                $token = Token::updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'device_token' => $credentials['divice_token'],
                    ]
                );
            }
            else {
                $token = Token::updateOrCreate(
                    [
                        'device_token' => $credentials['divice_token'],
                    ],
                    [
                        'user_id' => $user->id,
                    ]);
            }
            if($user->is_shipper == 1) {
                $token->is_shipper = 1;
                $token->save();
            }
        }
        catch (Exception $exception) {}

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
            'expires_in'   => JWTAuth::factory()->getTTL() * 90000000000000000,
        ]);
    }

    /**
     * @param $credentials
     * @return array
     */
    protected function credentials($credentials): array
    {
        if($credentials['username'] === 'admin' && $credentials['password'] === '123456') {
            return ['name' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
        }
        if (filter_var(Arr::get($credentials, 'username'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
        }
        return ['phone' => Arr::get($credentials, 'username'), 'password' => Arr::get($credentials, 'password')];
    }
}
