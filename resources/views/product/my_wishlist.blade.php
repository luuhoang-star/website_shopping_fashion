@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nouislider/nouislider.css') }}">
    <style type="text/css">
        .active-color {
            border: 3px solid #000 !important;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">Danh sách yêu thích</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Danh sách yêu thích</a>
                    </li>

                </ol>

            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">

                            @include('product._list')

                        <div class="d-flex justify-content-center mt-3">
                            {{ $getProduct->links('pagination::bootstrap-4') }}
                        </div>

                    </div><!-- End .col-lg-9 -->


                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
    </script>
@endsection
