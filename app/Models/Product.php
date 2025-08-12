<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    static public function getRecord()
    {
        return self::select('product.*', 'users.name as created_by_name') // SAI dấu chấm cũng đã sửa
            ->join('users', 'users.id', '=', 'product.created_by')
            ->where('product.is_delete', '=', 0)
            ->orderBy('product.id', 'desc')
            ->paginate(5);
    }

    static public function getProduct($category_id = '', $subcategory_id = '')
    {
        // Khởi tạo truy vấn, chọn các cột từ bảng product và JOIN thêm thông tin từ bảng khác
        $return = Product::select(
            'product.*',                            // Lấy tất cả các cột trong bảng product
            'users.name as created_by_name',        // Lấy tên người tạo sản phẩm từ bảng users
            'category.name as category_name',       // Lấy tên danh mục chính
            'sub_category.name as sub_category_name', // Lấy tên danh mục con
            'category.slug as category_slug',       // Lấy slug của danh mục chính
            'sub_category.slug as sub_category_slug'  // Lấy slug của danh mục con
        )
            ->join('users', 'users.id', '=', 'product.created_by')               // JOIN với bảng users theo người tạo
            ->join('category', 'category.id', '=', 'product.category_id')        // JOIN với bảng category theo category_id
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id'); // JOIN với bảng sub_category

        // Lọc theo danh mục chính trong bảng product
        if (!empty($category_id)) {
            $return = $return->where('product.category_id', '=', $category_id);
        }

        // Lọc theo danh mục con trong bảng product
        if (!empty($subcategory_id)) {
            $return = $return->where('product.sub_category_id', '=', $subcategory_id);
        }

        // Thêm điều kiện lọc: chỉ lấy sản phẩm chưa bị xóa và đang hoạt động
        $return = $return->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->orderBy('product.id', 'desc') // Sắp xếp theo id giảm dần (mới nhất trước)
            ->paginate(3); // Phân trang: mỗi trang 3 sản phẩm

        // Trả về kết quả
        return $return;
    }


    public function getImageSingle($product_id)
    {
        return ProductImage::where('product_id', '=', $product_id)->orderBy('order_by', 'asc')->first();
    }


    static public function getSingle($id)
    {
        return self::find($id); // trả về 1 bản ghi trong bảng product
    }

    #kiểm tra có trùng slug không(mục đích 1 cái sản phẩm chỉ 1 slug(đúng logic))
    static public function checkSlug($slug)
    {
        return self::where('slug', '=', $slug)->count(); // kiểm tra xem slug ở csl giống vs slug nhập ko rồi trả về số(0 là ko trùng)
    }
    // Trong model Product.php
    public function getColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id'); // Một sản phẩm có nhiều màu
    }

    public function getSize()
    {
        return $this->hasMany(ProductSize::class, "product_id"); // ràng buộc 1 sản phẩm có nhiều size(đúng logic )
    }

    public function getImage()
    {
        return $this->hasMany(ProductImage::class, "product_id")->orderBy('order_by', 'asc'); // ràng buộc 1 sản phẩm có nhiều Arnh(đúng logic )
    }



}
