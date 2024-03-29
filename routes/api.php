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
        Route::patch('/user/{id}', 'UserController@update')->name('user.update');
        Route::delete('user/{id}', 'UserController@destroy')->name('user.destroy');
        Route::get('user/cari/{nama}', 'UserController@cari')->name('user.cari');
        Route::get('role', 'RoleController@index')->name('role.index');
        Route::get('pelanggan', 'PelangganController@index')->name('pelanggan.index');
        Route::post('pelanggan', 'PelangganController@store')->name('pelanggan.store');
        Route::get('pelanggan/{id}', 'PelangganController@show')->name('pelanggan.show');
        Route::patch('/pelanggan/{id}', 'PelangganController@update')->name('pelanggan.update');
        Route::delete('pelanggan/{id}', 'PelangganController@destroy')->name('pelanggan.destroy');
        Route::get('pelanggan/cari/{nama}', 'PelangganController@cari')->name('pelanggan.cari');
        Route::get('produk', 'ProdukController@index')->name('produk.index');
        Route::post('produk', 'ProdukController@store')->name('produk.store');
        Route::get('produk/{id}', 'ProdukController@show')->name('produk.show');
        Route::patch('produk/{id}', 'ProdukController@update')->name('produk.update');
        Route::delete('produk/{id}', 'ProdukController@destroy')->name('produk.destroy');
        Route::get('produk/cari/{nama}', 'ProdukController@cari')->name('produk.cari');
        Route::get('satuan', 'SatuanController@index')->name('satuan.index');
        Route::get('supplier', 'SupplierController@index')->name('supplier.index');
        Route::post('supplier', 'SupplierController@store')->name('supplier.store');
        Route::get('supplier/{id}', 'SupplierController@show')->name('supplier.show');
        Route::patch('supplier/{id}', 'SupplierController@update')->name('supplier.update');
        Route::delete('supplier/{id}', 'SupplierController@destroy')->name('supplier.destroy');
        Route::get('supplier/cari/{nama}', 'SupplierController@cari')->name('supplier.cari');
        Route::get('penjualan', 'PenjualanController@index')->name('penjualan.index');
        Route::post('penjualan', 'PenjualanController@store')->name('penjualan.store');
        Route::get('penjualan/{id}', 'PenjualanController@show')->name('penjualan.show');
        Route::patch('penjualan/{id}', 'PenjualanController@update')->name('penjualan.update');
        Route::delete('penjualan/{id}', 'PenjualanController@destroy')->name('penjualan.destroy');
        Route::get('penjualan/cari/{nama}', 'PenjualanController@cari')->name('penjualan.cari');
    });
});