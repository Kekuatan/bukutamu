<?php

namespace App\Services\Authentication;

use App\Models\CountryCode;
use App\Models\Otp;
use App\Models\User;
use App\Services\Google\Firebase\CloudMessaging\FirebaseCloudMessaging;
use App\Services\Google\Firebase\CloudMessaging\Messages\LogoutMessage;
use App\Services\OTP\OTPService;
use App\Services\Passport\PassportService;
use App\Services\PhoneNumber\PhoneNumber;
use App\Traits\PassportTokenTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthApiService
{

    use PassportTokenTrait;

    public function signUp(Request $request)
    {

        $user = User::where('email', $request->email)
            ->first();

        if (blank($user)) {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now()->toDateTimeLocalString()
            ]);

            $user = $user->refresh();
        }

        return response()->json($user);

    }

    public function login(Request $request)
    {
        $user = User::where(function ($query) use ($request){
            return $query->where('email' , '=', $request->email);
        })->first();

        if (Hash::check($request->password,$user->password)){
            $this->removeAllTokenAndRefreshToken($user);
            return $this->generateOauthToken($request);
        }

    }

    private function generateOauthToken(Request $request)
    {
        $client = PassportService::getClient();

        $host = config('app.url') . '/oauth/token';

        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post($host, [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => ''
        ]);
    }
}
