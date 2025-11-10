@extends('admin.layouts.app') <!-- kế thừa mới nạp giao diện ở dưới vô app đc -->
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order List</h1>
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

                        <!-- /.card -->
                        @include('admin.layouts._message')

                        <form method="get">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ORDER Search</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" name="id" placeholder="ID" class="form-control" value="{{ Request::get('id') }}">
                                        </div>
                                    </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company_name" placeholder="Company Name" class="form-control" value="{{ Request::get('company_name') }}">
                                        </div>
                                    </div>


                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" placeholder="First Name" class="form-control" value="{{ Request::get('first_name') }}">
                                        </div>
                                    </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="{{ Request::get('last_name') }}">
                                        </div>
                                    </div>


                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" placeholder="Email" class="form-control" value="{{ Request::get('email') }}">
                                        </div>
                                    </div>


                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" name="country_name" placeholder="Country Name" class="form-control" value="{{ Request::get('country_name') }}">
                                        </div>
                                    </div>


                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="state" placeholder="state" class="form-control" value="{{ Request::get('state') }}">
                                        </div>
                                    </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" placeholder="city" class="form-control" value="{{ Request::get('city') }}">
                                        </div>
                                    </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" placeholder="phone" class="form-control" value="{{ Request::get('phone') }}">
                                        </div>
                                    </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Postcode</label>
                                            <input type="text" name="postcode" placeholder="postcode" class="form-control" value="{{ Request::get('postcode') }}">
                                        </div>
                                    </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <input type="date" style="padding: 6px;" name="from_date" placeholder="from_date" class="form-control" value="{{ Request::get('from_date') }}">
                                        </div>
                                    </div>



                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input type="date" style="padding: 6px;" name="to_date" placeholder="to_date" class="form-control" value="{{ Request::get('to_date') }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/order/list') }}" class="btn btn-primary">Reset</a>
                                    </div>
                                </div>
                            

                            </div>
                            <!-- /.card-body -->
                        </div>
                        </form>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ORDER List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên</th>
                                            </th>
                                            <th>Company Name</th>
                                            <th>Country</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Postcode</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Discount Code</th>
                                            <th>Discount Amount</th>
                                            <th>Shipping Amount</th>
                                            <th>Total Amount ($)</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->company_name }}</td>
                                                <td>{{ $value->country_name }}</td>
                                                <td>{{ $value->address_one }} <br /> {{ $value->address_two }}</td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ $value->state }}</td>
                                                <td>{{ $value->postcode }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->discount_code }}</td>
                                                <td> {{ number_format((float) $value->discount_amount, 2) }}</td>
                                                <td>{{ number_format((float) $value->shipping_amount, 2) }}</td>
                                                <td>{{ number_format((float) $value->total_amount, 2) }}</td>

                                                <td>{{ $value->payment_method }}</td>
                                                <td></td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                               <td>
                                                    <a href="{{ url('admin/order/detail/'.$value->id) }}" class="btn btn-primary">Detail</a>
                                                </td> 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="p-3">
                                    {{ $getRecord->links() }}
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
