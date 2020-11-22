<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use \Firebase\JWT\JWT;


class ApiAuthenticate
{
    public function handle($request, Closure $next )
    {

        $key = env('APP_KEY');
        if(!Session::has('isLogin')){
            $response = array(
                'respNumber' => 1,
                'respCode' => 'failed',
                'respTime' => date('Y-m-d H:i:s'),
                'respMessage' => 'Anda Belum Login'
            );

            return response()->json($response);
        }

        if(!$request->bearerToken()){
            $response = array(
                'respNumber' => 1,
                'respCode' => 'failed',
                'respTime' => date('Y-m-d H:i:s'),
                'respMessage' => 'Token tidak ada'
            );

            return response()->json($response);
        }
        
        try{
            $credentials = JWT::decode($request->bearerToken(), $key, array('HS256'));
            $session = Session::get('isLogin');
            if($credentials->login_key !== $session->login_key){
                $response = array(
                    'respNumber' => 1,
                    'respCode' => 'failed',
                    'respTime' => date('Y-m-d H:i:s'),
                    'respMessage' => 'Token expired'
                );

                return response()->json($response);
            }
        }catch(\ExpiredException $e) {
            $response = array(
                'respNumber' => 1,
                'respCode' => 'failed',
                'respTime' => date('Y-m-d H:i:s'),
                'respMessage' => 'Token expired'
            );

            return response()->json($response);
        }catch(\Exception $e){
            $response = array(
                'respNumber' => 1,
                'respCode' => 'failed',
                'respTime' => date('Y-m-d H:i:s'),
                'respMessage' => 'Token invalid'
            );

            return response()->json($response);
        }
        return $next($request);
    }
}
