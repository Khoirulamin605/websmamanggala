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
    // Login Api
    Route::get('/cek_session', 'Api\LoginController@cekSession');
    Route::post('/cek_jwt', 'Api\LoginController@jwtCek');
    Route::get('/logout', 'Api\LoginController@logoutApi');

    // Absensi Api
    Route::get('/cek_absen/{id}', 'Api\AbsenController@cekAbsen');
    Route::get('/masuk/{id}', 'Api\AbsenController@masuk');
    Route::get('/pulang/{id}', 'Api\AbsenController@pulang');

    // Input Nilai Api
    Route::get('/mapel', 'Api\MapelController@allMapel');
    Route::get('/nilai/{id}', 'Api\MapelController@nilaiMapel');
    Route::post('/input_nilai', 'Api\MapelController@inputNilai');
    Route::post('/nilai_siswa', 'Api\MapelController@cekNilaiSiswa');
    Route::get('/tahun', 'Api\MapelController@cekTahunAjaran');


    // Cek data Siswa
    Route::post('/siswa', 'Api\MapelController@cekDataSiswa');
    Route::get('/siswa/{id}', 'Api\MapelController@cekDataSiswaID');

});
