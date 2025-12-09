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
                        <h1>Chỉnh sửa trang</h1>
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
                            <form action="{{ url('admin/page/update/' . $getRecord->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->name }}"
                                            name="name">
                                    </div>

                                    <div class="form-group">
                                        <label>Tiêu đề
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->title }}"
                                            name="title">
                                    </div>

                                    <div class="form-group">
                                        <label>Ảnh
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="file" class="form-control" name="image">
                                        @if (!empty($getRecord->getImage()))
                                            <img style="width: 200px;" src="{{ $getRecord->getImage() }}">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả
                                            <span style="color:red"></span>
                                        </label>
                                        <textarea class="form-control editor" value="{{ $getRecord->description }}" name="description"></textarea>
                                    </div>
                                    <hr>




                                    <div class="form-group">
                                        <label>Tiêu đề Meta
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" required
                                            value="{{ old('meta_title', $getRecord->meta_title) }}" name="meta_title"
                                            placeholder="Tiêu đề meta">
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
                                            value="{{ old('meta_keyword', $getRecord->meta_keyword) }}" name="meta_keyword"
                                            placeholder="Từ khóa meta">
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
  
@endsection
