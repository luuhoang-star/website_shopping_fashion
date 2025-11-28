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
                        <h1>Chỉnh sửa danh mục phụ</h1>
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
                            <form action="{{ url('admin/subcategory/update/' . $getRecord->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                     <div class="form-group">
                                        <label>Tên danh mục chính
                                            <span style="color:red">*</span>
                                        </label>
                                        <select class="form-control" name="category_id" required>
                                            <option value="">Lựa chọn</option>
                                            @foreach ($getCategory as $value)
                                                <option {{ ($value->id == $getRecord->category_id) ? 'selected' : '' }} value="{{ $value->id }}"> {{ $value->name }} </option>
                                            @endforeach
                                        </select>

                                    </div>
 
                                    <div class="form-group">
                                        <label>Tên danh mục phụ
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Tên danh mục phụ">

                                    </div>



                                    <div class="form-group">
                                        <label>Slug
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" required
                                            value="{{ old('slug', $getRecord->slug) }}" name="slug" required
                                            placeholder="Slug VD: ao-thun-dep">
                                        <div style="color:red">{{ $errors->first('slug') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng thái <span style="color:red">*</span></label>
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

                                    <div class="form-group">
                                        <label>Tiêu đề meta
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" required
                                            value="{{ old('meta_title', $getRecord->meta_title) }}" name="meta_title"
                                            placeholder="Tiêu đè meta">
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả meta
                                            <span style="color:red">*</span>
                                        </label>
                                        <textarea class="form-control" placeholder="Mô tả meta" name="meta_description">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Từ khóa meta</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('meta_keywords', $getRecord->meta_keyword) }}"
                                            name="meta_keyword" placeholder="Từ khóa meta">
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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
