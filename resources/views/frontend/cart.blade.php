@extends('frontend.main')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Product Cart</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="{{ route('cart.update') }}" method="post">
                        @csrf
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $total = 0;
                                @endphp
                                @forelse($carts as $cart)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="{{ route('details', $cart->product_id) }}"><img class="img-responsive ml-15px" style="height: 80px; width: 80px; object-fit: cover"
                                                             src="{{ asset('uploads/product') }}/{{ App\Models\Product::find($cart->product_id)->product_thumbnail }}" alt="" /></a>
                                        </td>
                                        <td class="product-name" style="text-align: left">
                                            <a href="{{ route('details', $cart->product_id) }}">{{ App\Models\Product::find($cart->product_id)->product_name }}</a>
                                        </td>
                                        <td class="product-price-cart">
                                            <span class="amount fw-bold">
                                                @if(App\Models\Product::find($cart->product_id)->discount_percentage)
                                                    ৳ {{ number_format(App\Models\Product::find($cart->product_id)->discount_price) }}
                                                @else
                                                    ৳ {{ number_format(App\Models\Product::find($cart->product_id)->product_price) }}
                                                @endif
                                            </span>
                                            <br>
                                            <del class="text-gray-dark" style="font-size: 13px; font-style: italic">
                                                @if(App\Models\Product::find($cart->product_id)->discount_percentage)
                                                    <span class="old text-cyan">
                                                        ৳ {{ number_format(App\Models\Product::find($cart->product_id)->product_price) }}
                                                    </span>
                                                @endif
                                            </del>
                                            <span class="fw-bold" style="font-size: 13px;">
                                                @if(App\Models\Product::find($cart->product_id)->discount_percentage)
                                                    (-{{ App\Models\Product::find($cart->product_id)->discount_percentage }}%)
                                                @endif
                                            </span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton[{{ $cart->id }}]"
                                                       value="{{ $cart->quantity }}" />
                                            </div>
                                        </td>
                                        <td class="d-none">{{ $cart->quantity }}</td>
                                        <td class="d-none">
                                            @if(App\Models\Product::find($cart->product_id)->discount_percentage)
                                                ৳ {{ App\Models\Product::find($cart->product_id)->discount_price * $cart->quantity }}
                                            @else
                                                ৳ {{ App\Models\Product::find($cart->product_id)->product_price * $cart->quantity }}
                                            @endif
                                        </td>
                                        <td class="product-subtotal">
                                            @if(App\Models\Product::find($cart->product_id)->discount_percentage)
                                                ৳ {{ number_format(App\Models\Product::find($cart->product_id)->discount_price * $cart->quantity) }}
                                            @else
                                                ৳ {{ number_format(App\Models\Product::find($cart->product_id)->product_price * $cart->quantity) }}
                                            @endif
                                        </td>
                                        <td class="product-remove">
                                            <a href="{{ route('cart.remove', $cart->id) }}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                        $total = $total+(App\Models\Product::find($cart->product_id)->discount_price * $cart->quantity)
                                    @endphp
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h1 class="text-danger">
                                                ¯\_(ツ)_/¯
                                            </h1>
                                            <h5 class="text-danger">
                                                You don’t have any product yet. <br>
                                                Choose a product to get started.
                                            </h5>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{ url('/') }}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button type="submit">Update Shopping Cart</button>
                                        <a href="{{ route('cart.clear') }}" class="btn1">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="cart-tax">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                </div>
                                <div class="tax-wrapper">
                                    <p>Enter your destination to get a shipping estimate.</p>
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                * Country
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select">
                                            <label>
                                                * Region / State
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select mb-25px">
                                            <label>
                                                * Zip/Postal Code
                                            </label>
                                            <input type="text" />
                                        </div>
                                        <button class="cart-btn-2" type="submit">Get A Quote</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>

                                @if(session('invalid'))
                                    <h4 class="text-danger">{{ session('invalid') }}</h4>
                                @else
                                    <h4 class="text-success">Discount {{ $discount }}%</h4>
                                @endif

                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form>
                                        <input type="text" id="coupon_code" placeholder="Enter coupon" value="{{ $coupon_code }}"/>
                                        <button id="apply_coupon" class="cart-btn-2" type="button">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total Price <span>৳ {{ number_format("$total",2) }}</span></h5>
                                <h5>Discount <span>{{ $discount }}%</span></h5>
                                <h5 id="total" class="d-none">
                                        @php
                                            $after_discount = $total-(($total*$discount)/100);
                                            echo $after_discount;
                                        @endphp
                                </h5>
                                <h4 class="grand-totall-title">Grand Total
                                    <span id="grand_total">৳
                                        @php
                                            $after_discount = $total-(($total*$discount)/100);
                                            echo number_format("$after_discount",2);
                                            session([
                                                'discount' => $discount,
                                                'sub_total' => $total,
                                                'total' => $total-(($total*$discount)/100),
                                            ])
                                        @endphp
                                    </span>
                                </h4>
                                <a href="{{ route('checkout') }}" class="btn btn-danger px-3 py-3">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection

@section('footer_script')
    <script>
        $(function () {
            // Quantity Increment
            $('.dec.qtybutton').click(function () {
                var currentRow = $(this).closest('tr');
                var quantity = currentRow.find('td:eq(4)').text();
                var price = currentRow.find('td:eq(5)').text();
                currentRow.find('td:eq(6)').text(quantity*price);
            });

            // Quantity Decrement
            $('.inc.qtybutton').click(function () {
                var currentRow = $(this).closest('tr');
                var quantity = currentRow.find('td:eq(4)').text();
                var price = currentRow.find('td:eq(5)').text();
                currentRow.find('td:eq(6)').text(quantity*price);
            });

        });


        // Apply Coupon
        $('#apply_coupon').click(function () {
            var coupon_code = $('#coupon_code').val();
            var current_link = "{{ url('cart') }}";
            var link_to_go = current_link+'/'+coupon_code;
            window.location.href=link_to_go;
        })
        </script>
@endsection
