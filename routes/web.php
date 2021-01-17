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
Route::get('fake_absen', 'Pegawai\PenggajianController@fake_absen');
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('page.dashboard');
    });
    Route::get('/home', function () {
        return view('page.dashboard');
    });

    // Data Siswa Aktif
    Route::get('/siswa/siswa_aktif', 'Siswa\ListSiswaController@index');
    Route::post('/siswa/get_siswa_aktif', 'Siswa\ListSiswaController@getDataSiswaAktif');
    Route::post('/siswa/naik_kelas', 'Siswa\ListSiswaController@naikKelas');
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
    // Data Alumni
    Route::get('/siswa/alumni', 'Siswa\ListSiswaController@alumni');
    Route::post('siswa/get_alumni', 'Siswa\ListSiswaController@getAlumni');

    // Data Sekolah
    Route::get('/sekolah', 'Sekolah\SekolahController@index');
    Route::post('/sekolah/update_sekolah', 'Sekolah\SekolahController@updateData');
    Route::get('sekolah/getById/{id}', 'Sekolah\SekolahController@getDataSekolah');


    // Data Jurusan
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
    Route::post('/sekolah/get_mapel', 'Sekolah\MapelController@mapel');
    Route::post('/sekolah/insert_mapel', 'Sekolah\MapelController@insertMapel');
    Route::post('/sekolah/update_mapel', 'Sekolah\MapelController@updateMapel');
    Route::get('/sekolah/delete_mapel/{id}', 'Sekolah\MapelController@delete');

    // SPP
    Route::get('/sekolah/spp', 'Sekolah\SPPController@index');
    Route::post('/sekolah/get_spp', 'Sekolah\SPPController@spp');
    Route::post('/sekolah/generate_spp', 'Sekolah\SPPController@generate');
    Route::get('/sekolah/lunas_spp/{id}', 'Sekolah\SPPController@getLunas');


    // Keuangan
    Route::get('/sekolah/keuangan', 'Sekolah\KeuanganController@index');
    Route::post('/sekolah/get_keuangan', 'Sekolah\KeuanganController@getKeuangan');
    Route::post('/sekolah/insert_keuangan', 'Sekolah\KeuanganController@insert_keuangan');
    Route::post('/sekolah/update_keuangan', 'Sekolah\KeuanganController@update_keuangan');
    Route::get('/sekolah/delete_keuangan/{id}', 'Sekolah\KeuanganController@delete');

    // Nilai Siswa
    Route::get('/siswa/nilai', 'Siswa\NilaiController@index');
    Route::get('/siswa/nilai_siswa', 'Siswa\NilaiController@indexSiswa');
    Route::get('/siswa/impoort_file', 'Siswa\NilaiController@getDataSiswa');
    Route::post('/siswa/get_nilai_by_kelas', 'Siswa\NilaiController@getMapelByKelas');
    Route::post('/siswa/get_siswa_by_kelas', 'Siswa\NilaiController@getSiswaByKelas');
    Route::post('/siswa/buka_penilaian',  'Siswa\NilaiController@bukaPenilaian');
    Route::post('/siswa/get_nilai_siswa', 'Siswa\NilaiController@dataNilai');
    Route::post('/siswa/get_nilai_persiswa', 'Siswa\NilaiController@dataNilaiSiswa');
    Route::post('/siswa/update_nilai', 'Siswa\NilaiController@update');


    // Absen Pegawai
    Route::get('pegawai/absensi', 'Pegawai\AbsenPegawaiController@index');
    Route::get('pegawai/absensi_detail', 'Pegawai\AbsenPegawaiController@viewAbsensi');
    Route::get('/pegawai/cek_absensi', 'Pegawai\AbsenPegawaiController@cekAbsensi');
    Route::get('pegawai/hadir/{id}', 'Pegawai\AbsenPegawaiController@hadir');
    Route::get('pegawai/pulang/{id}', 'Pegawai\AbsenPegawaiController@pulang');
    Route::get('/pegawai/buka_absensi', 'Pegawai\AbsenPegawaiController@bukaAbsen');
    Route::post('pegawai/get_view_absen', 'Pegawai\AbsenPegawaiController@detailAbsensi');
    Route::post('/pegawai/get_absen_aktif', 'Pegawai\AbsenPegawaiController@getDataAbsen');

    // Penggajian Pegawai
    Route::get('/pegawai/penggajian', 'Pegawai\PenggajianController@index');
    Route::post('/pegawai/get_data_gaji', 'Pegawai\PenggajianController@getDataPenggajian');
    Route::get('/pegawai/buka_penggajian', 'Pegawai\PenggajianController@bukaPenggajian');




    // QRCode
    Route::get('/get_qr_absen/{id}', 'Pegawai\AbsenPegawaiController@cobaGenerate');
    Route::get('/qrcode', function () {
        return QrCode::size(300)->generate('A basic example of QR code! Nicesnippets.com');
    });
});