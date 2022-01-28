@extends('frontend.main')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Order Confirm</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Confirmed</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="card text-center">
                        <div class="card-header bg-success">
                            <h5 class="text-white">Order Confirmation Message</h5>
                        </div>
                        <div class="card-header">
                            <h5><span class="text-success">Congratulation!</span> {{ Auth::user()->name }}, Your order has been placed</h5>
                        </div>
                        <div class="mt-3 mb-3">
                            <a href="{{ url('/') }}">
                                <button class="btn-danger">Continue Shopping</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
