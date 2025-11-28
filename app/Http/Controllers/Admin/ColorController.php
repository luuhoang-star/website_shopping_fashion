<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Auth;
class ColorController extends Controller
{
     public function list()
    {
        $data['getRecord'] = Color::getRecord();
        $data['header_title'] = 'Brand';
        return view('admin.color.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Color';
        return view('admin.color.add', $data);
    }

    public function insert(Request $request)
    {
        // Validate slug duy nhất
       

        // Tạo mới danh mục
        $color = new Color;
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id;
        $color->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/color/list')->with('success', "Thêm màu sắc mới thành công!");
    }
    public function edit($id)
    {
        $data['getRecord'] = Color::getSingle($id);
        $data['header_title'] = 'Edit Color';
        return view('admin.color.edit', $data);
    }

    public function update($id, Request $request)
    {
       

        // Tạo mới danh mục
        $color = Color::getSingle($id);
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/color/list')->with('success', "Cập nhật màu sắc thành công!");
    }

    public function delete($id) {
        $color = Color::getSingle($id);
        $color->is_delete = 1;
        $color->save();

        return redirect()->back()->with('success', "Màu sắc đã xóa thành công!");
    }
}
