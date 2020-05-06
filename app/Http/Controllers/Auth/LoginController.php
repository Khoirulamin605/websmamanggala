<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function goLogin(Request $request){
        if (Auth::attempt($request->only('email','password'))){
            return json_encode(array(
                'status' => TRUE, 'message' => 'Login Berhasil!'
            ));
        }else{
            return json_encode(array(
                'status' => FALSE, 'message' => 'Username atau password anda salah!'
            ));
        }
    }
    // Function Logout
    public function logout(){
        // Session::flush();
        Auth::logout();
        $res = $this->middleware('guest')->except('logout');
        if($res){
            return redirect('/');
        }
    }
}
