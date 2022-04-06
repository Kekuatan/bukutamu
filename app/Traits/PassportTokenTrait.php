<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait PassportTokenTrait
{

    public function signUp () {

    }
    private function removeAllTokenAndRefreshToken($user, $except = null)
    {
        if(blank($user->tokens)){
            return false;
        }

        $user->tokens->each(function ($token, $key) {
            $tokenRepository = app('Laravel\Passport\TokenRepository');
            $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');

            $tokenRepository->revokeAccessToken($token->id);
            $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);
        });

//        if ($except != 'firebase_key'){
//            $user->firebase_key = '';
//        }
        $user->save();

    }

    private function removeAllToken($user)
    {
        $user->tokens()->delete();
    }

    private function removeToken($user)
    {
        $user->token()->delete();
    }
}
