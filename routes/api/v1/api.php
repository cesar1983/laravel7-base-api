<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Auth
Route::group([
    'middleware' => 'locale',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'api\v1\AuthController@login');
    Route::post('signup', 'api\v1\AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'api\v1\AuthController@logout');
        Route::get('user', 'api\v1\AuthController@user');
    });
});


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});