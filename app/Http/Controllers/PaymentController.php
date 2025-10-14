<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\DiscountCode;
use App\Models\ShippingCharge;
class PaymentController extends Controller
{

    public function apply_discount_code(Request $request)
    {
        $getDiscount = DiscountCode::CheckDiscount($request->discount_code); // nhận request và kiểm tra request code sale có = vs name trong csdl
        if (!empty($getDiscount)) {
            $total = Cart::getSubTotal(); // Tổng tiền khi chưa giảm
            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->percent_amount; // trỏ đến mã cố định
                $payable_total = $total - $getDiscount->percent_amount; // trả về số tiền khi trừ mã giảm giá cố định
            } else {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100; // trỏ đến mã %
                $payable_total = $total - $discount_amount; //trả về số tiền  khi trừ mã giảm giá dạng %
            }

            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = "success";


        } else {
            $json['status'] = false;
            $json['discount_amount'] = 0.00;
            $json['payable_total'] = Cart::getSubTotal();

            $json['message'] = "Discount Code Invalid";
        }
        echo json_encode($json);
    }

    public function checkout(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        $data['getShipping'] = ShippingCharge::getRecordActive();

        return view('payment.checkout', $data);
    }

    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        return view('payment.cart', $data);
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
    public function add_to_cart(Request $request)
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;
        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSize::getSingle($size_id);

            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        } else {
            $size_id = 0;
        }
        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id,
            )
        ]);
        return redirect()->back();
    }
    public function update_cart(Request $request)
    {
        foreach ($request->cart as $cart) {
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }
        return redirect()->back();
    }
}
