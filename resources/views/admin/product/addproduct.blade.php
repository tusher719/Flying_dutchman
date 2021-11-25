@extends('layouts.master')

@section('title')
    Add-Product | Flying Dutchman
@endsection

@section('addproduct')
    active
@endsection
@section('tree_product_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0">Category</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
