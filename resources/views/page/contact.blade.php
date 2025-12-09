@extends('layouts.app')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $getPage->title }}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <div class="container">
            <div class="page-header page-header-big text-center"
                style="background-image: url('{{ $getPage->getImage() }}')">
                <h1 class="page-title text-white">{{ $getPage->title }}</h1>
            </div><!-- End .page-header -->
        </div><!-- End .container -->

        <div class="page-content pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-2 mb-lg-0">
                        {!! $getPage->description !!}
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="contact-info">
                                    <ul class="contact-list">
                                        @if (!empty($getSystemSetting->address))
                                            <li>
                                                <i class="icon-map-marker"></i>
                                                {{ $getSystemSetting->address }}
                                            </li>
                                        @endif
                                        @if (!empty($getSystemSetting->phone))
                                            <li>
                                                <i class="icon-phone"></i>
                                                <a
                                                    href="tel:{{ $getSystemSetting->phone }}">{{ $getSystemSetting->phone }}</a>
                                            </li>
                                        @endif

                                        @if (!empty($getSystemSetting->phone_two))
                                            <li>
                                                <i class="icon-phone"></i>
                                                <a
                                                    href="tel:{{ $getSystemSetting->phone_two }}">{{ $getSystemSetting->phone_two }}</a>
                                            </li>
                                        @endif

                                        @if (!empty($getSystemSetting->email))
                                            <li>
                                                <i class="icon-envelope"></i>
                                                <a
                                                    href="mailto:{{ $getSystemSetting->email }}">{{ $getSystemSetting->email }}</a>
                                            </li>
                                        @endif

                                        @if (!empty($getSystemSetting->email_two))
                                            <li>
                                                <i class="icon-envelope"></i>
                                                <a
                                                    href="mailto:{{ $getSystemSetting->email_two }}">{{ $getSystemSetting->email_two }}</a>
                                            </li>
                                        @endif


                                    </ul><!-- End .contact-list -->
                                </div><!-- End .contact-info -->
                            </div><!-- End .col-sm-7 -->

                            <div class="col-sm-5">
                                <div class="contact-info">

                                    <ul class="contact-list">
                                        @if (!empty($getSystemSetting->working_hour))
                                            <li>
                                                <i class="icon-clock-o"></i>
                                                {{ $getSystemSetting->working_hour }}
                                            </li>
                                        @endif
                                    </ul><!-- End .contact-list -->
                                </div><!-- End .contact-info -->
                            </div><!-- End .col-sm-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .col-lg-6 -->
                    <div class="col-lg-6">
                        <h2 class="title mb-1">Got Any Questions?</h2><!-- End .title mb-2 -->
                        <p class="mb-2">Use the form below to get in touch with the sales team</p>

                        <div style="padding-top: 10px;padding-bottom: 10px;">
                            @include('layouts._message')
                        </div>
                        <form action="#" class="contact-form mb-3" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cname" class="sr-only">Name</label>
                                    <input type="text" class="form-control" name="name" id="cname"
                                        placeholder="Tên" required>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label for="cemail" class="sr-only">Email</label>
                                    <input type="email" class="form-control" name="email" id="cemail"
                                        placeholder="Email" required>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cphone" class="sr-only">Phone</label>
                                    <input type="tel" class="form-control" name="phone" id="cphone"
                                        placeholder="Số điện thoại">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label for="csubject" class="sr-only">Subject</label>
                                    <input type="text" class="form-control" name="subject" id="csubject"
                                        placeholder="Chủ đề">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label for="cmessage" class="sr-only">Message</label>
                            <textarea class="form-control" cols="30" rows="4" name="message" id="cmessage" required
                                placeholder="Nội dung tin nhắn"></textarea>

                            <div class="col-sm-12">
                                    <label for="verification">{{ $first_number }} + {{ $second_number }} = ?</label>
                                    <input type="text" class="form-control" name="verification" id="verification"
                                        placeholder="Phép tính xác minh">
                                </div><!-- End .col-sm-6 -->
  

                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                <span>Xác nhận</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </form><!-- End .contact-form -->
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->


            </div><!-- End .container -->

        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
