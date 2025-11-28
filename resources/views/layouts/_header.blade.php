 <header class="header">
     <div class="header-top">
         <div class="container">
             <div class="header-left">
                 <div class="header-dropdown">
                     <a href="#">Usd</a>
                     <div class="header-menu">
                         <ul>
                             <li><a href="#">Usd</a></li>
                         </ul>
                     </div>
                 </div>

                 <div class="header-dropdown">
                     <a href="#">Eng</a>
                     <div class="header-menu">
                         <ul>
                             <li><a href="#">English</a></li>

                         </ul>
                     </div>
                 </div>
             </div>

             <div class="header-right">
                 <ul class="top-menu">
                     <li>
                         <a href="#">Links</a>
                         <ul>
                             <li><a href="tel:#"><i class="icon-phone"></i>Gọi: 0973.797.151</a></li>
                             @if(!empty(Auth::check()))
                             <li><a href="{{ url('my-wishlist')}}"><i class="icon-heart-o"></i>Danh sách yêu thích</a>
                             </li>
                             @else
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-hear-o"></i>Danh sách yêu thích</a></li>
                             @endif
                             <li><a href="{{ url('about') }}">Về chúng tôi</a></li>
                             <li><a href="{{ url('contact') }}">Liên hệ chúng tôi</a></li>
                             @if(!empty(Auth::check()))
                             <li><a href="{{ url('user/dashboard') }}"><i class="icon-user"></i>{{ Auth::user()->name }}</a></li>
                           @else
                             <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Đăng nhập</a></li>
                            
                             @endif
                         </ul>
                     </li>
                 </ul>
             </div>
         </div>
     </div>

     <div class="header-middle sticky-header">
         <div class="container">
             <div class="header-left">
                 <button class="mobile-menu-toggler">
                     <span class="sr-only">Toggle mobile menu</span>
                     <i class="icon-bars"></i>
                 </button>

                 <a href="index.html" class="logo">
                     <img src="{{ asset('assets/images/logo.png') }}" alt="Molla Logo" width="105" height="25">

                 </a>

                 <nav class="main-nav">
                     <ul class="menu sf-arrows">
                         <li class="">
                             <a href="{{ url('') }}">Trang chủ</a>


                         </li>
                         <li>
                             <a href="javascript:void(0);" class="sf-with-ul">Cửa hàng</a>
                             <div class="megamenu megamenu-md">
                                 <div class="row no-gutters">
                                     <div class="col-md-12">
                                         <div class="menu-col">
                                             <div class="row">
                                                 @php
                                                     $getCategoryHeader = App\Models\Category::getRecordMenu();
                                                 @endphp
                                                 @foreach ($getCategoryHeader as $value_category_header)
                                                     @if (!empty($value_category_header->getSubCategory->count()))
                                                         <div class="col-md-4" style="margin-bottom: 20px;">
                                                             <a href="{{ url($value_category_header->slug) }}"
                                                                 class="menu-title">
                                                                 {{ $value_category_header->name }}</a>
                                                             <!-- End .menu-title -->
                                                             <ul>
                                                                 @foreach ($value_category_header->getSubCategory as $value_sub_header)
                                                                     <li>
                                                                         <a
                                                                             href="{{ url($value_category_header->slug . '/' . $value_sub_header->slug) }}">
                                                                             {{ $value_sub_header->name }}
                                                                         </a>
                                                                     </li>
                                                                 @endforeach
                                                             </ul>
                                                         </div>
                                                     @endif
                                                 @endforeach

                                             </div>
                                         </div>
                                     </div>


                                 </div>
                             </div>
                         </li>
                         <li>
                             <a href="product.html" class="sf-with-ul">Sản phẩm</a>

                             <div class="megamenu megamenu-sm">
                                 <div class="row no-gutters">
                                     <div class="col-md-6">
                                         <div class="menu-col">
                                             <div class="menu-title">Chi tiết sản phẩm</div><!-- End .menu-title -->
                                             <ul>
                                                 <li><a href="product.html">Mặc định</a></li>
                                                 <li><a href="product-centered.html">Centered</a></li>
                                                 <li><a href="product-extended.html"><span>Extended Info<span
                                                                 class="tip tip-new">New</span></span></a></li>
                                                 <li><a href="product-gallery.html">Gallery</a></li>
                                                 <li><a href="product-sticky.html">Sticky Info</a></li>
                                                 <li><a href="product-sidebar.html">Boxed With Sidebar</a></li>
                                                 <li><a href="product-fullwidth.html">Full Width</a></li>
                                                 <li><a href="product-masonry.html">Masonry Sticky Info</a></li>
                                             </ul>
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="banner banner-overlay">
                                             <a href="category.html">
                                                 <img src="{{ asset('assets/images/menu/banner-2.jpg') }}"
                                                     alt="Banner">


                                                 <div class="banner-content banner-content-bottom">
                                                     <div class="banner-title text-white">New
                                                         Trends<br><span><strong>spring 2019</strong></span></div>
                                                 </div>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </li>

                     </ul><!-- End .menu -->
                 </nav><!-- End .main-nav -->
             </div><!-- End .header-left -->

             <div class="header-right">
                 <div class="header-search">
                     <a href="#" class="search-toggle" role="button" title="Search"><i
                             class="icon-search"></i></a>
                     <form action="{{ url('search') }}" method="get">
                         <div class="header-search-wrapper">
                             <label for="q" class="sr-only">Tìm kiếm</label>
                             <input type="search" class="form-control" name="q" id="q"
                                 placeholder="Tìm kiếm..." value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}" required>
                         </div>
                     </form>
                 </div><!-- End .header-search -->

                 <div class="dropdown cart-dropdown">
                     <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false" data-display="static">
                         <i class="icon-shopping-cart"></i>
                        <span class="cart-count">{{ Cart::getContent()->count() }}</span>
                        </a>

                     <div class="dropdown-menu dropdown-menu-right">
                         <div class="dropdown-cart-products">
                            @foreach(Cart::getContent() as $header_cart)
                            @php
                                $getCartProduct = App\Models\Product::getSingle($header_cart->id);
                            @endphp
                            @if(!empty($getCartProduct))
                            @php
                                   $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                            @endphp
                             <div class="product">
                                 <div class="product-cart-details">
                                     <h4 class="product-title">
                                        <a href="{{  url($getCartProduct->slug) }}"> {{ $getCartProduct->title }}
                                    </h4>

                                     <span class="cart-product-info">
                                        <span class="cart-product-qty">{{ $header_cart->quantity }}</span>
                                    x ${{ number_format($header_cart->price,2) }}
                                    </span>
                                 </div><!-- End .product-cart-details -->

                                 <figure class="product-image-container">
                                     <a href="product.html" class="product-image">
                                         <img src="{{ $getProductImage->getLogo() }}"
                                             alt="product">

                                     </a>
                                 </figure>
                                 <a href="{{ url('cart/delete/'. $header_cart->id) }}" class="btn-remove" title="Remove Product"><i
                                         class="icon-close"></i></a>
                             </div>
                             @endif
                             @endforeach
                            
                         </div><!-- End .cart-product -->

                         <div class="dropdown-cart-total">
                             <span>Tổng tiền</span>

                             <span class="cart-total-price">${{ number_format(Cart::getSubTotal(),2) }}</span>
                         </div><!-- End .dropdown-cart-total -->

                         <div class="dropdown-cart-action">
                             <a href="{{ url('cart') }}" class="btn btn-primary">Giỏ hàng</a>
                             <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2"><span>Thanh toán</span><i
                                     class="icon-long-arrow-right"></i></a>
                         </div><!-- End .dropdown-cart-total -->
                     </div><!-- End .dropdown-menu -->
                 </div><!-- End .cart-dropdown -->
             </div><!-- End .header-right -->
         </div><!-- End .container -->
     </div><!-- End .header-middle -->
 </header><!-- End .header -->
