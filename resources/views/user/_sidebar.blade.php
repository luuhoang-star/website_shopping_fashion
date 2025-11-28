	<aside class="col-md-4 col-lg-3">
	                			<ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
								    <li class="nav-item">
								        <a href="{{ url('user/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">Dashboard</a>
								    </li>

                                    <li class="nav-item">
								        <a href="{{ url('user/orders') }}" class="nav-link @if(Request::segment(2) == 'orders') active @endif">Đơn hàng</a>
								    </li>

                                    <li class="nav-item">
								        <a href="{{ url('user/edit-profile') }}" class="nav-link @if(Request::segment(2) == 'edit-profile') active @endif">Sửa thông tin cá nhân</a>
								    </li>

                                    <li class="nav-item">
								        <a href="{{ url('user/change-password') }}" class="nav-link @if(Request::segment(2) == 'change-password') active @endif">Thay đổi mật khẩu</a>
								    </li>

                                    <li class="nav-item">
								        <a href="{{ url('admin/logout') }}" class="nav-link">Đăng xuất</a>
								    </li>
                                    
								</ul>
	                		</aside><!-- End .col-lg-3 -->  