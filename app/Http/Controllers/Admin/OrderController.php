<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Order::getRecord();
        $data['header_title'] = 'Order';
        return view('admin.order.list', $data);
    }

    public function order_detail($id)
    {
        $data['getRecord'] = Order::getSingle($id);
        $data['header_title'] = 'Order Detail';
        return view('admin.order.detail', $data);
    }
   

}
