<?php

namespace App\Http\Controllers\Sekolah;
use Illuminate\Http\Request;
use DB;



class MapelController{
    public function index(){
        $jurusan = DB::table('jurusan')->get();
        $jurusan1 = DB::table('jurusan')->get();
        $wali_kelas = DB::table('pegawai')->get();
        $wali_kelas1 = DB::table('pegawai')->get();
        return view('page.sekolah.mapel', compact(['jurusan','jurusan1','wali_kelas','wali_kelas1']));
    }
}