<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('wer', function () {
    echo $hashed = Hash::make('aa');
});
Route::group(['middleware' => App\Http\Middleware\AdminLogin::class,], function () {
 Route::get('login/show', 'UserController@login');
 Route::get('tab/show', 'UserController@tab');
});


 Route::get('show/show', 'Login@show');
Route::any('user/index', 'Login@index');
Route::get('del/del', 'Login@del');


