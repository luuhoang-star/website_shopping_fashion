@extends('layouts.app')
@section('style')
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Cửa hàng<span>thanh toán</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Cửa hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <form action="" id="SubmitForm" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Chi tiết hóa đơn</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Tên *</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Họ *</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Tên công ty (Không bắt buộc)</label>
                                <input type="text" name="company_name" class="form-control">

                                <label>Quốc gia *</label>
                                <input type="text" name="country_name" class="form-control" required>

                                <label>Địa chỉ đường *</label>
                                <input type="text" name="address_one" class="form-control"
                                    placeholder="Số nhà và tên đường" required>
                                <input type="text" name="address_two" class="form-control"
                                    placeholder="Căn hộ, phòng, đơn vị…" required>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Thành phố *</label>
                                        <input type="text" name="city" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Khu vực*</label>
                                        <input type="text" name="state" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Mã thành phố / ZIP *</label>
                                        <input type="text" name="postcode" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Số điện thoại *</label>
                                        <input type="tel" name="phone" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Email *</label>
                                <input type="email" name="email" class="form-control" required>

                                @if(empty(Auth::check()))
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_create" class="custom-control-input createAccount" id="checkout-create-acc">
                                    <label class="custom-control-label" for="checkout-create-acc">Tạo một tài khoản?</label>
                                </div><!-- End .custom-checkbox -->

                                <div id="showPassword" style="display: none;">
                                    <label>Mật khẩu</label>
                                    <input type="text" id="inputPassword" name="password" class="form-control">
                                </div>
                                @endif

                                <label>Ghi chú đơn hàng (Không bắt buộc)</label>
                                <textarea class="form-control" name="note" cols="30" rows="4"
                                    placeholder="Ghi chú về đơn hàng của bạn, ví dụ: hàng dễ vỡ đó nha!"></textarea>
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Đơn hàng của bạn</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach (Cart::getContent() as $key => $cart)
                                                @php
                                                    $getCartProduct = App\Models\Product::getSingle($cart->id);
                                                @endphp
                                                <tr>
                                                    <td><a
                                                            href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }}</a>
                                                    </td>
                                                    <td>${{ number_format($cart->price * $cart->quantity, 2) }}</td>

                                                </tr>
                                            @endforeach
                                            <tr class="summary-subtotal">
                                                <td>Tổng tiền:</td>
                                                <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                            </tr><!-- End .summary-subtotal -->
                                            <tr>
                                                <td colspan="2">
                                                    <div class="cart-discount">
                                                        <div class="input-group">
                                                            <input type="text" name="discount_code" id="getDiscountCode" class="form-control"
                                                                placeholder="Mã giảm giá">
                                                            <div class="input-group-append">
                                                                <button id="ApplyDiscount"
                                                                    style="height: 38px;"type="button"
                                                                    class="btn btn-outline-primary-2" type="submit"><i
                                                                        class="icon-long-arrow-right"></i></button>
                                                            </div><!-- .End .input-group-append -->
                                                        </div><!-- End .input-group -->
                                                    </div><!-- End .cart-discount -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mã giảm giá:</td>
                                                <td>$<span id="getDiscountAmount">0.00</span></td>
                                            </tr><!-- End .summary-subtotal -->

                                            <tr class="summary-shipping">
                                                <td>Phí vận chuyển:</td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            @foreach ($getShipping as $shipping)
                                                <tr class="summary-shipping-row">
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" value="{{ $shipping->id }}" id="free-shipping{{ $shipping->id }}"
                                                                name="shipping" required
                                                                data-price="{{ !empty($shipping->price) ? $shipping->price : 0 }}"
                                                                class="custom-control-input getShippingCharge">
                                                            <label class="custom-control-label"
                                                                for="free-shipping{{ $shipping->id }}">{{ $shipping->name }}</label>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        @if (!empty($shipping->price))
                                                            ${{ number_format((float) $shipping->price, 2) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach



                                            <tr class="summary-total">

                                                <td>Tổng tiền:</td>
                                                <td>$<span
                                                        id="getPayableTotal">${{ number_format(Cart::getSubTotal(), 2) }}</span>
                                                </td>

                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->
                                    <input type="hidden" id="getShippingChargeTotal" value="0">
                                    <input type="hidden" id="PayableTotal" value="{{ Cart::getSubTotal() }}">

                                    <div class="accordion-summary" id="accordion-payment">

                                        <div class="custom-control custom-radio" style="margin-top: 0px;">
                                            <input type="radio" value="cash" id="Cashondelivery" name="payment_method" required
                                                class="custom-control-input">
                                            <label class="custom-control-label"
                                                for="Cashondelivery">Thanh toán khi nhận hàng</label>
                                        </div>

                                        
                                        <div class="custom-control custom-radio" style="margin-top: 0px;">
                                            <input type="radio" value="paypal" id="PayPal" name="payment_method" required
                                                class="custom-control-input">
                                            <label class="custom-control-label"
                                                for="PayPal">Payable</label>
                                        </div>

                                        
                                        <div class="custom-control custom-radio">
                                            <input type="radio" value="stripe" id="CreditCard" name="payment_method" required
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="CreditCard">Credit Card (Stripe)</label>
                                        </div>


               
                                    </div><!-- End .accordion -->

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Đặt hàng</span>
                                        <span class="btn-hover-text">Tiến hành thanh toán</span>
                                    </button>
                                    <br /><br />
                                    <img src="{{ url('assets/images/payments-summary.png') }}" alt="payments cards">
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
    <script type="text/javascript">

        $('body').delegate('.createAccount', 'change', function() {
            if(this.checked) {
                $('#showPassword').show();
                $("#inputPassword").prop('required',true);
            } else {
                $('#showPassword').hide();
                $("#inputPassword").prop('required',false);
            }
        });

        $('body').delegate('#SubmitForm','submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url : "{{ url('checkout/place_order') }}",
                data : new FormData(this),
                processData:false,
                contentType:false,
                dataType: "json",
                success: function(data) {
                    if(data.status == false) {
                        alert(data.message);
                    }
                else {
                    window.location.href = data.redirect;
                }
                },
                error: function (data) {

                }
            });
        });

        $('body').delegate('.getShippingCharge', 'click', function() {
            var price = $(this).attr('data-price');
            var total = $('#PayableTotal').val();
            $('#getShippingChargeTotal').val(price);
            var final_total = parseFloat(price) + parseFloat(total);
            $('#getPayableTotal').html(final_total.toFixed(2));
        });


        $('body').delegate('#ApplyDiscount', 'click', function() {
            var discount_code = $('#getDiscountCode').val();

            $.ajax({
                type: "POST",
                url: "{{ url('checkout/apply_discount_code') }}",
                data: {
                    discount_code: discount_code,
                    "_token": "{{ csrf_token() }}",
                },
                dataType: "json",
                "success": function(data) {
                    $('#getDiscountAmount').html(data.discount_amount) // số tiền giảm giá
                    var shipping = $('#getShippingChargeTotal').val();
                    var final_total = parseFloat(shipping) + parseFloat(data.payable_total);
                    $('#getPayableTotal').html(final_total.toFixed(2));
                    $('#PayableTotal').val(data.payable_total);
                    if (data.status == true) {
                        alert(data.message);
                    }
                },
                error: function(data) {

                }
            });
        });
    </script>
@endsection
