<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orders_item';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function getProduct() {
        return $this->belongsTo(Product::class, 'product_id'); // mỗi orderitem thuộc về  1product
    }
    

}
