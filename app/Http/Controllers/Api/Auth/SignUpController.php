<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Authentication\AuthApiService;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function __invoke(Request $request)
    {
        $authService  = (new AuthApiService())->signUp($request);
        return $authService;
    }
}
