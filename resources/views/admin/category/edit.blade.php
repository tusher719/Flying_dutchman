@extends('layouts.master')
{{--@extends('layouts.app')--}}


@section('title')
    Edit Category
@endsection

@section('category')
    active
@endsection
@section('tree_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/category')}}">Category</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-edit"></i> Edit Category
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/category/update')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="category_id" value="{{$category_info->id}}">
                                <label>Category Name</label>
                                <input type="text" name="category_name" value="{{$category_info->category_name}}" class="form-control border border-info"
                                       placeholder="Enter category name">
                                @error('category_name')
                                <small class="btn text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-primary">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
