<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Auth;
class BrandController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Brand::getRecord();
        $data['header_title'] = 'Brand';
        return view('admin.brand.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Category';
        return view('admin.brand.add', $data);
    }

    public function insert(Request $request)
    {
        // Validate slug duy nhất
        $request->validate([
            'slug' => 'required|unique:brand'
        ]);

        // Tạo mới danh mục
        $brand = new Brand;
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keyword = trim($request->meta_keyword);
        $brand->created_by = Auth::user()->id;
        $brand->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/brand/list')->with('success', "Thêm thương hiệu thành công!");
    }
    public function edit($id)
    {
        $data['getRecord'] = Brand::getSingle($id);
        $data['header_title'] = 'Edit Brand';
        return view('admin.brand.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:brand,slug,' . $id
        ]);

        // Tạo mới danh mục
        $brand = Brand::getSingle($id);
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keyword = trim($request->meta_keyword);
        $brand->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/brand/list')->with('success', "Cập nhật thương hiệu thành công!");
    }

    public function delete($id) {
        $brand = Brand::getSingle($id);
        $brand->is_delete = 1;
        $brand->save();

        return redirect()->back()->with('success', "Xóa thương hiệu thành công");
    }
}
