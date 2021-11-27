@extends('layouts.master')

@section('title')
    All-Product | Flying Dutchman
@endsection

@section('productAdd')
    active
@endsection
@section('tree_product_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0">Product</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item active">Manage Product</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
