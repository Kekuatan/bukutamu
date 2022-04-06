<?php

namespace App\Services\Passport;

use App\Models\Passport\Client;

class PassportService
{
    public static function getClient(): Client
    {
        return Client::where('personal_access_client', false)
            ->where('revoked', false)
            ->firstOrFail();
    }
}
