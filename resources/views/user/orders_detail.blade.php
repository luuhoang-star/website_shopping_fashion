@extends('layouts.app')
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Chi tiết đơn hàng</h1>
            </div><!-- End .container -->
        </div>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">

                    <br />
                    <div class="row">
                        @include('user._sidebar')

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                @include('layouts._message')
                                <div class="">

                                    <div class="form-group">
                                        <label>ID : <span style="font-weight: normal;">
                                                {{ $getRecord->order_number }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Họ tên : <span style="font-weight: normal;"> {{ $getRecord->first_name }} ,
                                                {{ $getRecord->last_name }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Tên công ty : <span style="font-weight: normal;">
                                                {{ $getRecord->company_name }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Tên quốc gia : <span style="font-weight: normal;">
                                                {{ $getRecord->country_name }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Địa chỉ : <span style="font-weight: normal;"> {{ $getRecord->address_one }},
                                                {{ $getRecord->address_two }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Thành phố : <span style="font-weight: normal;"> {{ $getRecord->city }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Khu vực : <span style="font-weight: normal;"> {{ $getRecord->state }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Mã khu vực : <span style="font-weight: normal;">
                                                {{ $getRecord->postcode }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>SỐ điện thoại : <span style="font-weight: normal;">
                                                {{ $getRecord->phone }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Email : <span style="font-weight: normal;"> {{ $getRecord->email }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Mã giảm giá : <span style="font-weight: normal;">
                                                {{ $getRecord->discount_code }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Số tiền giảm giá : <span style="font-weight: normal;">
                                                {{ number_format((float) $getRecord->discount_amount, 2) }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Phí vận chuyển : <span style="font-weight: normal;">
                                                {{ $getRecord->getShipping->name }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Tiền vận chuyển : <span style="font-weight: normal;">
                                                {{ number_format((float) $getRecord->shipping_amount, 2) }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Tổng tiền($) : <span style="font-weight: normal;">
                                                {{ number_format((float) $getRecord->total_amount, 2) }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Hình thức thanh toán : <span style="font-weight: normal;">
                                                {{ $getRecord->payment_method }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng thái :
                                            @if ($getRecord->status == 0)
                                                Đang Chờ
                                            @elseif($getRecord->status == 1)
                                                Đang xử lý
                                            @elseif($getRecord->status == 2)
                                                Đã giao hàng
                                            @elseif($getRecord->status == 3)
                                                Đã hoàn thành
                                            @elseif($getRecord->status == 4)
                                                Đã hủy
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Ghi chú : <span style="font-weight: normal;"> {{ $getRecord->note }}</span>
                                            <label>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày tạo : <span style="font-weight: normal;">
                                                {{ date('d-m-Y', strtotime($getRecord->created_at)) }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" style="margin-top: 20px;">
                                        <h3 class="card-title">Chi tiết sản phẩm</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0" style="overflow: auto;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>

                                                    <th>Tiền kích cỡ($)</th>
                                                    <th>Tổng tiền ($)</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($getRecord->getItem as $item)
                                                    @php
                                                        $getProductImage = $item->getProduct->getImageSingle(
                                                            $item->getProduct->id,
                                                        );
                                                    @endphp

                                                    <tr>
                                                        <td>
                                                            <img style="width: 100px; height: 100px;"
                                                                src="{{ $getProductImage->getLogo() }}">
                                                        </td>
                                                        <td style="max-width: 300px;">
                                                            <a target="_blank" href="{{ url($item->getProduct->slug) }}">
                                                                {{ $item->getProduct->title }}
                                                            </a>
                                                            <br>
                                                            @if (!empty($item->color_name))
                                                                <b>Tên màu sắc:</b> {{ $item->color_name }} <br />
                                                            @endif
                                                            @if (!empty($item->size_name))
                                                                <b>Tên kích cỡ:</b> {{ $item->size_name }} <br />
                                                            @endif
                                                            @if ($getRecord->status == 3)
                                                                @php
                                                                    $getReview = $item->getReview(
                                                                        $item->getProduct->id,
                                                                        $getRecord->id,
                                                                    );
                                                                @endphp
                                                                @if (!empty($getReview))
                                                                    Sao : {{ $getReview->rating }} <br>
                                                                    Đánh giá : {{ $getReview->review }} <br>
                                                                @else
                                                                    <button class="btn btn-primary MakeReview"
                                                                        id="{{ $item->getProduct->id }}"
                                                                        data-order="{{ $getRecord->id }}">
                                                                        Đánh giá sản phẩm
                                                                    </button>
                                                                @endif
                                                                @endif
                                                        </td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->price }}</td>
                                                        <td>{{ number_format($item->size_amount, 2) }}</td>
                                                        <td>{{ number_format($item->total_price, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>


                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <div class="modal fade" id="MakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đánh giá sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('user/make-review') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" required id="getProductId" name="product_id">
                    <input type="hidden" required id="getOrderId" name="order_id">
                    <div class="modal-body" style="padding: 20px;">
                        <div class="form-group">
                            <label>Bạn muốn đánh giá bao nhiêu sao?</label>
                            <select class="form-control" required name="rating">
                                <option value="">Chọn</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Đánh giá</label>
                            <textarea class="form-control" required name="review"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('body').delegate('.MakeReview', 'click', function() {
            var product_id = $(this).attr('id');
            var order_id = $(this).attr('data-order');
            $('#getProductId').val(product_id)
            $('#getOrderId').val(order_id)
            $('#MakeReviewModal').modal('show');
        })
    </script>
@endsection
