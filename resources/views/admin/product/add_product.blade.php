@extends('layouts.master')

@section('title')
    Add-Product
@endsection

@section('productAdd')
    active
@endsection
@section('tree_product_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="m-0">Product</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add-Product</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/product/insert') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Category Select</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">----- Select Option -----</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">SubCategory Select</label>
                                        <select name="subcategory_id" class="form-control">
                                            <option value="">----- Select Option -----</option>
{{--                                            @foreach($sub_categories as $subcategory)--}}
{{--                                                <option value="{{$subcategory->id}}">{{ $subcategory->subcategory_name }}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <input type="text" name="product_name" class="form-control" placeholder="Enter product name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <input type="text" name="product_price" class="form-control" placeholder="Enter selling price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Discount Percentage</label>
                                        <input type="text" name="discount_percentage" class="form-control" placeholder="Enter selling price">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Description</label>
                                        <textarea name="product_desp" class="form-control" placeholder="Enter description...."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Main Thumbnail</label>
                                        <input type="file" name="product_thumbnail" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Multiple Thumbnail</label>
                                        <input type="file" name="product_multiple[]" class="form-control" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script type="text/javascript">
        @if (session('add_product'))
        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

        Toast.fire({
            icon: 'success',
            title: '{{ session('add_product') }}'
        })
        @endif



        // SubCategory Show Ajax Function
        {{--$(document).ready(function () {--}}
        {{--    $('select[name="category_id"]').on('change', function () {--}}
        {{--        var category_id = $(this).val();--}}
        {{--        if (category_id) {--}}
        {{--            $.ajax({--}}
        {{--                url: "{{ url('/subcategory/ajax') }}/"+category_id,--}}
        {{--                type: "GET",--}}
        {{--                dataType: "json",--}}
        {{--                success:function (data) {--}}
        {{--                    var d =$('select[name="subcategory_id"]').empty();--}}
        {{--                    $.each(data, function (key, value) {--}}
        {{--                        $.('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>');--}}
        {{--                    });--}}
        {{--                },--}}
        {{--            });--}}
        {{--        } else {--}}
        {{--            alert('danger');--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection

