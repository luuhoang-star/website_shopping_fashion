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
                        <h1>Danh sách liên hệ</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right";>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách liên hệ</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Chủ đề</th>
                                            <th>Nội dung tin nhắn</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ !empty($value->getUser) ? $value->getUser->name : '' }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->subject }}</td>
                                                <td>{{ $value->message }}</td>
                                                <td>{{ $value->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('admin/contactus/delete/' . $value->id) }}"
                                                        class="btn btn-primary">Xóa</a>
                                                  
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $getRecord->links('pagination::bootstrap-4') }}
                                </div>
                                {{-- <div class="card-footer clearfix">
                                    <div class="float-right">
                                        {{ $getRecord->links() }}
                                    </div>
                                </div> --}}
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
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
