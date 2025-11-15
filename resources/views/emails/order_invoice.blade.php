<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 8px; overflow: hidden;">
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #007bff; color: #fff;">
                <h1 style="margin: 0;">E-Commerce</h1>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px;">
                <p>Dear {{ $order->first_name }},</p>

                <p>Thank you for your recent purchase with <strong>E-Commerce</strong>. We are pleased to confirm your order.</p>

                <h3 style="margin-top: 20px;">Order Details:</h3>
                <ul style="padding-left: 20px;">
                    <li>Order Number: {{ $order->order_number }}</li>
                    <li>Date of Purchase: {{ date('d-m-Y', strtotime($order->created_at)) }}</li>
                </ul>

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
                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">${{ number_format($item->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p style="margin-top: 20px;">Shipping Name: <strong>{{ $order->getShipping->name }}</strong></p>
                <p>Shipping Amount: <strong>${{ number_format($order->shipping_amount, 2) }}</strong></p>

                @if(!empty($order->discount_code))
                    <p>Discount Code: <strong>{{ $order->discount_code }}</strong></p>
                    <p>Discount Amount: <strong>${{ number_format((float)$order->discount_amount, 2) }}</strong></p>
                @endif

                <p style="font-size: 16px; margin-top: 10px;">Total Amount: <strong>${{ number_format($order->total_amount, 2) }}</strong></p>

                <p style="text-transform: capitalize;">Payment Method: <strong>{{ $order->payment_method }}</strong></p>

                <p style="margin-top: 20px;">Thank you for choosing <strong>E-Commerce</strong>. We appreciate your business.</p>

                <p style="margin-top: 30px;">Thanks,<br>{{ config('app.name') }}</p>
            </td>
        </tr>

        <tr>
            <td style="padding: 10px; text-align: center; background-color: #f0f0f0; font-size: 12px; color: #555;">
                &copy; {{ date('Y') }} E-Commerce. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
