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
                        <h1>Cài đặt hệ thống</h1>
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
                        @include('admin.layouts._message')
                        <div class="card card-primary">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Website
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->website_name ?? '' }}"
                                            name="website_name">

                                    </div>

                                    <div class="form-group">
                                        <label>Logo
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="file" class="form-control" name="logo">
                                       @if ($getRecord && $getRecord->getLogo())


                                            <img src="{{ $getRecord->getLogo() }}" style="width: 200px;">
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label>Biểu tượng website
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="file" class="form-control" name="fevicon">
                                      @if ($getRecord && $getRecord->getFevicon())

                                            <img src="{{ $getRecord->getFevicon() }}" style="width: 50px;">
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả chân trang
                                            <span style="color:red"></span>
                                        </label>
                                        <textarea class="form-control" name="footer_description">{{ $getRecord->footer_description ?? '' }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Biểu tượng thanh toán ở chân trang
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="file" class="form-control" name="footer_payment_icon">
                                         @if ($getRecord && $getRecord->getFooterPayment())
                                            <img src="{{ $getRecord->getFooterPayment() }}" style="width: 200px;">
                                        @endif

                                    </div>
                                    <hr />

                                    <div class="form-group">
                                        <label>Địa chỉ
                                            <span style="color:red"></span>
                                        </label>
                                        <textarea class="form-control" name="address">{{ $getRecord->address ?? '' }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Số điện thoại
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->phone ?? '' }}"
                                            name="phone">
                                    </div>


                                    <div class="form-group">
                                        <label>Số điện thoại 2
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->phone_two ?? ''}}"
                                            name="phone_two">
                                    </div>

                                    <div class="form-group">
                                        <label>Email nhận liên hệ
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control"
                                            value="{{ $getRecord->submit_email ?? ''}}" name="submit_email">
                                    </div>

                                    <div class="form-group">
                                        <label>Email
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control"
                                            value="{{ $getRecord->email ?? '' }}" name="email">
                                    </div>

                                    <div class="form-group">
                                        <label>Email 2
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control"
                                            value="{{ $getRecord->email_two ?? ''}}" name="email_two">
                                    </div>

                                    <div class="form-group">
                                        <label>Giờ làm việc
                                            <span style="color:red"></span>
                                        </label>
                                        <textarea class="form-control" name="working_hour">{{ $getRecord->working_hour ?? ''}}</textarea>
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <label>Liên kết Facebook
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->facebook_link ?? '' }}"
                                            name="facebook_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Liên kết Twitter
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->twitter_link ?? '' }}"
                                            name="twitter_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Liên kết Instagram
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->instagram_link ?? ''}}"
                                            name="instagram_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Liên kết Youtube
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->youtube_link ?? ''}}"
                                            name="youtube_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Liên kết Pinterest
                                            <span style="color:red"></span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ $getRecord->pinterest_link ?? '' }}"
                                            name="pinterest_link">
                                    </div>





                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
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
