@extends('layouts.master')
{{--@extends('layouts.app')--}}

@section('title')
    Home
@endsection

{{-- MenuBar Active --}}
@section('subcategory')
    active
@endsection
@section('tree_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit SubCategory</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/subcategory')}}">subcategory</a></li>
                <li class="breadcrumb-item active">Edit SubCategory</li>
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
                        <h3 class="card-title"><i class="far fa-edit"></i> SubCategory Edit</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/subcategory/update')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="subcategory_id" value="{{ $subcategories->id }}">
                                <label>Category Name</label>
                                <select name="category_id" class="form-control border border-info">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $subcategories->category_id == $category->id?'selected':'' }}>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div><div class="mb-3">
                                <label>SubCategory Name</label>
                                <input type="text" name="subcategory_name" value="{{$subcategories->subcategory_name}}" class="form-control border border-info" placeholder="Enter category name">
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
@section('footer_script')
    <secript>

        @if (session('success'))
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
            icon: 'error',
            title: '{{ session('success') }}'
            })
        @endif
    </secript>
@endsection
