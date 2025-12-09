<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
     protected $table = 'contact_us';
      static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord() {
        return self::select('contact_us.*')
            ->orderBy('contact_us.id', 'desc')
            ->paginate(20);
    }

    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
