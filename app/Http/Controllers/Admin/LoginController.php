<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers{
        logout as performLogout;
    }

    protected $redirectTo = RouteServiceProvider::ADMINHOME;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');;
    }


    public function showLoginForm(){
        return view('admin.login');
    }

    function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            toastr()->info(__('admin.loginsuccess'));
            return redirect()->intended($this->redirectPath());
        }
        toastr()->error(__('admin.nologin'));
        return redirect('admin-login');
    }

    protected function guard(){
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('admin.login');
    }
}
