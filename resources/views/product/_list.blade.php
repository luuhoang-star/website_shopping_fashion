 <div class="products mb-3">
     <div class="row justify-content-center">
         @foreach ($getProduct as $value)
             @php
                 $getProductImage = $value->getImageSingle($value->id); // id trong bảng product // nhằm hiện ảnh thuộc đúng 1 sp
             @endphp

             <div class="col-12 col-md-4 col-lg-4 mb-4">
                 <div class="product product-7 text-center">
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
                                     class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist"><span>
                                         Thêm vào danh sách yêu thích</span></a>
                             @endif
                         </div>
                     </figure>

                     <div class="product-body">
                         <div class="product-cat">
                             <a href="{{ url($value->category_slug . '/' . $value->sub_category_slug) }}">
                                 {{ $value->sub_category_name }} <!-- Tên danh mục con -->
                             </a>
                         </div>

                         <h3 class="product-title">
                             <a href="{{ url($value->slug) }}">{{ $value->title }}</a>
                             <!--Tên sản phẩm -->
                         </h3>

                         <div class="product-price">
                             ${{ number_format($value->price, 2) }} <!-- Gía sản phẩm-->
                         </div>

                         <div class="ratings-container">
                             <div class="ratings">
                                 <div class="ratings-val" style="width: {{ $value->getReviewRating($value->id) }}%;">
                                 </div>
                             </div>

                             <span class="ratings-text">{{ $value->getTotalReview() }} đánh giá</span>
                         </div>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 </div>
