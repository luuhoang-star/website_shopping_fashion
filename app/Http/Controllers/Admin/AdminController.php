<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin(); // danh sách user gán vào biến getRecord
        $data['header_title'] = 'Admin'; // Tiêu đề cho rõ
        return view('admin.admin.list', $data); // truyền $data vào view để sử dụng
    }

    public function add()
    {
        $data['header_title'] = 'Add New Admin'; // Tiêu đề cho rõ
        return view('admin.admin.add', $data); // truyền vô để hiển thị tiêu đề
    }

    public function insert(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users' // required:bắt buộc,email:đúng định dạng,unique users là 1 email duy nhất trong bảng users
        ]);
        $user = new User;
        $user->name = $request->name; // nhập 
        $user->email = $request->email; // nhập
        $user->password = Hash::make($request->password); // mã hóa mật khẩu
        $user->status = $request->status; // chọn
        $user->is_admin = 1; // mặc định là tài khoản admin
        $user->save(); // lưu vào database -> list nó trỏ vào tên csdl sẽ hiển thị dữ liệu

        return redirect('admin/admin/list')->with('success', 'Thêm admin thành công!'); // về trang list và thông báo thành công
    }

    public function edit($id)
    { // truyền dữ liệu $id vào hàm để sử dụng:tìm theo id
        $data['getRecord'] = User::getSingle($id); // gán user theo id vào biến getSingle
        $data['header_title'] = 'Edit Admin'; // tiêu đề cho đẹp
        return view('admin.admin.edit', $data); // truyền dữ liệu vô edit -> sửa theo id,tên đẹp
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' .$id // required:bắt buộc,email:đúng định dạng,unique users là 1 email duy nhất trong bảng users
        ]);

        $user = User::getSingle($id);
        $user->name = $request->name; // nhập 
        $user->email = $request->email; // nhập
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password); // mã hóa mật khẩu
        }
        $user->status = $request->status; // chọn
        $user->is_admin = 1; // mặc định là tài khoản admin
        $user->save(); // lưu vào database -> list nó trỏ vào tên csdl sẽ hiển thị dữ liệu

        return redirect('admin/admin/list')->with('success', 'Cập nhật admin thành công!'); // về trang list và thông báo thành công
    }

  public function delete($id) {
    $user = User::getSingle($id);
    if ($user) {
        $user->is_delete = 1; //1 là xóa_mềm
        $user->save();
        return redirect()->back()->with('success', 'Bản ghi đã xóa thành công!');
    } 
    
}

public function customer_list() {
    $data['getRecord'] = User::getCustomer();
    $data['header_title'] = 'Customer';
    return view('admin.customer.list', $data);
}


}
