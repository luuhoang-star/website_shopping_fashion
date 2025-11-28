@extends('admin.layouts.app') <!-- kế thừa mới nạp giao diện ở dưới vô app đc -->
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Chi tiết đơn hàng</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card card-primary">

                            <div class="card-body">
                                <div class="form-group">
                                    <label>ID : <span style="font-weight: normal;"> {{ $getRecord->id }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>ID giao dịch : <span style="font-weight: normal;">
                                            {{ $getRecord->transaction_id }}</span>
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
                                    <label>Mã khu vực : <span style="font-weight: normal;"> {{ $getRecord->postcode }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>SỐ điện thoại : <span style="font-weight: normal;"> {{ $getRecord->phone }}</span>
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

                        </div>



                    </div>


                    <!-- /.card -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
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
                                            <th>Tên màu sắc</th>
                                            <th>Kích cỡ</th>
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
                                                <td>
                                                    <a target="_blank" href="{{ url($item->getProduct->slug) }}">
                                                        {{ $item->getProduct->title }}
                                                    </a>
                                                </td>

                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>

                                                <td>{{ $item->color_name }}</td>
                                                <td>{{ $item->size_name }}</td>
                                                <td>{{ number_format($item->size_amount, 2) }}</td>
                                                <td>{{ number_format($item->total_price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
