<?php

namespace App\Http\Controllers\API;

use App\Actions\Auth\RedirectProviderAction;
use App\Enums\Socials;
use Illuminate\Http\JsonResponse;

class SocialLoginController extends ApiController
{
    /**
     * @param $driver
     * @param \App\Actions\Auth\RedirectProviderAction $action
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToSocial($driver, RedirectProviderAction $action)
    {
        if (! $this->checkIsValidDriver($driver)) {
            return $this->error()
                        ->data(['message' => 'Social not supported!'])
                        ->respond(JsonResponse::HTTP_BAD_REQUEST);
        }

        return ($action)($driver);
    }

    /**
     * @param $driver
     * @return bool
     */
    public static function checkIsValidDriver($driver): bool
    {
        return in_array($driver, Socials::asArray());
    }
}
