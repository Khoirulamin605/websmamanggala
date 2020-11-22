<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class AbsenController{
    
    function __construct() {
        date_default_timezone_set("Asia/Bangkok");
    }

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

    public function masuk($id_qr){
        // dd(Session::get('isLogin'));
        $errNumber = 0;
        $errCode = 'success';
        $errMessage = 'success';
        $data = '';
        $id_pegawai = Session::get('isLogin')->id;
        $result = DB::table('absen')->where('id_qr',$id_qr)->where('id_pegawai', $id_pegawai)->update([
            'masuk' => date('H:i:s')
        ]);

        if($result){
            $data = DB::table('absen')->where('id_qr',$id_qr)->where('id_pegawai', $id_pegawai)->first();
        }

        $response = array(
            'respNumber' => $errNumber,
            'respCode' => $errCode,
            'respMessage' => $errMessage,
            'data' => $data
        );

        return response()->json($response);
    }


    public function pulang($id_qr){
        // dd(Session::get('isLogin'));
        $errNumber = 0;
        $errCode = 'success';
        $errMessage = 'success';
        $data = '';
        $id_pegawai = Session::get('isLogin')->id;
        $result = DB::table('absen')->where('id_qr',$id_qr)->where('id_pegawai', $id_pegawai)->update([
            'pulang' => date('H:i:s')
        ]);

        if($result){
            $data = DB::table('absen')->where('id_qr',$id_qr)->where('id_pegawai', $id_pegawai)->first();
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