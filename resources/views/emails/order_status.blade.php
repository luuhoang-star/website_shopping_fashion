<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 20px; color: #333;">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 8px; overflow: hidden;">

        <!-- Header -->
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #007bff; color: #fff;">
                <h1 style="margin: 0; font-size: 28px;">E-Commerce</h1>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 20px;">

                <p>Dear <strong>{{ $order->first_name }}</strong>,</p>

                <p>
                    Order Status : 
                    <b>
                        @switch($order->status)
                            @case(0) Chờ xử lý @break
                            @case(1) Đang xử lý @break
                            @case(2) Đã giao hàng @break
                            @case(3) Hoàn thành @break
                            @case(4) Đã hủy @break
                        @endswitch
                    </b>
                </p>

                <h3 style="margin-top: 20px; font-size: 20px;">Order Details:</h3>

                <ul style="padding-left: 20px; line-height: 1.6;">
                    <li><strong>Order Number:</strong> {{ $order->order_number }}</li>
                    <li><strong>Date of Purchase:</strong> {{ date('d-m-Y', strtotime($order->created_at)) }}</li>
                </ul>

                <!-- Order Items -->
                <table width="100%" style="border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 2px solid #007bff; padding: 8px; text-align: left;">Item</th>
                            <th style="border-bottom: 2px solid #007bff; padding: 8px; text-align: left;">Quantity</th>
                            <th style="border-bottom: 2px solid #007bff; padding: 8px; text-align: left;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->getItem as $item)
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                {{ $item->getProduct->title }}<br>
                                Color: {{ $item->color_name }}
                                
                                @if(!empty($item->size_name))
                                    <br>Size: {{ $item->size_name }}
                                    <br>Size Amount: ${{ number_format($item->size_amount, 2) }}
                                @endif
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                {{ $item->quantity }}
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                ${{ number_format($item->total_price, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Shipping -->
                <p style="margin-top: 20px;">Shipping Name: <strong>{{ $order->getShipping->name }}</strong></p>
                <p>Shipping Amount: <strong>${{ number_format($order->shipping_amount, 2) }}</strong></p>

                <!-- Discount -->
                @if(!empty($order->discount_code))
                    <p>Discount Code: <strong>{{ $order->discount_code }}</strong></p>
                    <p>Discount Amount: <strong>${{ number_format($order->discount_amount, 2) }}</strong></p>
                @endif

                <!-- Total -->
                <p style="font-size: 18px; margin-top: 15px;">
                    Total Amount: <strong>${{ number_format($order->total_amount, 2) }}</strong>
                </p>

                <p style="text-transform: capitalize;">
                    Payment Method: <strong>{{ $order->payment_method }}</strong>
                </p>

                <p style="margin-top: 25px;">
                    Thank you for choosing <strong>E-Commerce</strong>. We appreciate your business.
                </p>

                <p style="margin-top: 30px;">
                    Thanks,<br>
                    <strong>{{ config('app.name') }}</strong>
                </p>

            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding: 10px; text-align: center; background-color: #f0f0f0; font-size: 12px; color: #555;">
                &copy; {{ date('Y') }} E-Commerce. All rights reserved.
            </td>
        </tr>

    </table>
</body>
</html>
