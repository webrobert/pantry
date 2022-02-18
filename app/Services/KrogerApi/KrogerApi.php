<?php

namespace App\Services\KrogerApi;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class KrogerApi
{
    protected $url = 'https://api.kroger.com/v1';
    protected $endpoint;
    protected $scope;

    protected function get($params = [], $method = 'get')
    {
        $token = $this->token();

        return Http::withToken($token)
            ->$method( $this->url . $this->endpoint , $params)
            ->collect();
    }

    protected function token()
    {
        if (Cache::has('krogerToken')) return Cache::get('krogerToken');

        $response = Http::asForm()
            ->withHeaders($this->authHeader())
            ->post("{$this->url}/connect/oauth2/token", [
                'grant_type' => 'client_credentials',
                'scope' => $this->scope
            ])
            ->collect();

        throw_unless($response->has('access_token'),
            "Kroger did not return a token");

        return Cache::remember('krogerToken',
            1800, fn () => $response['access_token']);
    }

    private function authHeader()
    {
        return ['Authorization' => "Basic " . base64_encode(
            implode(':', config('services.kroger')))];
    }

}
