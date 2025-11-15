@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Chỉnh sửa admin</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{ url('admin/admin/edit/' . $getRecord->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên admin</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $getRecord->name) }}" required placeholder="Enter Name">
                                        <!--hiển thị dữ liệu cũ khi đã submit nhằm đỡ gõ lại ,hoặc hiện thị dữ liệu có sẵn khi chưa submit để sửa cái khác(tăng tính trải nghiệm)-->
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email', $getRecord->email) }}" required
                                            placeholder="Enter Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>


                                    </div>

                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <input type="text" class="form-control" name="password" placeholder="Password">
                                        <p>Nếu bạn muốn đổi mật khẩu thì hãy nhập vào</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control" name="status" required>
                                            <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">Active
                                            </option>
                                            <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
