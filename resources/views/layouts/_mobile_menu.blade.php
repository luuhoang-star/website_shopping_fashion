    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Tìm kiếm</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                    placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active">
                        <a href="{{ url('') }}">Trang chủ</a>
                    </li>
                    @php
                        $getCategoryMobile = App\Models\Category::getRecordMenu(); // Lấy danh sách bảng Category
                    @endphp
                    @foreach ($getCategoryMobile as $value_category_mobile) <!-- Đặt tên dễ nhớ-->
                        @if (!empty($value_category_mobile->getSubCategory->count())) <!-- Điều kiện để hiện thị cả danh mục vs danh mục con,tránh danh mục k có danh mục con nào-->
                            <li>
                                <a href="{{ url($value_category_mobile->slug) }}">{{ $value_category_mobile->name }}</a> <!--In đường dẫn danh mục cha. Hiển thị tên danh mục cha-->
                                <ul>
                                    @foreach ($value_category_mobile->getSubCategory as $value_sub_mobile) <!-- Lấy đc bảng sub nhờ mqh 1-n trong Model Category-->
                                        <li><a
                                                href="{{ url($value_category_mobile->slug . '/' . $value_sub_mobile->slug) }}">{{ $value_sub_mobile->name }}</a> <!-- In đường dẫn:slug cha vs slug con(chuẩn logic). Hiển thị danh mục con -->
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i
                        class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i
                        class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->
