<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginform(Request $request)
    {
        return view('auth.sign-in');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect('/home'); // Chuyển hướng tới trang chủ giao diện khách hàng
        }

        // Đăng nhập thất bại
        return redirect()->back()->withInput()->withErrors(['email' => 'Đăng nhập không thành công']);
    }
    
    public function logout() {
        Auth::logout();
        return view('auth.sign-in');
    }
}
