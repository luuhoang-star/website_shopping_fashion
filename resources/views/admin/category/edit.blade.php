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
                        <h1>Chỉnh sửa danh mục</h1>
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
                            <form action="{{ url('admin/category/update/' . $getRecord->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên danh mục
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Category Name">

                                    </div>

                                    <div class="form-group">
                                        <label>Slug
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" required
                                            value="{{ old('slug', $getRecord->slug) }}" name="slug" required
                                            placeholder="Slug ex . url">
                                        <div style="color:red">{{ $errors->first('slug') }}</div>
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

                                    <div class="form-group">
                                        <label>Tiêu đề Meta
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" required
                                            value="{{ old('meta_title', $getRecord->meta_title) }}" name="meta_title"
                                            placeholder="Meta title">
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả meta
                                            <span style="color:red">*</span>
                                        </label>
                                        <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Từ khóa meta</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('meta_keywords', $getRecord->meta_keyword) }}"
                                            name="meta_keyword" placeholder="Meta Keyword">
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
