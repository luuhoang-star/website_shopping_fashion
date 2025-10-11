<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_size';

       static public function getSingle($id)
    {
        return self::find($id); // trả về 1 bản ghi trong bảng product size
    }
    static public function DeleteRecord($product_id) {
        self::where('product_id', '=', $product_id)->delete(); // xóa size của 1 sản phẩm
    }
}
