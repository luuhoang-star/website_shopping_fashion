<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
class AuthController extends Controller
{
    public function login_admin()
    {
        if(!empty(Auth::check()) && Auth::user()->is_admin == 1) { // kiểm tra đang đăng nhập chưa vs tk là admin thì cho vào trạng dash
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }
    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0,
    'is_delete' => 0], $remember)) { // // chỉ cho phép là admin vs trạng thái tk admin vẫn hoạt động ms cho đăng nhập
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', "Vui lòng nhập email vs mật khẩu đúng");

        }
    }

    public function logout_admin() {
        Auth::logout();
        return redirect('admin');   
    }

}
