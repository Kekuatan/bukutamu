<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/signup', (\App\Http\Controllers\Api\Auth\SignUpController::class));
Route::post('/login', (\App\Http\Controllers\Api\Auth\LoginController::class));
Route::post('/client', function(Request $request){
    $baseUri = 'http://bank-bca.test/';
    $clientId = '95cac743-b424-40e9-8154-6842f5b4af3c';
    $clientSecret = '0ljshfTMsDLox8f4SXFkvMAsNucl1NV4eyZwxieT';

    $response = Http::asForm()->post($baseUri . '/oauth/token', [
        'grant_type' => 'client_credentials',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
//            'scope' => '',
    ]);

    return response()->json($response);
});

Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});


