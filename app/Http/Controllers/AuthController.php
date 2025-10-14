<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Mail;
use App\Mail\RegisterMail;
class AuthController extends Controller
{
    public function login_admin()
    {
        if (!empty(Auth::check()) && Auth::user()->is_admin == 1) { // kiểm tra đang đăng nhập chưa vs tk là admin thì cho vào trạng dash
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }
    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'is_admin' => 1,
                'status' => 0,
                'is_delete' => 0
            ], $remember)
        ) { // // chỉ cho phép là admin vs trạng thái tk admin vẫn hoạt động ms cho đăng nhập
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', "Vui lòng nhập email vs mật khẩu đúng");

        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect(url(''));
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => 0,
                'is_delete' => 0
            ], $remember)
        ) {
            if (!empty(Auth::user()->email_verified_at)) {
                $json['status'] = true;
                $json['message'] = 'success';
            } else {
                $save = User::getSingle(Auth::user()->id);
                Mail::to($save->email)->send(new RegisterMail($save));
                Auth::logout();
                $json['status'] = false;
                $json['message'] = 'Email tài khoản của bạn chưa được xác minh. Vui lòng kiểm tra hộp thư đến và xác minh';
            }
        } else {
            $json['status'] = false;
            $json['message'] = 'Vui lòng nhập email và mật khẩu hiện tại';
        }
        echo json_encode($json);
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);

        if (empty($checkEmail)) {
            $save = new User;
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();

            Mail::to($save->email)->send(new RegisterMail($save)); // Gui email xac minh

            $json['status'] = true;
            $json['message'] = "Tài khoản của bạn đã được tạo thành công. Vui lòng xác minh địa chỉ email của bạn";
        } else {
            $json['status'] = false;
            $json['message'] = "Email này đã được đăng ký, vui lòng chọn email khác";
        }
        echo json_encode($json);
    }




    // Xac minh email = token
    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user = User::getSingle($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', "Email successfully verified");
    }

}
