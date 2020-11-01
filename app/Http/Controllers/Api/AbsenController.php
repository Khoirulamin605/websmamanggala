<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;

class AbsenController{
    public function cekAbsen($id){
        $errNumber = 0;
        $errCode = 'success';
        $errMessage = 'success';
        $data = '';
        $date = date('d-m-Y');
        $result = DB::table('absen')->where('id_pegawai', $id)->where('tanggal', $date)->first();

        if($result){
            $data = $result;
        }

        $response = array(
            'respNumber' => $errNumber,
            'respCode' => $errCode,
            'respMessage' => $errMessage,
            'data' => $data
        );

        return response()->json($response);
    }
}