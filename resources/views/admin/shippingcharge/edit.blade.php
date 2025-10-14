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
                        <h1>Edit Shipping Charge</h1>
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
                            <form action="{{ url('admin/shipping_charge/update/' . $getRecord->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên phí vận chuyển
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Shipping Charge Name">

                                    </div>


                                <div class="form-group">
                                    <label>Price
                                        <span style="color:red">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="price" required
                                        value="{{ old('price', $getRecord->price) }}" placeholder="Price">

                                </div>

                


                                <div class="form-group">
                                    <label>status <span style="color:red">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0"
                                            {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}>Hoạt động
                                        </option>
                                        <option value="1"
                                            {{ old('status', $getRecord->status) == 1 ? ' selected' : '' }}>No hoạt
                                            động</option>
                                    </select>
                                </div>
                                <hr>




                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
