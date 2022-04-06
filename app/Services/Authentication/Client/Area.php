<?php

namespace App\Services\Authentication\Client;

use App\Services\BukukuPersonals\ClientBankBca\AuthSingleton;
use Illuminate\Support\Facades\Http;

class Area
{
    private static $instances;
    protected $tokenType;
    protected $accessToken;
    protected $expireIn;

    public static function getInstance(): Area
    {
        if (!isset(self::$instances)) {
            self::$instances = new static();
        }

        return self::$instances;
    }

    public function requestToken()
    {

        $baseUri = 'http://bank-bca.test/';
        $clientId = '95cac743-b424-40e9-8154-6842f5b4af3c';
        $clientSecret = '0ljshfTMsDLox8f4SXFkvMAsNucl1NV4eyZwxieT';

        $response = Http::asForm()->post($baseUri . '/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => '*',
        ]);

        if ($response->ok()) {
            $this->tokenType = $response->json()['token_type'];
            $this->accessToken = $response->json()['access_token'];
            $this->expireIn = $response->json()['expires_in'];

            return $this;
        }
        throw new \Exception("Tidak terhubung ke server");
    }

    public function getToken()
    {
        return $this->accessToken;
    }

    public function getTokenType()
    {
        return $this->tokenType;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getExpireIn()
    {
        return $this->expireIn;
    }
}



