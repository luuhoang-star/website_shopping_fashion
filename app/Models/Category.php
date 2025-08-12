<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSingleSlug($slug) // $slug ở url truyền vào từ biến động {slug}
    {
        return self::where('slug', '=', $slug)
            ->where('category.status', '=', 0)
            ->where('category.is_delete', '=', 0)
            ->first();
    }

    static public function getRecord()
    {
        return self::select('category.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('category.is_delete', '=', 0)
            ->orderBy('category.id', 'desc')
            ->get();
    }

    static public function getRecordActive()
    {
        return self::select('category.*') // lấy tất cả  bảng category
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('category.is_delete', '=', 0)
            ->where('category.status', '=', 0)
            ->orderBy('category.name', 'asc')
            ->get();
    }
    static public function getRecordMenu()  // hiện menu trong shop
    {
        return self::select('category.*') // lấy tất cả  bảng category
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('category.is_delete', '=', 0)
            ->where('category.status', '=', 0)
            ->orderBy('category.name', 'asc')
            ->get();
    }
    public function getSubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id')->where('sub_category.status', '=', 0)
            ->where('sub_category.is_delete', '=', 0); // Một sản phẩm có nhiều màu
    }


}
