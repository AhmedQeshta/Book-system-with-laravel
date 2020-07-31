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

Route::group(['prefix' => 'user'], function () {
    Route::post('/store','API\UserController@store')->name('user.store');
    Route::match(['PUT' , 'PATCH'],'/update/{id}','API\UserController@update')->name('user.update');
    Route::get('/index','API\UserController@index')->name('user.index');
    Route::get('/show/{id?}','API\UserController@show')->name('user.show');
});

