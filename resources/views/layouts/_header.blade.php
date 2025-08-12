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
                             <li><a href="tel:#"><i class="icon-phone"></i>Call: 0973.797.151</a></li>
                             <li><a href="wishlist.html"><i class="icon-heart-o"></i>My Wishlist <span>(3)</span></a>
                             </li>
                             <li><a href="about.html">About Us</a></li>
                             <li><a href="contact.html">Contact Us</a></li>
                             <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
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
                             <a href="{{ url('') }}">Home</a>


                         </li>
                         <li>
                             <a href="javascript:void(0);" class="sf-with-ul">Shop</a>
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
                             <a href="product.html" class="sf-with-ul">Product</a>

                             <div class="megamenu megamenu-sm">
                                 <div class="row no-gutters">
                                     <div class="col-md-6">
                                         <div class="menu-col">
                                             <div class="menu-title">Product Details</div><!-- End .menu-title -->
                                             <ul>
                                                 <li><a href="product.html">Default</a></li>
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
                             <label for="q" class="sr-only">Search</label>
                             <input type="search" class="form-control" name="q" id="q"
                                 placeholder="Search in..." required>
                         </div>
                     </form>
                 </div><!-- End .header-search -->

                 <div class="dropdown cart-dropdown">
                     <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false" data-display="static">
                         <i class="icon-shopping-cart"></i>
                         <span class="cart-count">2</span>
                     </a>

                     <div class="dropdown-menu dropdown-menu-right">
                         <div class="dropdown-cart-products">
                             <div class="product">
                                 <div class="product-cart-details">
                                     <h4 class="product-title">
                                         <a href="product.html">Beige knitted elastic runner shoes</a>
                                     </h4>

                                     <span class="cart-product-info">
                                         <span class="cart-product-qty">1</span>
                                         x $84.00
                                     </span>
                                 </div><!-- End .product-cart-details -->

                                 <figure class="product-image-container">
                                     <a href="product.html" class="product-image">
                                         <img src="{{ asset('assets/images/products/cart/product-1.jpg') }}"
                                             alt="product">

                                     </a>
                                 </figure>
                                 <a href="#" class="btn-remove" title="Remove Product"><i
                                         class="icon-close"></i></a>
                             </div><!-- End .product -->

                             <div class="product">
                                 <div class="product-cart-details">
                                     <h4 class="product-title">
                                         <a href="product.html">Blue utility pinafore denim dress</a>
                                     </h4>

                                     <span class="cart-product-info">
                                         <span class="cart-product-qty">1</span>
                                         x $76.00
                                     </span>
                                 </div><!-- End .product-cart-details -->

                                 <figure class="product-image-container">
                                     <a href="product.html" class="product-image">
                                         <img src="{{ asset('assets/images/products/cart/product-2.jpg') }}"
                                             alt="product">

                                     </a>
                                 </figure>
                                 <a href="#" class="btn-remove" title="Remove Product"><i
                                         class="icon-close"></i></a>
                             </div><!-- End .product -->
                         </div><!-- End .cart-product -->

                         <div class="dropdown-cart-total">
                             <span>Total</span>

                             <span class="cart-total-price">$160.00</span>
                         </div><!-- End .dropdown-cart-total -->

                         <div class="dropdown-cart-action">
                             <a href="cart.html" class="btn btn-primary">View Cart</a>
                             <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i
                                     class="icon-long-arrow-right"></i></a>
                         </div><!-- End .dropdown-cart-total -->
                     </div><!-- End .dropdown-menu -->
                 </div><!-- End .cart-dropdown -->
             </div><!-- End .header-right -->
         </div><!-- End .container -->
     </div><!-- End .header-middle -->
 </header><!-- End .header -->
