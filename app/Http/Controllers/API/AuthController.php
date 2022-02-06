<?php

namespace App\Http\Controllers\API;

use App\Actions\Auth\AdminLoginAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginSocialAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RefreshTokenAction;
use App\Actions\Auth\RegisterUserAction;
use App\Actions\Auth\ShowProfileAction;
use App\Actions\Merchant\ShowListMerchantAction;
use App\Http\Requests\Auth\CheckLoginRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends ApiController
{
    public function index(ShowListMerchantAction $action):JsonResponse
    {
        return ($action)();
    }

    /**
     * @param RegisterUserRequest $request
     * @param RegisterUserAction $action
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request, RegisterUserAction $action): JsonResponse
    {
        return ($action)($request->validated());
    }

    /**
     * @param \App\Http\Requests\Auth\CheckLoginRequest $request
     * @param LoginAction $action
     *
     * @return JsonResponse
     */
    public function login(CheckLoginRequest $request, LoginAction $action): JsonResponse
    {
        return ($action)($request->validated());
    }

    /**
     * @param $driver
     * @param \App\Actions\Auth\LoginSocialAction $action
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function socialLogin($driver, LoginSocialAction $action): JsonResponse
    {
        if (! SocialLoginController::checkIsValidDriver($driver)) {
            return $this->error()
                        ->data(['message' => 'Social not supported!'])
                        ->respond(JsonResponse::HTTP_BAD_REQUEST);
        }

        return ($action)($driver);
    }

    /**
     * @param LogoutAction $action
     *
     * @return JsonResponse
     */
    public function logout(LogoutAction $action): JsonResponse
    {
        return ($action)();
    }

    public function refresh(RefreshTokenAction $action): JsonResponse
    {
        return ($action)();
    }

    /**
     * @param ShowProfileAction $action
     *
     * @return JsonResponse
     */
    public function me(ShowProfileAction $action): JsonResponse
    {
        return ($action)();
    }
}
