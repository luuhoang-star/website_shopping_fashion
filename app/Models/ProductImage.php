<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    static public function getSingle($id)
    {
        return self::find($id);
    }

   public function getLogo()
{
    $path = 'upload/product/' . $this->image_name;

    if (!empty($this->image_name) && file_exists(public_path($path))) {
        return url($path);
    }

    // Ảnh mặc định nếu không có ảnh hoặc file không tồn tại
    return url('assets/images/1.jpg');
}


}
