<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_category';

    static public function getSingle($id)
    {
        return self::find($id);
    }

       static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('sub_category.status', '=', 0)
            ->where('sub_category.is_delete', '=', 0)
            ->first();
    }

    static public function getRecord()
    {
        return self::select('sub_category.*', 'users.name as created_by_name', 'category.name as category_name') // lấy tất cả bảng danh mục phụ ,người tạo danh mục phụ này ,tên danh mục phụ thuộc danh mục chính nào
            ->join('category', 'category.id', '=', 'sub_category.category_id')
            ->join('users', 'users.id', '=', 'sub_category.created_by')
            ->where('sub_category.is_delete', '=', 0)
            ->orderBy('sub_category.id', 'desc')
            ->paginate(5);
    }

 static public function getRecordSubCategory($category_id)
{
    return self::select('sub_category.*') // lấy tất cả cột trong bảng sub_category
        ->join('users', 'users.id', '=', 'sub_category.created_by') // nối với bảng users để biết ai tạo
        ->where('sub_category.is_delete', '=', 0) // chỉ lấy các mục chưa bị xóa
        ->where('sub_category.status', '=', 0) // chỉ lấy mục đang hoạt động
        ->where('sub_category.category_id', '=', $category_id) // lọc theo category cha
        ->orderBy('sub_category.id', 'desc') // sắp xếp ID giảm dần (mới nhất trước)
        ->get(); // thực hiện truy vấn và trả kết quả
}

}
