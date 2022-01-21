@extends('frontend.main')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Products Details</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ \App\Models\Category::find($product_singles->category_id)->category_name }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ \App\Models\SubCategory::find($product_singles->subcategory_id)->subcategory_name }}</a></li>
                        <li class="breadcrumb-item active">{{ $product_singles->product_name }}</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->
    <!-- Product Details Area Start -->
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <!-- Swiper -->
                    <div class="swiper-container zoom-top">
                        <div class="swiper-wrapper">
                            @foreach( App\Models\ProductThubnailMultiple::where('product_id', $product_singles->id)->get() as $product_image)
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto" src="{{ asset('uploads/product/multiple_images') }}/{{ $product_image->product_multiple_image }}"
                                     alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-container zoom-thumbs mt-3 mb-3">
                        <div class="swiper-wrapper">
                            @foreach( App\Models\ProductThubnailMultiple::where('product_id', $product_singles->id)->get() as $product_image)
                                <div class="swiper-slide">
                                    <img class="img-responsive m-auto" src="{{ asset('uploads/product/multiple_images') }}/{{ $product_image->product_multiple_image }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content">
                        <h2>{{ $product_singles->product_name }}</h2>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price cut">
                                    @if($product_singles->discount_percentage)
                                        ৳ {{ $product_singles->discount_price }}
                                    @else()
                                        ৳ {{ $product_singles->product_price }}
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <span class="text-gray">
                                <del>
                                    @if($product_singles->discount_percentage)
                                        ৳ {{ $product_singles->product_price }}
                                    @endif
                                </del>
                            </span>
                            <span class="text-danger">
                                @if($product_singles->discount_percentage)
                                    <span class="old">
                                            -{{ $product_singles->discount_percentage }}%
                                        </span>
                                @endif
                            </span>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                        </div>
                        <form action="{{ url('add/to/cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_singles->id }}">
                            <div class="pro-details-color-info d-flex align-items-center">
                                <span>Color :</span>
                                <div class="pro-details-color">
                                    <select name="color_id" id="color_list" class="form-control">
                                        <option value="">---- Select Color ----</option>
                                        @foreach($available_colors as $color)
                                            <option value="{{ $color->color_id }}">{{ App\Models\Color::find($color->color_id)->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Sidebar single item -->
                            <div class="pro-details-size-info d-flex align-items-center">
                                <span>Size :</span>
                                <div class="pro-details-size">
                                    <select name="size_id" id="size_list" class="form-control">
                                        <option value="">---- Select Size ----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="pro-details-size-info d-flex align-items-center">
                                <span class="text-success">In Stoke : </span>
                                <div class="pro-details-size">
                                    <span id="quantity"></span>
                                </div>
                            </div>
                            <p class="m-0">{{ $product_singles->product_desp }}</p>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box quantity" type="text" name="quantity" value="1" />
                                </div>
                                <div class="pro-details-cart">
                                    <button class="add-cart" href="#"> Add To Cart</button>
                                </div>
                        </form>
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                <a href="#"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-details-compare-wishlist pro-details-compare">
                                <a href="#"><i class="pe-7s-refresh-2"></i></a>
                            </div>
                        </div>
                        <div class="pro-details-sku-info pro-details-same-style d-flex">
                            <span>SKU: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ $product_singles->product_code }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                            <span>Categories: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ \App\Models\Category::find($product_singles->category_id)->category_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-social-info pro-details-same-style d-flex">
                            <span>Share: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- product details description area start -->
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details2">Information</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper text-start">
                            <ul>
                                <li><span>Weight</span> 400 g</li>
                                <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                                <li><span>Materials</span> 60% cotton, 40% polyester</li>
                                <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                            </ul>
                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <p>

                                Lorem ipsum dolor sit amet, consectetur adipisi elit, incididunt ut labore et. Ut enim
                                ad minim veniam, quis nostrud exercita ullamco laboris nisi ut aliquip ex ea commol
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste
                                natus error sit voluptatem accusantiulo doloremque laudantium, totam rem aperiam, eaque
                                ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo. Nemo enim ipsam voluptat quia voluptas sit aspernatur aut odit aut fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                                quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                                quia non numquam eius modi tempora incidunt ut labore

                            </p>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('frontend_assets') }}/images/review-image/1.png" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>
                                                    Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula. Phasellus quam nisi, congue id nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review child-review">
                                        <div class="review-img">
                                            <img src="{{ asset('frontend_assets') }}/images/review-image/2.png" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="ratting-form-wrapper pl-50">
                                    <h3>Add a Review</h3>
                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="star-box">
                                                <span>Your rating:</span>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Email" type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style form-submit">
                                                        <textarea name="Your Review" placeholder="Message"></textarea>
                                                        <button class="btn btn-primary btn-hover-color-primary "
                                                                type="submit" value="Submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details description area end -->

    <!-- Related product Area Start -->
    <div class="related-product-area pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-30px0px line-height-1">
                        <h2 class="title m-0">Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                <div class="new-product-wrapper swiper-wrapper">
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend_assets') }}/images/product-image/8.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview"
                                       title="Quick view" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                        Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend_assets') }}/images/product-image/9.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview"
                                       title="Quick view" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend_assets') }}/images/product-image/10.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-7%</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview"
                                       title="Quick view" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 90%"></span>
                                    </span>
                                    <span class="rating-num">( 4.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Long
                                        Sleeve
                                        Shirts</a></h5>
                                <span class="price">
                                    <span class="new">$30.50</span>
                                    <span class="old">$38.00</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend_assets') }}/images/product-image/11.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">Sale</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview"
                                       title="Quick view" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 70%"></span>
                                    </span>
                                    <span class="rating-num">( 3.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Parrera
                                        Sunglasses -
                                        Lomashop</a></h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend_assets') }}/images/product-image/3.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview"
                                       title="Quick view" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend_assets') }}/images/product-image/1.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview"
                                       title="Quick view" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                        Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Related product Area End -->
@endsection

@section('footer_script')
    <script>
        // Color $ size Ajax
        $('#color_list').change(function () {
            var color_id = $(this).val();
            var product_id = '{{ $product_singles->id}}'
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/getsize',
                data:{product_id:product_id, color_id:color_id},
                success:function (data) {
                    if(data.includes('>N/A<') == true) {
                        $('#size_list').html(data.replace('<option value="">---- Select Size ----</option>', ''));
                        var mainstr = data.replace('<option value="">---- Select Size ----</option>', '');
                        var size_id = mainstr.split('"')[1];

                        $.ajax({
                            type:'POST',
                            url:'/getquantity',
                            data:{size_id:size_id, color_id:color_id},
                            success:function (data) {
                                $('#quantity').html(data);
                            }
                        })

                    } else {
                        $('#size_list').html(data);
                    }
                }
            })
        });


        // Quantity Ajax
        $('#size_list').change(function () {
            var color_id = $('#color_list').val();
            var size_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/getquantity',
                data:{size_id:size_id, color_id:color_id},
                success:function (data) {
                    $('#quantity').html(data);
                }
            })
        });
    </script>
    <script>
        // Quantity Increment & Decrement
        $(function () {
            $('.inc.qtybutton').click(function () {
                var total_stock = $('#quantity').html();
                var total = parseInt(total_stock);
                var quantity = $('.quantity').val();
                if (total <= quantity) {
                    $('.inc.qtybutton').addClass('disable-plus-btn');
                }
            })

            $('.dec.qtybutton').click(function () {
                var total_stock = $('#quantity').html();
                var total = parseInt(total_stock);
                var quantity = $('.quantity').val();
                if (total >= quantity) {
                    $('.inc.qtybutton').removeClass('disable-plus-btn');
                }
            })
        });
    </script>
@endsection
