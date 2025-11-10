<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\DiscountCode;
use App\Models\ShippingCharge;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Color;
use App\Models\User;
use Auth;
use Hash;
use Stripe\Stripe;
use Session;
use Mail;
use App\Mail\OrderInvoiceMail;

class PaymentController extends Controller
{
    // 1️⃣ XỬ LÝ MÃ GIẢM GIÁ
    public function apply_discount_code(Request $request)
    {
        // Kiểm tra xem mã giảm giá có tồn tại trong CSDL không
        $getDiscount = DiscountCode::CheckDiscount($request->discount_code);

        if (!empty($getDiscount)) {
            $total = Cart::getSubTotal(); // Tổng tiền gốc (chưa giảm)

            // Nếu mã giảm giá dạng số cố định
            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $discount_amount;
            }
            // Nếu mã giảm giá dạng phần trăm (%)
            else {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }

            // Trả kết quả JSON về frontend (AJAX)
            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = "success";
        } else {
            // Nếu mã giảm giá không hợp lệ
            $json['status'] = false;
            $json['discount_amount'] = 0.00;
            $json['payable_total'] = Cart::getSubTotal();
            $json['message'] = "Discount Code Invalid";
        }

        echo json_encode($json);
    }

    // 2️⃣ TRANG THANH TOÁN (CHECKOUT PAGE)
    public function checkout(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        // Lấy danh sách phí vận chuyển
        $data['getShipping'] = ShippingCharge::getRecordActive();

        // Hiển thị view checkout
        return view('payment.checkout', $data);
    }

    // 3️⃣ TRANG GIỎ HÀNG
    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';
        return view('payment.cart', $data);
    }

    // 4️⃣ XÓA MỘT SẢN PHẨM KHỎI GIỎ
    public function cart_delete($id)
    {
        Cart::remove($id); // Xóa sản phẩm theo id
        return redirect()->back();
    }

    // 5️⃣ THÊM SẢN PHẨM VÀO GIỎ HÀNG
    public function add_to_cart(Request $request)
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;

        // Nếu có chọn kích thước, cộng thêm giá size
        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSize::getSingle($size_id);
            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total += $size_price;
        } else {
            $size_id = 0;
        }

        // Nếu có chọn màu
        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        // Thêm vào giỏ hàng
        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => [
                'size_id' => $size_id,
                'color_id' => $color_id,
            ]
        ]);

        return redirect()->back();
    }

    // 6️⃣ CẬP NHẬT GIỎ HÀNG (SỐ LƯỢNG)
    public function update_cart(Request $request)
    {
        foreach ($request->cart as $cart) {
            Cart::update($cart['id'], [
                'quantity' => [
                    'relative' => false,
                    'value' => $cart['qty']
                ],
            ]);
        }
        return redirect()->back();
    }

    // 7️⃣ XỬ LÝ ĐẶT HÀNG (PLACE ORDER)
    public function place_order(Request $request)
    {
        $validate = 0;
        $message = '';

        // Nếu người dùng đã đăng nhập
        if (!empty(Auth::check())) {
            $user_id = Auth::user()->id;
        }
        // Nếu chưa đăng nhập
        else {
            // Nếu chọn tạo tài khoản mới
            if (!empty($request->is_create)) {
                $checkEmail = User::checkEmail($request->email);

                // Email đã tồn tại
                if (!empty($checkEmail)) {
                    $message = "Email đã đăng ký, vui lòng chọn email khác";
                    $validate = 1;
                } else {
                    // Tạo user mới
                    $save = new User;
                    $save->name = trim($request->first_name);
                    $save->email = trim($request->email);
                    $save->password = Hash::make($request->password);
                    $save->save();

                    $user_id = $save->id;
                }
            } else {
                $user_id = '';
            }
        }

        if (empty($validate)) {
            // Lấy phí ship
            $getShipping = ShippingCharge::getSingle($request->shipping);
            $payable_total = Cart::getSubTotal();
            $discount_amount = 0;
            $discount_code = '';

            // Nếu có nhập mã giảm giá
            if (!empty($request->discount_code)) {
                $getDiscount = DiscountCode::CheckDiscount($request->discount_code);
                if (!empty($getDiscount)) {
                    $discount_code = $request->discount_code;
                    if ($getDiscount->type == 'Amount') {
                        $discount_amount = $getDiscount->percent_amount;
                        $payable_total -= $discount_amount;
                    } else {
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total -= $discount_amount;
                    }
                }
            }

            // Tính tổng tiền
            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $total_amount = $payable_total + $shipping_amount;

            // Lưu đơn hàng
            $order = new Order;
            if (!empty($user_id)) {
                $order->user_id = trim($user_id);
            }
            $order->order_number = mt_rand(100000000, 999999999);
            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->company_name = trim($request->company_name);
            $order->country_name = trim($request->country_name);
            $order->address_one = trim($request->address_one);
            $order->address_two = trim($request->address_two);
            $order->city = trim($request->city);
            $order->state = trim($request->state);
            $order->postcode = trim($request->postcode);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->note = trim($request->note);
            $order->discount_amount = trim($request->discount_amount);
            $order->discount_code = trim($request->discount_code);
            $order->shipping_id = trim($request->shipping);
            $order->shipping_amount = trim($shipping_amount);
            $order->total_amount = trim($total_amount);
            $order->payment_method = trim($request->payment_method);
            $order->save();

            // Lưu chi tiết sản phẩm trong đơn hàng
            foreach (Cart::getContent() as $cart) {
                $order_item = new OrderItem;
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart->id;
                $order_item->quantity = $cart->quantity;
                $order_item->price = $cart->price;

                // Thêm thông tin màu và size
                $color_id = $cart->attributes->color_id;
                if (!empty($color_id)) {
                    $getColor = Color::getSingle($color_id);
                    $order_item->color_name = $getColor->name;
                }

                $size_id = $cart->attributes->size_id;
                if (!empty($size_id)) {
                    $getSize = ProductSize::getSingle($size_id);
                    $order_item->size_name = $getSize->name;
                    $order_item->size_amount = $getSize->price;
                }

                $order_item->total_price = $cart->price;
                $order_item->save();
            }

            // Trả kết quả JSON cho frontend
            $json['status'] = true;
            $json['message'] = "order success";
            $json['redirect'] = url('checkout/payment?order_id=' . base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }

        echo json_encode($json);
    }

    // 8️⃣ XỬ LÝ THANH TOÁN SAU KHI ĐẶT HÀNG
    public function checkout_payment(Request $request)
    {
        // Kiểm tra dữ liệu hợp lệ
        if (!empty(Cart::getSubTotal()) && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);
            $getOrder = Order::getSingle($order_id);

            if (!empty($getOrder)) {
                // Nếu thanh toán bằng tiền mặt
                if ($getOrder->payment_method == 'cash') {
                    $getOrder->is_payment = 1;
                    $getOrder->save();
                    Cart::clear();
                    return redirect('cart')->with('success', "Order successfully placed");
                }
                // Nếu thanh toán bằng PayPal
                else if ($getOrder->payment_method == 'paypal') {
                    $query = [
                        'business' => "luuvanhoang2k4@gmail.com",
                        'cmd' => '_xclick',
                        'item_name' => 'E-commerce',
                        'no_shipping' => '1',
                        'item_number' => $getOrder->id,
                        'amount' => $getOrder->total_amount,
                        'currency_code' => 'USD',
                        'cancel_return' => url('checkout'),
                        'return' => url('paypal/success-payment'),
                    ];

                    $query_string = http_build_query($query);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
                    exit();
                }
                // Nếu thanh toán bằng Stripe
                else if ($getOrder->payment_method == 'stripe') {
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $finalprice = $getOrder->total_amount * 100; // đơn vị cent

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => $getOrder->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [
                            [
                                'price_data' => [
                                    'currency' => 'usd',
                                    'product_data' => ['name' => 'E-commerce'],
                                    'unit_amount' => $finalprice,
                                ],
                                'quantity' => 1,
                            ]
                        ],
                        'mode' => 'payment',
                        'success_url' => url('stripe/payment-success'),
                        'cancel_url' => url('checkout'),
                    ]);

                    // Lưu session Stripe
                    $getOrder->stripe_session_id = $session['id'];
                    $getOrder->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublicKey'] = env('STRIPE_KEY');

                    // Trả về view thanh toán Stripe
                    return view('payment.stripe_charge', $data);
                } else {
                    exit();
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    // 9️⃣ XỬ LÝ THANH TOÁN THÀNH CÔNG VỚI PAYPAL
    public function paypal_success_payment(Request $request)
    {
     
      if (!empty($request->item_number) && !empty($request->st) && 
    ($request->st == 'Completed' || $request->st == 'Pending')) {
    
    $getOrder = Order::getSingle($request->item_number);

    if (!empty($getOrder)) {
        $getOrder->is_payment = 1;
        $getOrder->transaction_id = $request->txn_id ?? $request->tx;
        $getOrder->payment_data = json_encode($request->all());
        $getOrder->save();

        Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

        return redirect('cart')->with('success', 'Order successfully placed (sandbox test)!');
    } else {
        abort(404);
    }
}

    }

    // 🔟 XỬ LÝ THANH TOÁN THÀNH CÔNG VỚI STRIPE
    public function stripe_success_payment(Request $request)
    {
        $trans_id = Session::get('stripe_session_id');
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);

        $getOrder = Order::where('stripe_session_id', '=', $getdata->id)->first();

        if (!empty($getOrder) && !empty($getdata->id) && $getdata->id == $getOrder->stripe_session_id) {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getdata->id;
            $getOrder->payment_data = json_encode($getdata);
            $getOrder->save();

            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

            Cart::clear();
            return redirect('cart')->with('success', "Order successfully placed");
        } else {
            return redirect('cart')->with('error', "Due to some error please try again");
        }
    }
}
