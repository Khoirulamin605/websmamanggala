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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\LoginController@loginApi');
Route::middleware('LoginApi')->group(function () {
    Route::get('/cek_session', 'Api\LoginController@cekSession');
    Route::get('/logout', 'Api\LoginController@logoutApi');
    Route::get('/cek_absen/{id}', 'Api\AbsenController@cekAbsen');
});
