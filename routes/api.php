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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('cart', 'ShowController@cart');
    Route::post('order', 'OrderController@order');
    Route::post('orderadd', 'OrderController@orderadd');
    Route::post('ress', 'ShowController@ress');
});
Route::post('shop', 'ShowController@shop');
Route::post('goods', 'ShowController@goods');
Route::post('shpp', 'ShowController@shpp');
Route::post('ation', 'ShowController@ation');
Route::post('floor', 'ShowController@floor');
Route::post('cate', 'ShowController@cate');
Route::post('updatcate', 'ShowController@updatcate');
Route::post('address', 'ShowController@address');
Route::post('add', 'ShowController@add');
Route::get('pay', 'PayController@index');
Route::get('return', 'PayController@return');
Route::any('notify', 'PayController@notify');