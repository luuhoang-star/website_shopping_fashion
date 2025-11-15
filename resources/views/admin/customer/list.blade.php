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
                        <h1>Danh sách người dùng (Total: {{ $getRecord->total() }})</h1>
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
                                    <h3 class="card-title">Tìm kiếm người dùng</h3>
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
                                                <label>Tên</label>
                                                <input type="text" name="name" placeholder="Name" class="form-control"
                                                    value="{{ Request::get('name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" placeholder="Email"
                                                    class="form-control" value="{{ Request::get('email') }}">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Ngày bắt đầu</label>
                                                <input type="date" style="padding: 6px;" name="from_date"
                                                    placeholder="from_date" class="form-control"
                                                    value="{{ Request::get('from_date') }}">
                                            </div>
                                        </div>



                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Ngày kết thúc</label>
                                                <input type="date" style="padding: 6px;" name="to_date"
                                                    placeholder="to_date" class="form-control"
                                                    value="{{ Request::get('to_date') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{ url('admin/customer/list') }}" class="btn btn-primary">Reset</a>
                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->
                            </div>
                        </form>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách người dùng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên admin</th>
                                            <th>Email</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    {{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/admin/delete/' . $value->id) }}"
                                                        class="btn btn-primary">Xóa</a>

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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@endsection
