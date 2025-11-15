<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Category::getRecord();
        $data['header_title'] = 'Category';
        return view('admin.category.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Category';
        return view('admin.category.add', $data);
    }

    public function insert(Request $request)
    {
        // Validate slug duy nhất
        $request->validate([
            'slug' => 'required|unique:category'
        ]);

        // Tạo mới danh mục
        $category = new Category;
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keyword = trim($request->meta_keyword);
        $category->created_by = Auth::user()->id;
        $category->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/category/list')->with('success', "Tạo danh mục thành công!");
    }

    public function edit($id)
    {
        $data['getRecord'] = Category::getSingle($id);
        $data['header_title'] = 'Edit Categoty';
        return view('admin.category.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:category,slug,' . $id
        ]);

        // Tạo mới danh mục
        $category = Category::getSingle($id);
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keyword = trim($request->meta_keyword);
        $category->save();

        // Chuyển hướng sau khi thêm thành công
        return redirect('admin/category/list')->with('success', "Cập nhật danh mục danh mục thành công");
    }
    public function delete($id)
    {
        $category = Category::getSingle($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->back()->with('success', " Danh mục xóa thành công");
    }

}
