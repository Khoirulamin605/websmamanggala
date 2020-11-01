<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;


class ApiAuthenticate
{
    public function handle($request, Closure $next )
    {
        if(Session::has('isLogin')){
            return $next($request);
        }else{
            $response = array(
                'respNumber' => 1,
                'respCode' => 'error',
                'respMessage' => 'Anda Belum Login'
            );

            return response()->json($response);
        }
    }
}
