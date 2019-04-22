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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api',], function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');

    Route::group(['middleware' => 'jwt.auth',], function () {
        Route::get('user', 'UserController@index')->name('user.index');
        Route::post('user', 'UserController@store')->name('user.store');
        Route::get('user/{id}', 'UserController@show')->name('user.show');
        Route::get('user/cari/{nama}', 'UserController@cari')->name('user.cari');
        Route::patch('/user/update/{id}', 'UserController@update')->name('user.update');
        Route::get('role', 'RoleController@index')->name('role.index');
    });
});
