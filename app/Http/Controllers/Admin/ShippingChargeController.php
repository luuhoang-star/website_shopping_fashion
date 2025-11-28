<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use Auth;
class ShippingChargeController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ShippingCharge::getRecord();
        $data['header_title'] = 'Shipping Charge';
        return view('admin.shippingcharge.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Shipping Charge';
        return view('admin.shippingcharge.add', $data);
    }

    public function insert(Request $request)
    {
        // Validate slug duy nhất


        // Tạo mới danh mục
        $shippingcharge = new ShippingCharge;
        $shippingcharge->name = trim($request->name);
        $shippingcharge->price = trim($request->price);
        $shippingcharge->status = trim($request->status);
        $shippingcharge->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/shipping_charge/list')->with('success', "Tạo phí vận chuyển thành công!");
    }
    public function edit($id)
    {
        $data['getRecord'] = ShippingCharge::getSingle($id);
        $data['header_title'] = 'Edit Shipping';
        return view('admin.shippingcharge.edit', $data);
    }

    public function update($id, Request $request)
    {


        // Tạo mới danh mục
        $shippingcharge = ShippingCharge::getSingle($id);
        $shippingcharge->name = trim($request->name);
        $shippingcharge->price = trim($request->price);
        $shippingcharge->status = trim($request->status);
        $shippingcharge->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/shipping_charge/list')->with('success', "Cập nhật phí vận chuyển thành công!");
    }

    public function delete($id)
    {
        $shippingcharge = ShippingCharge::getSingle($id);
        $shippingcharge->is_delete = 1;
        $shippingcharge->save();

        return redirect()->back()->with('success', "Xóa phí vận chuyển thành công!");
    }
}
