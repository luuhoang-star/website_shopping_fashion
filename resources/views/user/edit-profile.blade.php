@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Chỉnh sửa thông tin cá nhân</h1>
            </div><!-- End .container -->
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

                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label>Họ</label>
                                            <input type="text" name="last_name" value="{{ Auth::user()->last_name ?? '' }}"
                                                class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Tên</label>
                                            <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}"
                                                class="form-control" required>
                                        </div><!-- End .col-sm-6 -->


                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}"
                                            class="form-control" readonly>

                                    </div><!-- End .row -->

                                    <label>Tên công ty (Optional)</label>
                                    <input type="text" name="company_name" value="{{ Auth::user()->company_name ?? '' }}"
                                        class="form-control">

                                    <label>Quốc gia</label>
                                    <input type="text" name="country_name" value="{{ Auth::user()->country_name ?? '' }}"
                                        class="form-control" required>

                                    <label>Địa chỉ đường</label>
                                    <input type="text" name="address_one" value="{{ Auth::user()->address_one ?? '' }}"
                                        class="form-control" placeholder="House number and Street name" required>
                                    <input type="text" name="address_two" value="{{ Auth::user()->adress_two ?? '' }}"
                                        class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Thành phố</label>
                                            <input type="text" name="city" value="{{ Auth::user()->city ?? '' }}"
                                                class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Khu vực</label>
                                            <input type="text" name="state" value="{{ Auth::user()->state ?? '' }}"
                                                class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Mã thành phố / ZIP</label>
                                            <input type="text" name="postcode" value="{{ Auth::user()->postcode ?? '' }}"
                                                class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Số điện thoại</label>
                                            <input type="tel" name="phone" value="{{ Auth::user()->phone ?? '' }}"
                                                class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <button type="submit" style="width: 100px;"
                                            class="btn btn-outline-primary-2 btn-order btn-block">
                                            Xác nhận
                                        </button>
                                    </div><!-- End .row -->
                                </form>


                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
@endsection
