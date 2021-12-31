<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class VietNamProvincesService
{
    public static function getProvinces(): ?Collection
    {
        return self::baseGetRequest('https://provinces.open-api.vn/api/?depth=3');
    }

    public static function getFromCode(?Collection $collection, $code)
    {
        if (empty($collection)) {
            return null;
        }

        return $collection->where('code', $code)->first();
    }

    public static function getNameFromCode(?Collection $collection, $code)
    {
        if (empty($collection)) {
            return null;
        }

        return $collection->where('code', $code)->pluck('name')->first();
    }

    public static function getChildren(?Collection $collection, $parentCode, $column)
    {
        if (empty($collection)) {
            return null;
        }

        return $collection->where('code', $parentCode)->pluck($column)->first();
    }

    private static function baseGetRequest(string $api): ?Collection
    {
        //if (Cache::has($key)) {
        //    return Cache::get($key);
        //}
        //Cache::put($key, $data, config('app.p3_service_ttl'));

        return self::request($api);
    }

    private static function request($url): ?Collection
    {
        $client = new Client();
        try {
            $response = $client->get($url);

            return collect(json_decode($response->getBody()));
        } catch (\Exception $e) {
            // do nothing
            return null;
        }
    }
}
