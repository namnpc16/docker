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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\LoginController@login');
    Route::post('signup', 'Api\LoginController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\LoginController@logout');
        Route::get('user', 'Api\LoginController@user');
    });
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('user', 'Api\UserController');

Route::apiResource('post','Admin\ApiPostController');