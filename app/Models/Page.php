<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'page';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('page.*')->get();
    }

    public static function getSlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getImage()
    {
        $path = 'upload/page/' . $this->image_name;

        if (!empty($this->image_name) && file_exists(public_path($path))) {
            return url($path);
        }

        // Ảnh mặc định nếu không có ảnh hoặc file không tồn tại
        return url('assets/images/1.jpg');
    }


}
