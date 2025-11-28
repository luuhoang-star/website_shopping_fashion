@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Tiêu đề trang -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Chỉnh sửa sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Nội dung chính -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Form -->
                    <div class="col-md-12">
                        @include('admin.layouts._message')
                        <div class="card card-primary">
                            <form action="{{ url('/admin/product/update/' . $product->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">

                                <div class="card-body">
                                    <div class="row">
                                        <!-- Tên sản phẩm -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên sản phẩm <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ old('title', $product->title) }}"
                                                    placeholder="Nhập tên sản phẩm">
                                            </div>
                                        </div>

                                        <!-- Mã SKU -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mã SKU <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="sku" required
                                                    value="{{ old('sku', $product->sku) }}" placeholder="Nhập mã SKU">
                                            </div>
                                        </div>

                                        <!-- Danh mục -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Danh mục <span style="color:red">*</span></label>
                                                <select class="form-control" required id="ChangeCategory"
                                                    name="category_id">
                                                    <option value="">-- Chọn danh mục --</option>
                                                    @foreach ($getCategory as $category)
                                                        <option
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Danh mục con -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Danh mục con <span style="color:red">*</span></label>
                                                <select class="form-control" required id="getSubCategory"
                                                    name="sub_category_id">
                                                    <option value="">-- Chọn danh mục con --</option>
                                                    @foreach ($getSubCategory as $subcategory)
                                                        <option
                                                            {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }}
                                                            value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Thương hiệu -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Thương hiệu <span style="color:red">*</span></label>
                                                <select class="form-control" required name="brand_id">
                                                    <option value="">-- Chọn thương hiệu --</option>
                                                    @foreach ($getBrand as $brand)
                                                        <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                            value="{{ $brand->id }}">{{ $brand->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Màu sắc -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Màu sắc <span style="color:red">*</span></label>
                                                @foreach ($getColor as $color)
                                                    @php
                                                        $checked = '';
                                                    @endphp
                                                    @foreach ($product->getColor as $pcolor)
                                                        @if ($pcolor->color_id == $color->id)
                                                            @php
                                                                $checked = 'checked';
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <div>
                                                        <label>
                                                            <input {{ $checked }} type="checkbox" name="color_id[]"
                                                                value="{{ $color->id }}">
                                                            {{ $color->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>


                                        <hr>


                                        <!-- Giá bán -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giá bán (VND) <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="price" required
                                                    value="{{ !empty($product->price) ? $product->price : '' }}"
                                                    placeholder="Nhập giá bán">
                                            </div>
                                        </div>

                                        <!-- Giá cũ -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giá gốc (Vnd) <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="old_price" required
                                                    value="{{ !empty($product->old_price) ? $product->old_price : '' }}"
                                                    placeholder="Nhập giá gốc">
                                            </div>
                                        </div>
                                        <!-- Size & Giá theo size -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Size & Giá theo size <span style="color:red">*</span></label>
                                                <table class="table table-striper">
                                                    <thead>
                                                        <tr>
                                                            <th>Tên size</th>
                                                            <th>Giá (VND)</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="AppendSize">
                                                        @php
                                                            $i_s = 1;
                                                        @endphp
                                                        @foreach ($product->getSize as $size)
                                                            <tr>
                                                                <td><input type="text" value="{{ $size->name }}"
                                                                        name="size[{{ $i_s }}][name] class="form-control"
                                                                        placeholder="Tên size"></td>
                                                                <td><input type="text" value="{{ $size->price }}"
                                                                        name="size[{{ $i_s }}][price]"
                                                                        class="form-control" placeholder="Giá"></td>
                                                                <td style="width:100px;">
                                                                    <button type="button" id="{{ $i_s }}"
                                                                        class="btn btn-danger DeleteSize">Xóa</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="size[100][name]"
                                                                    placeholder="Tên size" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="size[100][price]"
                                                                    placeholder="Giá" class="form-control">
                                                            </td>
                                                            <td style="width:200px;">
                                                                <button type="button"
                                                                    class="btn btn-primary AddSize">Thêm</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Image <span style="color:red">*</span></label>
                                                <input type="file" name="image[]" class="form-control"
                                                    style="padding: 5px;" multiple accept="image/*">

                                            </div>
                                        </div>

                                        @if (!empty($product->getImage->count()))
                                            <div class="row" id="sortable">
                                                <!-- áp dụng tính năng kéo thả cho phần tử con-->
                                                @foreach ($product->getImage as $image)
                                                    <!-- lấy tất cả ảnh của 1 sản phẩm nhờ mqh 1-n. định nghĩa trong model Product-->
                                                    <div class="col-md-4">
                                                        @if (!empty($image->getLogo()))
                                                            <!-- kiểm tra đường dẫn ảnh . nhờ model ProductImage trong hàm getLogo()-->
                                                            <div class="col-md-12 sortable_image text-center"
                                                                id="{{ $image->id }}">
                                                                <img style="width: 100px; height: 100px;"
                                                                    src="{{ $image->getLogo() }}">
                                                                <!-- In ra nhiều ảnh  + đường dẫn-->
                                                                <a onclick="return confirm('Are you sure you want to delete');"
                                                                    href="{{ url('admin/product/image_delete/' . $image->id) }}"
                                                                    class="btn btn-danger btn-sm mt-2">Delete</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Mô tả ngắn -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả ngắn <span style="color:red">*</span></label>
                                                <textarea name="short_description" class="form-control" required placeholder="Nhập mô tả ngắn">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả <span style="color:red">*</span></label>
                                                <textarea name="description" class="form-control editor" required placeholder="Nhập mô tả">{{ old('description', $product->description ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Thông tin bổ sung <span style="color:red">*</span></label>
                                                <textarea name="additional_information" class="form-control editor" required placeholder="Thông tin bổ sung">{{ old('additional_information', $product->additional_information ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chính sách đổi trả <span style="color:red">*</span></label>
                                                <textarea name="shipping_returns" class="form-control editor" required placeholder="Chính sách đổi trả">{{ old('shipping_returns', $product->shipping_returns ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Trạng thái <span class="text-danger">*</span></label>
                                                <select class="form-control" name="status" required>
                                                    <option value="0"
                                                        {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Hoạt
                                                        động</option>
                                                    <option value="1"
                                                        {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Không
                                                        hoạt động</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nút cập nhật -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Form -->
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('sortable/jquery-ui.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_image').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    });
                    $.ajax({ // gửi request bằng ajax của JS lên laravel ,laravel xử lý theo logic viết(k reload lại trang)
                        type: "POST",
                        url: "{{ url('admin/product_image_sortable') }}",
                        data: {
                            "photo_id": photo_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            alert("Thứ tự ảnh đã được cập nhật!");
                        },
                        error: function(data) {
                            alert("Lỗi khi gửi dữ liệu.");
                        }

                    });
                }
            });
        });

        $('.editor') // Chọn tất cả phần tử có class "editor" (ví dụ: <textarea class="editor">)
            .summernote({ // Khởi tạo plugin Summernote trên những phần tử đã chọn
                height: 180 // Cấu hình: đặt chiều cao của khung soạn thảo là 180 pixel
            });





        var i = 1; // Khởi tạo biến đếm để tạo ID riêng cho mỗi dòng mới

        $('body').delegate('.AddSize', 'click', function() { // Khi click nút có class AddSize
            var html = '<tr id="DeleteSize' + i + '">' + // Mỗi dòng có ID riêng để sau dễ xoá
                '<td><input type="text" name="size[' + i +
                '][name]" placeholder="Name" class="form-control"></td>' + // Ô nhập Name
                '<td><input type="text" name="size[' +
                i + '][price]" placeholder="Value" class="form-control"></td>' + // Ô nhập Value (đã sửa lỗi ở đây)
                '<td><button type="button" id="' + i + '" class="btn btn-danger DeleteSize">Delete</button></td>' +
                // Nút Delete có ID
                '</tr>';

            $('#AppendSize').append(html); // Thêm dòng mới vào bảng (tbody có id AppendSize)
            i++; // Tăng biến đếm để dòng sau có ID khác
        });

        $('body').delegate('.DeleteSize', 'click', function() { // Khi click nút Delete
            var id = $(this).attr('id'); // Lấy ID của nút vừa click (chính là i của dòng đó)
            $('#DeleteSize' + id).remove(); // Xoá dòng có ID tương ứng
        });



        // bắt đầu đoạn script để chạy js
        $('body').delegate('#ChangeCategory', 'change', function(
            e) { //Bắt sự kiện "change" trên thẻ có ID là ChangeCategory thuộc danh mục cha
            var id = $(this).val(); // lấy ID của danh mục cha đã chọn

            $.ajax({ // gửi request bằng ajax của JS lên laravel ,laravel xử lý theo logic viết(k reload lại trang)
                type: "POST",
                url: "{{ url('admin/get_sub_category') }}",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#getSubCategory').html(data.html);
                },
                error: function(data) {

                }
            });
        });
    </script>
  

@endsection
