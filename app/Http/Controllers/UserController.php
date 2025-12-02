<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductWishlist;
use App\Models\ProductReview;
use Auth;
use Hash;


class UserController extends Controller
{
    public function dashboard()
    {

        $data['TotalOrder'] = Order::getTotalOrderUser(Auth::user()->id);
        $data['TotalTodayOrder'] = Order::getTotalTodayOrderUser(Auth::user()->id);
        $data['TotalAmount'] = Order::getTotalAmountUser(Auth::user()->id);
        $data['TotalTodayAmount'] = Order::getTotalTodayAmountUser(Auth::user()->id);

        $data['TotalPending'] = Order::getTotalStatusUser(Auth::user()->id, 0);
        $data['TotalInprogess'] = Order::getTotalStatusUser(Auth::user()->id, 1);
        $data['TotalCompleted'] = Order::getTotalStatusUser(Auth::user()->id, 3);
        $data['TotalCancelled'] = Order::getTotalStatusUser(Auth::user()->id, 4);
        $data['meta_title'] = 'Dashboard';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        return view('user.dashboard', $data);
    }

    public function orders()
    {
        $data['getRecord'] = Order::getRecordUser(Auth::user()->id);
        $data['meta_title'] = 'Đơn hàng';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        return view('user.orders', $data);
    }

    public function orders_detail($id)
    {
        $data['getRecord'] = Order::getSingleUser(Auth::user()->id, $id);
        if (!empty($data['getRecord'])) {
            $data['meta_title'] = 'Chi tiết đơn hàng';
            $data['meta_description'] = '';
            $data['meta_keyword'] = '';
            return view('user.orders_detail', $data);
        } else {
            abort(404);
        }
    }


    public function edit_profile()
    {
        $data['meta_title'] = 'Orders';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        return view('user.edit-profile', $data);
    }

    public function update_profile(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->company_name = trim($request->company_name);
        $user->country_name = trim($request->country_name);
        $user->address_one = trim($request->address_one);
        $user->address_two = trim($request->address_two);
        $user->city = trim($request->city);
        $user->state = trim($request->state);
        $user->postcode = trim($request->postcode);
        $user->phone = trim($request->phone);
        $user->save();

        return redirect()->back()->with('success', 'Thông tin cá nhân cập nhật thành công');

    }

    public function change_password()
    {
        $data['meta_title'] = 'Orders';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        return view('user.change-password', $data);
    }

    public function update_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->password == $request->confirm_password) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('success', "Mật khẩu cập nhật thành công");
            } else {
                return redirect()->back()->with('error', "Mật khẩu mới và mật khẩu xác nhận không khớp nhau");
            }
        } else {
            return redirect()->back()->with('error', "Mật khẩu cũ chưa đúng");
        }
    }

    public function add_to_wishlist(Request $request)
    {
        $check = ProductWishlist::checkAlready($request->product_id, Auth::user()->id);
        if (empty($check)) {
            $save = new ProductWishlist;
            $save->product_id = $request->product_id;
            $save->user_id = Auth::user()->id;
            $save->save();
            $json['is_wishlist'] = 1;
        } else {
            ProductWishlist::DeleteRecord($request->product_id, Auth::user()->id);
            $json['is_wishlist'] = 0;
        }
        $json['status'] = true;
        echo json_encode($json);

    }

    public function submit_review(Request $request) {
        $save = new ProductReview;
        $save->product_id = trim($request->product_id);
        $save->order_id = trim($request->order_id);
        $save->user_id = Auth::user()->id;
        $save->rating = trim($request->rating);
        $save->review = trim($request->review);
        $save->save();

        return redirect()->back()->with('success', "Cảm ơn đánh giá của bạn !");
    }
}