<?php

use Illuminate\Http\Request;

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

Route::post('register', 'UserController@registerUser');

Route::post('login', 'UserController@userLogin');

Route::get('articles', 'ArticleController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
