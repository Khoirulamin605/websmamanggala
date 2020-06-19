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

    // Data Siswa Aktif
    Route::get('/siswa/siswa_aktif', function () {
        return view('page.siswa.list_siswa');
    });
    Route::post('/siswa/get_siswa_aktif', 'Siswa\ListSiswaController@getDataSiswaAktif');
    Route::post('/siswa/get_siswa_non_aktif', 'Siswa\ListSiswaController@getDataSiswaNonAktif');
    Route::post('/siswa/insert_siswa', 'Siswa\ListSiswaController@insertDataSiswa');
    Route::post('/siswa/update_siswa', 'Siswa\ListSiswaController@updateDataSiswa');
    Route::post('/siswa/siswa_keluar', 'Siswa\ListSiswaController@pindahkanSiswa');
    Route::get('/siswa/delete_siswa/{id}', 'Siswa\ListSiswaController@deleteSiswa');
    Route::post('/siswa/import_data', 'Siswa\ListSiswaController@importData');

    // Data Siswa Non-Aktif
    Route::get('/siswa/siswa_non_aktif', function () {
        return view('page.siswa.siswa_non_aktif');
    });

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

    // Data Rombongan Belajar
    Route::get('/sekolah/rombel', 'Sekolah\KelasController@index');
    Route::post('/sekolah/get_kelas', 'Sekolah\KelasController@get');
    Route::post('/sekolah/insert_kelas', 'Sekolah\KelasController@insert');
    Route::post('/sekolah/update_kelas', 'Sekolah\KelasController@update');
    Route::get('/sekolah/delete_kelas/{id}', 'Sekolah\KelasController@delete');
    Route::get('/sekolah/update_status_pegawai/{id}', 'Sekolah\KelasController@updatePegawaiTugas');


    // Data Pegawai
    Route::get('/pegawai', 'Pegawai\PegawaiController@index' );
    Route::post('/pegawai/get_pegawai', 'Pegawai\PegawaiController@dataPegawai');
    Route::post('/pegawai/insert_pegawai', 'Pegawai\PegawaiController@insertPegawai');
    Route::post('/pegawai/update_pegawai', 'Pegawai\PegawaiController@updatePegawai');
    Route::get('/pegawai/get_all_pegawai', 'Pegawai\PegawaiController@getAllPegawai');
    Route::get('/pegawai/hapus_pegawai/{id}', 'Pegawai\PegawaiController@deletePegawai');
    Route::get('/pegawai/get_pegawai_by_id/{id}', 'Pegawai\PegawaiController@getPegawaiById');

    // Jabatan Pegawai
    Route::get('/pegawai/jabatan', function () {
        return view('page.pegawai.jabatan');
    });
    Route::post('/jabatan/get_all_jabatan', 'Pegawai\JabatanController@getAllJabatan');
    Route::post('/jabatan/insert_jabatan', 'Pegawai\JabatanController@insertJabatan');
    Route::post('/jabatan/update_jabatan', 'Pegawai\JabatanController@updateJabatan');
    Route::get('/jabatan/hapus_jabatan/{id}', 'Pegawai\JabatanController@deleteJabatan');


    // Mapel
    Route::get('/sekolah/mapel', 'Sekolah\MapelController@index');
});