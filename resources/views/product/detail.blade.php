@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
    </style>
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a></li>
                    <!-- Tên danh mục -->
                    <li class="breadcrumb-item"><a
                            href="{{ url($getProduct->getCategory->slug . '/' . $getProduct->getSubcategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
                </ol>


            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <figure class="product-main-image">
                                    @php
                                        $getProductImage = $getProduct->getImageSingle($getProduct->id);
                                    @endphp
                                    @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                        <img id="product-zoom" src="{{ $getProductImage->getLogo() }}"
                                            data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    @endif
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach ($getProduct->getImage as $image)
                                        <a class="product-gallery-item" href="#" data-image="{{ $image->getLogo() }}"
                                            data-zoom-image="{{ $image->getLogo() }}">
                                            <img src="{{ $image->getLogo() }}" alt="product side">
                                        </a>
                                    @endforeach
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $getProduct->title }}</h1>
                                <!-- End .product-title -->

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: {{ $getProduct->getReviewRating($getProduct->id) }}%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <a class="ratings-text" href="#product-review-link" id="review-link">(
                                        {{ $getProduct->getTotalReview() }} đánh giá )</a>
                                </div><!-- End .rating-container -->

                                <div class="product-price">
                                    $<span id="getTotalPrice">${{ number_format($getProduct->price, 2) }}
                                    </span>
                                </div><!-- End .product-price -->

                                <div class="product-content">
                                    <p>{{ $getProduct->short_description }}</p>
                                </div><!-- End .product-content -->

                                <form action= "{{ url('product/add-to-cart') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{ $getProduct->id }}">
                                    @if (!empty($getProduct->getColor->count()))
                                        <div class="details-filter-row details-row-size">
                                            <label for="size">Màu sắc:</label>
                                            <div class="select-custom">
                                                <select name="color_id" id="color_id" required class="form-control">
                                                    <option value="">Chọn 1 màu</option>
                                                    @foreach ($getProduct->getColor as $color)
                                                        <option value="{{ $color->getColor->id }}">
                                                            {{ $color->getColor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!-- End .details-filter-row -->
                                    @endif

                                    @if (!empty($getProduct->getSize->count()))
                                        <div class="details-filter-row details-row-size">
                                            <label for="size">Kích cỡ:</label>
                                            <div class="select-custom">
                                                <select name="size_id" id="size" required
                                                    class="form-control getSizePrice">
                                                    <option value="">Chọn 1 size</option>
                                                    @foreach ($getProduct->getSize as $size)
                                                        <option data-price="{{ !empty($size->price) ? $size->price : 0 }}"
                                                            value="{{ $size->id }}">
                                                            {{ $size->name }}
                                                            @if ($size->price !== null)
                                                                (${{ number_format($size->price, 2) }})
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div><!-- End .select-custom -->
                                    @endif


                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Số lượng:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1"
                                        max="100" name="qty" required step="1" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <button style="background: #fff;color: #96;" type="submit"
                                    class="btn-product btn-cart">Thêm vào giỏ hàng</button>

                                <div class="details-action-wrapper">
                                    @if (!empty(Auth::check()))
                                        <a href="javascript:;"
                                            class="add_to_wishlist add_to_wishlist{{ $getProduct->id }} {{ !empty($getProduct->checkWishlist($getProduct->id)) ? 'btn-wishlist-add' : '' }} btn-product btn-wishlist"
                                            title="Wishlist" id="{{ $getProduct->id }}"><span>Thêm vào danh sách yêu thích
                                            </span></a>
                                    @else
                                        <a href="#sigin-modal" data-toggle="modal" class="btn-product btn-wishlist"
                                            title="Wishlist"><span>Thêm vào danh sách yêu thích</span></a>
                                    @endif
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->

                            </form>

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Danh mục chính:</span>
                                    <a
                                        href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }},</a>
                                    <!-- Tên danh mục -->
                                    <span>Danh mục con:</span>
                                    <a
                                        href="{{ url($getProduct->getCategory->slug . '/' . $getProduct->getSubcategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a>
                                </div><!-- End .product-cat -->

                                {{-- <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                            class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                            class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                            class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                            class="icon-pinterest"></i></a>
                                </div>  --}}
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                            role="tab" aria-controls="product-desc-tab" aria-selected="true">Mô tả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                            role="tab" aria-controls="product-info-tab" aria-selected="false">Thông tin bổ sung
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab"
                            role="tab" aria-controls="product-shipping-tab" aria-selected="false">Vận chuyển & đổi
                            trả
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                            role="tab" aria-controls="product-review-tab" aria-selected="false">Đánh giá
                            ({{ $getProduct->getTotalReview() }})</a>
                    </li>
                </ul>
            </div><!-- End .container -->

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                    aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px;">
                            {!! $getProduct->description !!}
                        </div>
                    </div>

                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px;">
                            {!! $getProduct->additional_information !!}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                    aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px;">
                            {!! $getProduct->shipping_returns !!}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                    aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container">
                            <h3>Đánh giá ({{ $getProduct->getTotalReview() }})</h3>
                            <div class="review">
                                @foreach ($getReviewProduct as $review)
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">{{ $review->name }}</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val"
                                                        style="width: {{ $review->getPercent() }}%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span
                                                class="review-date">{{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>{{ $review->review }}</h4>

                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                @endforeach
                                  <div class="p-3">
                    {{ $getReviewProduct->links() }}
                </div>
                            </div><!-- End .review -->


                        </div><!-- End .container -->
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <div class="container">
            <h2 class="title text-center mb-4">Có thể bạn cũng thích</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>

                @foreach ($getRelatedProduct as $value)
                    @php
                        $getProductImage = $value->getImageSingle($value->id);
                    @endphp
                    <div class="product product-7">
                        <figure class="product-media">
                            <a href="{{ url($value->slug) }}">
                                @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                    <img style="height: 280px; width: 100%; object-fit: cover;"
                                        src="{{ $getProductImage->getLogo() }}" alt="{{ $value->title }}"
                                        class="product-image">
                                    <!-- Hiện ảnh của 1 sản phẩm . Hiện tên sản phẩm khi k có ảnh -->
                                @endif
                            </a>
                            <div class="product-action-vertical">
                                @if (!empty(Auth::check()))
                                    <a href="javascript:;" data-toggle="modal"
                                        class="add_to_wishlist add_to_wishlist{{ $value->id }} btn-product-icon btn-wishlist btn-expandable {{ !empty($value->checkWishlist($value->id)) ? 'btn-wishlist-add' : '' }}"
                                        id="{{ $value->id }}" title="Wishlist">
                                        <span>Thêm vào danh sách yêu thích</span>
                                    </a>
                                @else
                                    <a href="#sigin-modal" data-toggle="modal"
                                        class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist"><span>Thêm
                                            vào danh sách yêu thích
                                        </span></a>
                                @endif

                            </div>

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{ url($value->category_slug . '/' . $value->sub_category_slug) }}">
                                    {{ $value->sub_category_name }} <!-- Tên danh mục con -->
                                </a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title">
                                <a href="{{ url($value->slug) }}">{{ $value->title }}</a>
                                <!--Tên sản phẩm -->
                            </h3>
                            <div class="product-price">
                                ${{ number_format($value->price, 2) }} <!-- Gía sản phẩm-->
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 20%;"></div>
                                </div>
                                <span class="ratings-text">( 2 Reviews )</span>
                            </div>

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Tên
                                        màu
                                    </span></a>
                                <a href="#" style="background: #7fc5ed;"><span class="sr-only">Tên màu
                                    </span></a>
                                <a href="#" style="background: #e8c97a;"><span class="sr-only">Tên màu
                                    </span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                @endforeach

              
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
    <script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>

    <script type="text/javascript">
        $('.getSizePrice').change(function() {
            // Lấy giá gốc của sản phẩm (từ Laravel Blade)
            var product_price = parseFloat('{{ $getProduct->price }}');

            // Lấy giá size từ option đang chọn
            var price = parseFloat($(this).find('option:selected').attr('data-price'));

            // Nếu không có giá thì mặc định là 0
            if (isNaN(price)) {
                price = 0;
            }

            // Cộng tổng giá
            var total = product_price + price;
            $('#getTotalPrice').html(total);

        });
    </script>

    </script>
@endsection
