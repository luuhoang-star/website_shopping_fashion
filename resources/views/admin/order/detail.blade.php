@extends('admin.layouts.app') <!-- kế thừa mới nạp giao diện ở dưới vô app đc -->
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Order detail</h1>
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

                            <div class="card-body">
                                <div class="form-group">
                                    <label>ID : <span style="font-weight: normal;"> {{ $getRecord->id }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Transaction ID : <span style="font-weight: normal;">
                                            {{ $getRecord->transaction_id }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Name : <span style="font-weight: normal;"> {{ $getRecord->first_name }} ,
                                            {{ $getRecord->last_name }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Company Name : <span style="font-weight: normal;">
                                            {{ $getRecord->company_name }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Contry Name : <span style="font-weight: normal;">
                                            {{ $getRecord->country_name }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Address : <span style="font-weight: normal;"> {{ $getRecord->address_one }},
                                            {{ $getRecord->address_two }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>City : <span style="font-weight: normal;"> {{ $getRecord->city }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>State : <span style="font-weight: normal;"> {{ $getRecord->state }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Postcode : <span style="font-weight: normal;"> {{ $getRecord->postcode }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Phone : <span style="font-weight: normal;"> {{ $getRecord->phone }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Email : <span style="font-weight: normal;"> {{ $getRecord->email }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Discount _code : <span style="font-weight: normal;">
                                            {{ $getRecord->discount_code }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Discount Amount : <span style="font-weight: normal;">
                                            {{ number_format((float) $getRecord->discount_amount, 2) }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Shipping Name : <span style="font-weight: normal;">
                                            {{ $getRecord->getShipping->name }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Shipping amount : <span style="font-weight: normal;">
                                            {{ number_format((float) $getRecord->shipping_amount, 2) }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Total amount($) : <span style="font-weight: normal;">
                                            {{ number_format((float) $getRecord->total_amount, 2) }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Payment method : <span style="font-weight: normal;">
                                            {{ $getRecord->payment_method }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Status :</label>
                                </div>

                                <div class="form-group">
                                    <label>Note : <span style="font-weight: normal;"> {{ $getRecord->note }}</span>
                                        <label>
                                </div>

                                <div class="form-group">
                                    <label>Creatd Date : <span style="font-weight: normal;">
                                            {{ date('d-m-Y', strtotime($getRecord->created_at)) }}</span>
                                    </label>
                                </div>







                            </div>

                        </div>



                    </div>


                    <!-- /.card -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>


                                            <th>Color Name</th>
                                            <th>Size Name</th>
                                            <th>Size_Amount ($)</th>
                                            <th>Total Amount ($)</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord->getItem as $item)
                                            @php
                                                $getProductImage = $item->getProduct->getImageSingle(
                                                    $item->getProduct->id,
                                                );
                                            @endphp

                                            <tr>
                                                <td>
                                                    <img style="width: 100px; height: 100px;"
                                                        src="{{ $getProductImage->getLogo() }}">
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ url($item->getProduct->slug) }}">
                                                        {{ $item->getProduct->title }}
                                                    </a>
                                                </td>

                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>

                                                <td>{{ $item->color_name }}</td>
                                                <td>{{ $item->size_name }}</td>
                                                <td>{{ number_format($item->size_amount, 2) }}</td>
                                                <td>{{ number_format($item->total_price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
