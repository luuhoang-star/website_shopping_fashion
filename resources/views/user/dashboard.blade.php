@extends('layouts.app')
@section('style')
<style type="text/css">
.box-btn {
	padding: 10px;text-align: center;border-radius: 5px; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
}

</style>
@endsection

@section('content')
      <main class="main">
        	<div class="page-header text-center">
        		<div class="container">
        			<h1 class="page-title">Dashboard</h1>
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
									<div class="row">
										<div class="col-md-3" style="margin-bottom: 20px;">
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ $TotalOrder }}</div>
												<div style="font-size: 16px;">Tổng đơn hàng</div>
											</div>
										</div>

										<div class="col-md-3" style="margin-bottom: 20px;">
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ $TotalTodayOrder }}</div>
												<div style="font-size: 16px;">Tổng đơn hàng hôm nay</div>
											</div>
										</div>

										<div class="col-md-3" style="margin-bottom: 20px;">
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ number_format($TotalAmount, 2) }}</div>
												<div style="font-size: 16px;">Tổng tiền</div>
											</div>
										</div>

										<div class="col-md-3" style="margin-bottom: 20px;">
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ number_format($TotalTodayAmount,2) }}</div>
												<div style="font-size: 16px;">Tổng tiền hôm nay</div>
											</div>
										</div>

										<div class="col-md-3" style="margin-bottom: 20px;"> 
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ $TotalPending }}</div>
												<div style="font-size: 16px;">Đơn hàng chờ xử lý</div>
											</div>
										</div>

											<div class="col-md-3" style="margin-bottom: 20px;"> 
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ $TotalInprogess }}</div>
												<div style="font-size: 16px;">Đơn hàng đang xử lý</div>
											</div>
										</div>

											<div class="col-md-3" style="margin-bottom: 20px;"> 
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ $TotalCompleted }}</div>
												<div style="font-size: 16px;">Đơn hàng đã hoàn thành</div>
											</div>
										</div>

											<div class="col-md-3" style="margin-bottom: 20px;"> 
											<div class="box-btn">
												<div style="font-size: 20px;font-weight: bold;">{{ $TotalCancelled }}</div>
												<div style="font-size: 16px;">Đơn hàng đã hủy</div>
											</div>
										</div>

									
									</div>

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
