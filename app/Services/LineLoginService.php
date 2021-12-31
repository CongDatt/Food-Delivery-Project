<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

class LineLoginService
{

    public function getLoginBaseUrl()
    {
        $currentTime = Carbon::now()->getTimestamp();
        $url = config('line.line_authorize_uri') . '?';
        $url .= 'response_type=code';
        $url .= '&client_id=' . env('LINE_LOGIN_CHANNEL_ID');
        $url .= '&redirect_uri=' . route('login.line.callback');
        $url .= '&state=' . $currentTime;
        $url .= '&scope=openid%20profile%20real_name%20gender%20birthdate%20phone%20address%20email';

        return $url;
    }

    public function getLineToken($code)
    {
        $client = new Client();
        $response = $client->post(config("line.line_token_uri"), [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => route('login.line.callback'),
                'client_id' => env('LINE_LOGIN_CHANNEL_ID'),
                'client_secret' => env('LINE_LOGIN_CHANNEL_SECRET')
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getUserProfile($token)
    {
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $response = $client->get( config('line.line_profile_uri'), [
            'headers' => $headers
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function verifyIDToken($idToken) {
        $client = new Client();
        $response = $client->post(config("line.line_verify_uri"), [
            'form_params' => [
                'id_token' => $idToken,
                'client_id' => env('LINE_LOGIN_CHANNEL_ID'),
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
