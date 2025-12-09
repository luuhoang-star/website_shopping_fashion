<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;
    protected $table = 'system-setting';

    static public function getSingle()
    {
        return self::first() ?? self::create([]);
    }




    public function getLogo()
    {
        $path = 'upload/setting/' . $this->logo;

        if (!empty($this->logo) && file_exists(public_path($path))) {
            return url($path);
        }

        // Ảnh mặc định nếu không có ảnh hoặc file không tồn tại
        return url('assets/images/1.jpg');
    }

    public function getFevicon()
    {
        $path = 'upload/setting/' . $this->fevicon;

        if (!empty($this->fevicon) && file_exists(public_path($path))) {
            return url($path);
        }

        // Ảnh mặc định nếu không có ảnh hoặc file không tồn tại
        return url('assets/images/1.jpg');
    }

    public function getFooterPayment()
    {
        $path = 'upload/setting/' . $this->footer_payment_icon;

        if (!empty($this->footer_payment_icon) && file_exists(public_path($path))) {
            return url($path);
        }

        // Ảnh mặc định nếu không có ảnh hoặc file không tồn tại
        return url('assets/images/1.jpg');
    }



}
