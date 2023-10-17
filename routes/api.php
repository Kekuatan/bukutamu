<?php

use App\Http\Controllers\Api\GuestBookController;
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

// Route::post('/signup', (\App\Http\Controllers\Api\Auth\SignUpController::class));
// Route::post('/login', (\App\Http\Controllers\Api\Auth\LoginController::class));
Route::post('/home', [\App\Http\Controllers\Api\HomeController::class,'homeContent']);

Route::group([
    'middleware' => ['client']
], function () {
    Route::resource('/guest', GuestBookController::class)->only(['index','store']);
    Route::get('/guest/{id}' ,[GuestBookController::class, 'show']);
    Route::post('/update/guest', [\App\Http\Controllers\Api\HomeController::class,'updateGuest']);

});

Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


