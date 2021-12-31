<?php

namespace App\Actions\Auth;

use App\Traits\HttpResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectProviderAction
{
    use HttpResponse;

    /**
     * @param $driver
     * @return RedirectResponse
     */
    public function __invoke($driver): RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }
}
