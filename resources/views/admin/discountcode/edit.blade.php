@extends('admin.layouts.app') <!-- kế thừa mới nạp giao diện ở dưới vô app đc -->
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Chỉnh sửa mã giảm giá</h1>
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
                            <form action="{{ url('admin/discount_code/update/' . $getRecord->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên mã giảm giá
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Tên mã giảm giá">

                                    </div>

                                    <div class="form-group">
                                        <label>Loại <span style="color:red">*</span></label>
                                        <select class="form-control" name="type" required>
                                            <option {{ old('type', $getRecord->type) == 'Fixed' ? 'selected' : '' }}
                                                value="fixed">Cố định
                                            </option>
                                            <option {{ old('type', $getRecord->type) == 'Percent' ? 'selected' : '' }}
                                                value="percent">
                                                Phần trăm
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Số tiền giảm giá
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="percent_amount" required
                                            value="{{ old('percent_amount', $getRecord->percent_amount) }}"
                                            placeholder="Số tiền giảm giá">

                                    </div>

                                    <div class="form-group">
                                        <label>Ngày hết hạn
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="date" class="form-control" name="expire_date" required
                                            value="{{ old('expire_date', $getRecord->expire_date) }}">

                                    </div>



                                    <div class="form-group">
                                        <label>Trạng thái <span style="color:red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="0"
                                                {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}>Hoạt động
                                            </option>
                                            <option value="1"
                                                {{ old('status', $getRecord->status) == 1 ? ' selected' : '' }}>Không hoạt
                                                động</option>
                                        </select>
                                    </div>
                                    <hr>




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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
