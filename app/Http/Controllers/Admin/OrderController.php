<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\OrderStatusMail;

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

    public function order_status(Request $request)
    {
    $getOrder = Order::getSingle($request->order_id);
    $getOrder->status = $request->status;
     $getOrder->save();
    Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));
    
    $json['message'] = " Trạng thái đơn hàng đã được cập nhật thành công!";
    echo json_encode($json);

    }
   

}
