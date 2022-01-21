@extends('frontend.main')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Checkout</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                         <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->
    @auth
        <!-- checkout area start -->
        <div class="checkout-area pt-100px pb-100px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Billing Details</h3>
                            <form action="{{ url('/order') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Name</label>
                                            <input type="text" value="{{ Auth::user()->name }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Email Address</label>
                                            <input type="email" value="{{ Auth::user()->email }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Phone</label>
                                            <input name="phone" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Postcode / ZIP</label>
                                            <input name="zip" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="billing-select mb-4">

                                            <label>Country</label>
                                            <select name="country_id" class="select_country">
                                                <option>Select a country</option>
                                                @foreach($countries as $countrie)
                                                    <option value="{{ $countrie->id }}">{{ $countrie->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="billing-select mb-4">
                                            <label>City</label>
                                            <select name="city_id" class="select_city">
                                                <option> ==== Select City ==== </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Address</label>
                                            <input name="address" placeholder="Apartment, suite, unit etc." type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="additional-info-wrap">
                                    <div class="additional-info">
                                        <label>Order notes</label>
                                        <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                                  name="message"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                            <div class="your-order-area">
                                <h3>Your order</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-product-info">
                                        <div class="your-order-top">
                                            <ul>
                                                <li>Product</li>
                                                <li>Total</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-middle">
                                            <ul>
                                                @foreach($carts as $cart_product)
                                                <li><span class="order-middle-left">{{ $cart_product->relation_to_products->product_name }} <span class="text-danger"> X {{ $cart_product->quantity }}</span></span> <span
                                                        class="order-price">৳ {{ $cart_product->relation_to_products->discount_price * $cart_product->quantity}} </span></li>
                                                @endforeach
                                            </ul>
                                            <ul>
                                                <li><strong class="text-danger">Sub-Total</strong> <span class="text-danger font-weight-bolder">৳ 00</span></li>
                                            </ul>
                                        </div>
                                        <div class="your-order-bottom">
                                            <ul>
                                                <li class="your-order-shipping">Discount</li>
                                                <li><input type="hidden" name="discount" value="{{ $discount }}"></li>
                                                <li>{{ $discount }}%</li>
                                            </ul>
                                            <ul>
                                                <li class="your-order-shipping">Delivery</li>
                                                <li><input type="hidden" name="delivery" value="{{ $delivery }}"></li>
                                                <li>৳ {{ $delivery }}</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-total">
                                            <ul>
                                                <li class="order-total">Grand Total</li>
                                                <li><input type="hidden" name="grand_total" value="{{ $grand_total + $delivery }}"></li>
                                                <li>৳ {{ $grand_total + $delivery }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="payment-accordion element-mrg">
                                            <h5 class="mb-3">Select Delivary Method</h5>
                                            @error('payment')
                                                {{ $message }}
                                            @enderror
                                            <div class="form-check">
                                                <input class="form-check-input px-0" type="radio" name="payment_method" id="flexRadioDefault1" value="1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Cash on Delivery
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input px-0" type="radio" name="payment_method" id="flexRadioDefault2" value="2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Pay with SSLcommerz
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input px-0" type="radio" name="payment_method" id="flexRadioDefault3" value="3">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Pay with Stripe
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="Place-order mt-25">
                                    <button type="submit" class="btn-hover btn btn-danger px-5 py-2">Place Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout area end -->
    @else
        <div class="container">
            <div class="row">
                <div class="cold-md-12">
                    <div class="d-flex justify-content-center align-items-center my-5">
                        <h4>Please login first  </h4>
                        <a class="btn btn-primary" href="{{ url('login') }}">Login Here</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
            $('.select_country').select2();
            $('.select_city').select2();
        });



        $('.select_country').change(function () {
            var country_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type:'POST',
                url:'/getCityList',
                data:{country_id:country_id},
                success:function (data) {
                    $('.select_city').html(data);
                },
                error:function (xhr) {
                    console.log(xhr.responseText)
                }
            })

        });
    </script>
@endsection
