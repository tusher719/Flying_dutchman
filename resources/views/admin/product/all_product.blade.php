@extends('layouts.master')

@section('title')
    All-Product
@endsection

@section('productManage')
    active
@endsection
@section('tree_product_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0">All-Product</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Manage-Product</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 CLASS="card-title">All Product</h3>
                    </div>
                    <div class="card-body">
                        <form>
                        <div class="mb-1">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-outline-primary btn-sm checkbox-toggle" data-toggle="tooltip" data-placement="top" title="Mark All Data">
                                    <i class="far fa-square"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Mark Data Delete">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-reply"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        <div class="table-responsive mailbox-messages">
                            <table id="example1" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr class="text-sm">
                                    <th>#</th>
                                    <th>SL</th>
                                    <th>Category</th>
                                    <th>SubCategory</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Regular Price</th>
                                    <th>Discount</th>
                                    <th>Disc Price</th>
                                    <th>Description</th>
                                    <th>Thumbnail</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($all_products as $index=>$products)
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check{{ $products->id }}">
                                                <label for="check{{ $products->id }}"></label>
                                            </div>
                                        </td>
                                        {{--                                        <td>{{ $subcategories->firstItem() + $index }}</td>--}}
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ App\Models\Category::find($products->category_id)->category_name }}</td>
                                        <td>{{ App\Models\SubCategory::find($products->subcategory_id)->subcategory_name }}</td>
                                        <td>{{ $products->product_name }}</td>
                                        <td>{{ $products->product_code }}</td>
                                        <td>{{ $products->product_price }}</td>
                                        <td>
                                            @if( $products->discount_percentage )
                                                {{ $products->discount_percentage }}%
                                                @else
                                                    <span class="text-danger"> N/A </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $products->discount_percentage )
                                                {{ $products->discount_price }}
                                            @else
                                                <span class="text-danger"> N/A </span>
                                            @endif
                                        </td>
                                        <td>{{ $products->product_desp }}</td>
                                        <td>
                                            <img width="80px" src="{{ asset('/uploads/product') }}/{{ $products->product_thumbnail }}" alt="">
                                        </td>
                                        <td>{{ $products->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url('/subcategory/edit') }}/{{ $products->id }}"
                                               class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <a href="#" onclick="deleteCategory({{ $products->id }});"
                                               class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="far fa-trash-alt"></i>
                                            </a>

                                            <form id="delete-data-{{ $products->id }}"
                                                  action="{{ url('/subcategory/delete') }}/{{ $products->id }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
