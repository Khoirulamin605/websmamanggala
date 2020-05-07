<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('logout', 'Auth\LoginController@logout');
Route::post('loginuser', 'Auth\LoginController@goLogin');
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('page.dashboard');
    });
    Route::get('/home', function () {
        return view('page.dashboard');
    });

    // Data Siswa
    Route::get('/siswa/siswa_aktif', function () {
        return view('page.siswa.list_siswa');
    });
    Route::post('/siswa/get_siswa_aktif', 'Siswa\ListSiswaController@getDataSiswaAktif');
    Route::post('/siswa/insert_siswa', 'Siswa\ListSiswaController@insertDataSiswa');
    Route::post('/siswa/update_siswa', 'Siswa\ListSiswaController@updateDataSiswa');
    Route::post('/siswa/siswa_keluar', 'Siswa\ListSiswaController@pindahkanSiswa');
    Route::get('/siswa/delete_siswa/{id}', 'Siswa\ListSiswaController@deleteSiswa');
    Route::post('/siswa/import_data', 'Siswa\ListSiswaController@importData');


    // Data Sekolah
    Route::get('/sekolah/jurusan', function () {
        return view('page.sekolah.jurusan');
    });
    Route::post('/sekolah/get_jurusan', 'Sekolah\JurusanController@getDataJurusan');
    Route::get('/sekolah/get_all_jurusan', 'Sekolah\JurusanController@getDataJurusanAll');
    Route::post('/sekolah/insert_jurusan', 'Sekolah\JurusanController@insertJurusan');
    Route::post('/sekolah/update_jurusan', 'Sekolah\JurusanController@updateJurusan');
    Route::get('/sekolah/get_jurusan_by_id/{id}', 'Sekolah\JurusanController@getJurusanById');
    Route::get('/sekolah/delete_jurusan/{id}', 'Sekolah\JurusanController@deleteJurusan');


    // Data Pegawai
    Route::get('/pegawai/get_all_pegawai', 'Pegawai\PegawaiController@getAllPegawai');
    Route::get('/pegawai/get_pegawai_by_id/{id}', 'Pegawai\PegawaiController@getPegawaiById');
});