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
                        <h1>Thêm mới danh mục con</h1>
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
                            <form action="{{ url('admin/subcategory/add') }}" method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Tên danh mục chính
                                            <span style="color:red">*</span>
                                        </label>
                                        <select class="form-control" name="category_id" required>
                                            <option value="">Select</option>
                                            @foreach ($getCategory as $value)
                                                <option value="{{ $value->id }}"> {{ $value->name }} </option>
                                            @endforeach
                                        </select>

                                    </div>



                                    <div class="form-group">
                                        <label>Tên danh mục phụ
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" value= "{{ old('name') }}" required name="name" required
                                            placeholder="Sub category Name">

                                    </div>

                                    <div class="form-group">
                                        <label>Slug
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" required value="{{ old('slug') }}"
                                            name="slug" placeholder="Slug ex . url">
                                        <div style="color:red">{{ $errors->first('slug') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng thái <span style="color:red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Hoạt động
                                            </option>
                                            <option value="1" {{ old('status') == 1 ? ' selected' : '' }}>No hoạt
                                                động</option>
                                        </select>
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <label>Meta title
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" required value="{{ old('meta_title') }}"
                                            name="meta_title" placeholder="Meta title">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Description
                                            <span style="color:red">*</span>
                                        </label>
                                        <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ old('meta_description') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Keyword</label>
                                        <input type="text" class="form-control" required
                                            value="{{ old('meta_keyword') }}" name="meta_keyword"
                                            placeholder="Meta Keyword">
                                    </div>


                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
