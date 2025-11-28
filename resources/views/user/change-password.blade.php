@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Thay đổi mật khẩu</h1>
            </div>
        </div>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">

                    <br />

                    <div class="row">
                        @include('user._sidebar')

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">

                                @include('layouts._message')
                                <form action="" method="post">
                                    {{ csrf_field() }}

                                    <label>Mật khẩu cũ</label>
                                    <input type="password" name="old_password" class="form-control" required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Mật khẩu mới</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Xác nhận mật khẩu</label>
                                            <input type="password" name="confirm_password" class="form-control" required>
                                        </div>
                                    </div>

                                    <button type="submit" style="width: 100px;"
                                        class="btn btn-outline-primary-2 btn-order btn-block">
                                        Cập nhật mật khẩu
                                    </button>

                                </form>

                            </div>
                        </div><!-- End col-lg-9 -->

                    </div><!-- End row -->

                </div><!-- End container -->
            </div><!-- End dashboard -->
        </div><!-- End page-content -->
    </main>
@endsection

@section('script')
@endsection
