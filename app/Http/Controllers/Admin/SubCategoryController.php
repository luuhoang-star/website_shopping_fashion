<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;
class SubCategoryController extends Controller
{

    public function list()
    {
        $data['getRecord'] = SubCategory::getRecord();
        $data['header_title'] = 'Sub category';
        return view('admin.subcategory.list', $data);
    }

    public function add()
    {
        $data['getCategory'] = Category::getRecord();
        $data['header_title'] = 'Add New Sub Category';
        return view('admin.subcategory.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:sub_category'
        ]);

        $subcategory = new SubCategory;
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keyword = trim($request->meta_keyword);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin/subcategory/list')->with('success', "Sub category successfully created");
    }

    public function edit($id)
    {
        $data['getCategory'] = Category::getRecord();
        $data['getRecord'] = SubCategory::getSingle($id);
        $data['header_title'] = 'Edit Sub';
        return view('admin.subcategory.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:sub_category,slug,' . $id
        ]);
        $subcategory = SubCategory::getSingle($id);
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keyword = trim($request->meta_keyword);
        $subcategory->save();

        return redirect('admin/subcategory/list')->with('success', "Sub category success");


    }

    public function delete($id)
    {
        $subcategory = SubCategory::getSingle($id);
        $subcategory->is_delete = 1;
        $subcategory->save();
        return redirect()->back()->with('success', "Sub Category Sucessfully Deleted");
    }

    public function get_sub_category(Request $request)
    {
        $category_id = $request->id;  // ✅ Nhận category_id được gửi từ AJAX (từ select category)
        $get_sub_category = Subcategory::getRecordSubCategory($category_id); // lấy các subcategory tương ứng với category


        // Sau đó đơn giản là cấu hình hiển thị giao diện
        $html = '';
        $html = '<option value="">Select</option>';


        foreach ($get_sub_category as $value) {
            $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }


        return response()->json(['html' => $html]);
    }

}