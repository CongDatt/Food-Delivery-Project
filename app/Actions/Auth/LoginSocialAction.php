<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginSocialAction extends LoginAction
{
    /**
     * @param $driver
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($driver): JsonResponse
    {
        try {
            $socialUser = Socialite::driver($driver)->stateless()->user();
        } catch (\Exception $e) {
            return $this->error($e->getMessage())->respond(JsonResponse::HTTP_UNAUTHORIZED);
        }

        $existUser = User::query()
                         ->where('name', '<>', 'admin')
                         ->where('provider_id', $socialUser->id)
                         ->where('provider_name', $driver)
                         ->first();

        if ($existUser) {
            $user = $this->updateUser($socialUser, $existUser, $driver);
        } else {
            $user = $this->createUser($socialUser, $driver);
        }

        if ($user) {
            if (! $token = JWTAuth::fromUser($user)) {
                return $this->error('unauthenticated')->respond(JsonResponse::HTTP_UNAUTHORIZED);
            }

            return $this->generateToken($token);
        } else {
            return $this->error('unauthenticated')->respond(JsonResponse::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @param $socialUser
     * @param $driver
     * @return mixed
     */
    public function createUser($socialUser, $driver)
    {
        $data = [
            'name'          => $socialUser->name,
            'avatar'        => $socialUser->avatar,
            'email'         => $socialUser->email ?? null,
            'provider_id'   => $socialUser->id,
            'provider_name' => $driver,
        ];

        return DB::transaction(function () use ($data) {
            return User::create($data);
        });
    }

    /**
     * @param $socialUser
     * @param \App\Models\User $user
     * @param $driver
     * @return false|mixed
     */
    public function updateUser($socialUser, User $user, $driver)
    {
        $data = [
            'name'          => $socialUser->name,
            'avatar'        => $socialUser->avatar,
            'email'         => $socialUser->email ?? null,
            'provider_id'   => $socialUser->id,
            'provider_name' => $driver,
        ];

        return DB::transaction(function () use ($user, $data) {
            $update = $user->update($data);
            if ($update) {
                return $user;
            }

            return false;
        });
    }
}
