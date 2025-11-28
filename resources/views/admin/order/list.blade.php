@extends('admin.layouts.app') <!-- kế thừa mới nạp giao diện ở dưới vô app đc -->
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách đơn hàng (Tổng: {{ $getRecord->total() }})</h1>
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

                        <!-- /.card -->
                        @include('admin.layouts._message')

                        <form method="get">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tìm kiếm đơn hàng</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="text" name="id" placeholder="ID" class="form-control"
                                                    value="{{ Request::get('id') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tên công ty</label>
                                                <input type="text" name="company_name" placeholder="Tên công ty"
                                                    class="form-control" value="{{ Request::get('company_name') }}">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tên</label>
                                                <input type="text" name="first_name" placeholder="Tên"
                                                    class="form-control" value="{{ Request::get('first_name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Họ</label>
                                                <input type="text" name="last_name" placeholder="Họ"
                                                    class="form-control" value="{{ Request::get('last_name') }}">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" placeholder="Email"
                                                    class="form-control" value="{{ Request::get('email') }}">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quốc gia</label>
                                                <input type="text" name="country_name" placeholder="Quốc gia"
                                                    class="form-control" value="{{ Request::get('country_name') }}">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Khu vực</label>
                                                <input type="text" name="state" placeholder="Khu vực"
                                                    class="form-control" value="{{ Request::get('state') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Thành phố</label>
                                                <input type="text" name="city" placeholder="Thành phố" class="form-control"
                                                    value="{{ Request::get('city') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input type="text" name="phone" placeholder="Số điện thoại"
                                                    class="form-control" value="{{ Request::get('phone') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Mã khu vực</label>
                                                <input type="text" name="postcode" placeholder="Mã khu vực"
                                                    class="form-control" value="{{ Request::get('postcode') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Ngày bắt đầu</label>
                                                <input type="date" style="padding: 6px;" name="from_date"
                                                    placeholder="Ngày bắt đầu" class="form-control"
                                                    value="{{ Request::get('from_date') }}">
                                            </div>
                                        </div>



                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Ngày kết thúc</label>
                                                <input type="date" style="padding: 6px;" name="to_date"
                                                    placeholder="Ngày kết thúc" class="form-control"
                                                    value="{{ Request::get('to_date') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary">Tìm kiếm</button>
                                            <a href="{{ url('admin/order/list') }}" class="btn btn-primary">Reset</a>
                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách đơn hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Họ tên</th>
                                            <th>Tên công ty</th>
                                            <th>Quốc gia</th>
                                            <th>Địa chỉ</th>
                                            <th>Thành phố</th>
                                            <th>Khu vực</th>
                                            <th>Mã tỉnh</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Mã giảm giá</th>
                                            <th>Số tiền giảm giá</th>
                                            <th>Số tiền vận chuyển</th>
                                            <th>Tổng tiền ($)</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Hành động</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->order_number }}</td>
                                                <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->company_name }}</td>
                                                <td>{{ $value->country_name }}</td>
                                                <td>{{ $value->address_one }} <br /> {{ $value->address_two }}</td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ $value->state }}</td>
                                                <td>{{ $value->postcode }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->discount_code }}</td>
                                                <td> {{ number_format((float) $value->discount_amount, 2) }}</td>
                                                <td>{{ number_format((float) $value->shipping_amount, 2) }}</td>
                                                <td>{{ number_format((float) $value->total_amount, 2) }}</td>

                                                <td>{{ $value->payment_method }}</td>
                                                <td>
                                                    <select class="form-control ChangeStatus" id="{{ $value->id }}"
                                                        style="width: 150px;">
                                                        <option {{ $value->status == 0 ? 'selected' : '' }}
                                                            value="0">Chờ xử lý</option>
                                                        <option {{ $value->status == 1 ? 'selected' : '' }}
                                                            value="1">Đang xử lý</option>
                                                        <option {{ $value->status == 2 ? 'selected' : '' }}
                                                            value="2">Đã giao hàng</option>
                                                        <option {{ $value->status == 3 ? 'selected' : '' }}
                                                            value="3">Hoàn thàn</option>
                                                        <option {{ $value->status == 4 ? 'selected' : '' }}
                                                            value="4">Đã hủy</option>
                                                    </select>
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/order/detail/' . $value->id) }}"
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
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $('body').delegate('.ChangeStatus', 'change', function() {
        var order_id = $(this).attr('id');
        var status = $(this).val();

        $.ajax({
            type: "GET",
            url: "{{ url('admin/order_status') }}",
            data: {
                status: status,
                order_id: order_id
            },
            dataType: "json",
            success: function(data) {
                alert(data.message)
            },
        });
    });
</script>

    @endsection
