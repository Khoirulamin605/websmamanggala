<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;


class PegawaiController{


    public function getAllPegawai(){
        $data_pegawai = DB::table('pegawai')->get();

        return response()->json($data_pegawai);
    }
    public function getPegawaiById($id){
        $data_pegawai = DB::table('pegawai')->where('id', $id)->first();

        return response()->json($data_pegawai);
    }
}