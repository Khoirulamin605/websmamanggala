<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use \Firebase\JWT\JWT;
use DB;
// use URL;

class LoginController{
    public function loginApi(Request $request){
        $response = array();
        // $errNumber = 0;
        // $errCode = 'success';
        // $errMessage = 'success';
        // $data = '';
        // $jwt = '';
        if(!$request->header('login_key')){
            $response['errNumber'] = 1;
            $response['status'] = 'fialed';
            $response['respTime'] = date('Y-m-d H:i:s');
            $response['errMessage'] = 'Invalid Parameter Header';
        }else{
            if(!$request->email || !$request->password){
                $response['errNumber'] = 1;
                $response['status'] = 'fialed';
                $response['respTime'] = date('Y-m-d H:i:s');
                $response['errMessage'] = 'Invalid Parameter Body';
            }else{
                $result = DB::table('pegawai')->where('email', $request->email)->first();
                if($result){
                    if(Hash::check($request->password, $result->password)){
                        $result->login_key = $request->header('login_key');
                        $result->last_login = date('Y-m-d H:i:s');
                        // dd($result);
                        $request->session()->put('isLogin',$result);
                        $key = env('APP_KEY');
                        $payload = array(
                            "user_id" => $result->id,
                            "app_name" => env('APP_NAME'),
                            "last_login" => date('Y-m-d H:i:s'),
                            "login_key" => $request->header('login_key')
                        );
                        if($result->avatar){
                            $avatar = url('/').'/profil/'.$result->avatar;
                        }else{
                            $avatar = url('/').'/profil/user_default.png';
                        }

                        $response['errNumber'] = 0;
                        $response['status'] = 'success';
                        $response['respTime'] = date('Y-m-d H:i:s');
                        $response['errMessage'] = 'Login Berhasil';
                        $response['data'] = array(
                            'id' => $result->id,
                            'kode_pegawai' => $result->kode_pegawai,
                            'nama_pegawai' => $result->nama_pegawai,
                            'tempat_lahir' => $result->tempat_lahir,
                            'tanggal_lahir' => $result->tanggal_lahir,
                            'jenis_kelamin' => $result->jenis_kelamin,
                            'alamat' => $result->alamat,
                            'pendidikan_terahir' => $result->pendidikan_terahir,
                            'email' => $result->email,
                            'avatar' => $avatar
                        );
                        $response['token'] =  JWT::encode($payload, $key);
                    }else{
                        $response['errNumber'] = 1;
                        $response['respTime'] = date('Y-m-d H:i:s');
                        $response['status'] = 'fialed';
                        $response['errMessage'] = 'Password Salah';
                    }
                } else {
                    $response['errNumber'] = 1;
                    $response['status'] = 'fialed';
                    $response['respTime'] = date('Y-m-d H:i:s');
                    $response['errMessage'] = 'Username belum terdaftar';
                }
            }
        }

        // $response = array(
        //     'respNumber' => $errNumber,
        //     'respCode' => $errCode,
        //     'respMessage' => $errMessage,
        //     'data' => $data,
        //     'token' => $jwt
        // );

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
            'respTime' => date('Y-m-d H:i:s'),
            'respMessage' => $errMessage
        );
        return response()->json($response); 
        
    }

    public function jwtCek(Request $request){
        // dd();
        $key = env('APP_KEY');
        $data = JWT::decode($request->bearerToken(), $key, array('HS256'));
        return response()->json($data);
    }
}