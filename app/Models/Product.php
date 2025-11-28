<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use Auth;

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

    static public function getMyWishlist($user_id)
    {
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
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id') // JOIN với bảng sub_category
            ->join('product_wishlist', 'product_wishlist.product_id', '=', 'product.id')
            ->where('product_wishlist.user_id','=', $user_id)
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc') // Sắp xếp theo id giảm dần (mới nhất trước)
            ->paginate(3); // Phân trang

        return $return;
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
        if (!empty(Request::get('sub_category_id'))) {
            $sub_category_id = trim(Request::get('sub_category_id'), ',');
            $sub_category_id_array = explode(",", $sub_category_id);

            $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
        } else {
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('product.category_id', '=', Request::get('old_category_id'));
            }

            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where(
                    'product.sub_category_id',
                    '=',
                    Request::get('old_sub_category_id')
                );
            }
        }

        if (!empty(Request::get('color_id'))) {
            $color_id = trim(Request::get('color_id'), ',');
            $color_id_array = explode(",", $color_id);
            $return = $return->join('product_color', 'product_color.product_id', '=', 'product.id');
            $return = $return->whereIn('product_color.color_id', $color_id_array);
        }

        if (!empty(Request::get('brand_id'))) {
            $brand_id = trim(Request::get('brand_id'), ',');
            $brand_id_array = explode(",", $brand_id);

            $return = $return->whereIn('product.brand_id', $brand_id_array);
        }

        if (!empty(Request::get('start_price')) && !empty(Request::get('end_price'))) {
            $start_price = str_replace('$', '', Request::get('start_price'));
            $end_price = str_replace('$', '', Request::get('end_price'));

            $return = $return->where('product.price', '>=', $start_price);
            $return = $return->where('product.price', '<=', $end_price);
        }
        if (!empty(Request::get('q'))) {
            $return = $return->where('product.title', 'like', '%' . Request::get('q') . '%');
        }

        // Thêm điều kiện lọc: chỉ lấy sản phẩm chưa bị xóa và đang hoạt động
        $return = $return->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc') // Sắp xếp theo id giảm dần (mới nhất trước)
            ->paginate(30); // Phân trang: mỗi trang 3 sản phẩm

        // Trả về kết quả
        return $return;
    }


    static public function getRelatedProduct($product_id, $sub_category_id)
    {
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
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id') // JOIN với bảng sub_category
            ->where('product.id', '!=', $product_id)
            ->where('product.sub_category_id', '=', $sub_category_id)
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->limit(10)
            ->get();

        return $return;
    }

    public function getImageSingle($product_id)
    {
        return ProductImage::where('product_id', '=', $product_id)->orderBy('order_by', 'asc')->first();
    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('product.is_delete', ' =', 0)
            ->where('product.status', '=', 0)
            ->first();

    }



    static public function getSingle($id)
    {
        return self::find($id); // trả về 1 bản ghi trong bảng product
    }

    static public function checkWishlist($product_id)
    {
        return ProductWishlist::checkAlready($product_id, Auth::user()->id);
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

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id'); // mqh 1:1.1 sp thuộc nhiều danh mục
    }

    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

}
