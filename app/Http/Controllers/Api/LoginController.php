<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController{
    public function loginApi(Request $request){
        $errNumber = 0;
        $errCode = 'success';
        $errMessage = 'success';
        $data = '';
        if(!$request->email || !$request->password){
            $errNumber = 1;
            $errCode = 'error';
            $errMessage = 'Invalid Parameter';
        }else{
            $result = DB::table('pegawai')->where('email', $request->email)->first();
            if($result){
                if(Hash::check($request->password, $result->password)){
                    $request->session()->put('isLogin',$result);
                    $errMessage = 'Login Berhasil';
                    $data = $result;
                }else{
                    $errNumber = 1;
                    $errCode = 'error';
                    $errMessage = 'Password Salah';
                }
            } else {
                $errNumber = 1;
                $errCode = 'error';
                $errMessage = 'Username belum terdaftar';
            }
        }

        $response = array(
            'respNumber' => $errNumber,
            'respCode' => $errCode,
            'respMessage' => $errMessage,
            'data' => $data
        );

        return response()->json($response);
    }

    public function cekSession(){
        $data =  Session::get('isLogin');
        return response()->json($data);
    }
    
    public function logoutApi(){
        $errNumber = 0;
        $errCode = 'success';
        $errMessage = 'Logout berhasil';

        Session::forget('isLogin');
        $response = array(
            'respNumber' => $errNumber,
            'respCode' => $errCode,
            'respMessage' => $errMessage
        );
        return response()->json($response); 
        
    }
}