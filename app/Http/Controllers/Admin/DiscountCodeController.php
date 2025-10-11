<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCode;
use Auth;
class DiscountCodeController extends Controller
{
    public function list()
    {
        $data['getRecord'] = DiscountCode::getRecord();
        $data['header_title'] = 'DisCount Code';
        return view('admin.discountcode.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New DiscountCode';
        return view('admin.discountcode.add', $data);
    }

    public function insert(Request $request)
    {
        // Validate slug duy nhất


        // Tạo mới danh mục
        $DiscountCode = new DiscountCode;
        $DiscountCode->name = trim($request->name);
        $DiscountCode->type = trim($request->type);
        $DiscountCode->percent_amount = trim($request->percent_amount);
        $DiscountCode->expire_date = trim($request->expire_date);
       $DiscountCode->status = trim($request->status);
        $DiscountCode->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/discount_code/list')->with('success', "DiscountCode Successfully Created");
    }
    public function edit($id)
    {
        $data['getRecord'] = DiscountCode::getSingle($id);
        $data['header_title'] = 'Edit Discount Code';
        return view('admin.discountcode.edit', $data);
    }

    public function update($id, Request $request)
    {


        // Tạo mới danh mục
        $DiscountCode = DiscountCode::getSingle($id);
        $DiscountCode->name = trim($request->name);
        $DiscountCode->type = trim($request->type);
        $DiscountCode->percent_amount = trim($request->percent_amount);
        $DiscountCode->expire_date = trim($request->expire_date);
       $DiscountCode->status = trim($request->status);
        $DiscountCode->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/discount_code/list')->with('success', "Cập nhật max giam gia thành công");
    }

    public function delete($id)
    {
        $DiscountCode = DiscountCode::getSingle($id);
        $DiscountCode->is_delete = 1;
        $DiscountCode->save();

        return redirect()->back()->with('success', "DiscountCode Successfully deleted");
    }
}
