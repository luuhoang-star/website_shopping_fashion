@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Đơn hàng</h1>
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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mã số đơn hàng</th>
                                            <th>Tổng tiền ($)</th>
                                            <th>Hình thức thanh toán</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Hành động</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->order_number }}</td>
                                                <td>{{ number_format((float) $value->total_amount, 2) }}</td>
                                                <td>{{ $value->payment_method }}</td>
                                                <td>
                                                    @if ($value->status == 0)
                                                        Đang Chờ
                                                    @elseif($value->status == 1)
                                                        Đang xử lý
                                                    @elseif($value->status == 2)
                                                        Đã giao hàng
                                                    @elseif($value->status == 3)
                                                        Đã hoàn thành
                                                    @elseif($value->status == 4)
                                                        Đã hủy
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('user/orders/detail/' . $value->id) }}"
                                                        class="btn btn-primary">Chi tiết</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="p-3">
                                    {{ $getRecord->links() }}
                                </div>
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
@endsection
