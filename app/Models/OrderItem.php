<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
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
    
    static public function getReview($product_id, $order_id) {
        return ProductReview::getReview($product_id, $order_id, Auth::user()->id);

    }

}
