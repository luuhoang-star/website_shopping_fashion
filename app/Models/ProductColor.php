<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $table = 'product_color';

   public static function DeleteRecord($product_id)
{
    self::where('product_id', $product_id)->delete(); // xóa màu của 1 sản phẩm
}


}
