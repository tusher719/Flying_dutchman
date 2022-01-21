@extends('layouts.master')

@section('title')
    Add-Inventory
@endsection

@section('inventory')
    active
@endsection
@section('tree_product_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="m-0">Inventory</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/product/all')}}">Product Manage</a></li>
                <li class="breadcrumb-item active">Add-Inventory</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Color List</h3>
                    </div>
                    <div class="card-body">
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
                            <tr>
                                <th>#</th>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Color / Color Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inventorys as $index=> $inventory)
                                <tr>
                                    <td>
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="mark[]" value="{{ $inventory->id }}" id="check{{ $inventory->id }}">
                                            <label for="check{{ $inventory->id }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ \App\Models\Product::find($inventory->product_id)->product_name }}</td>
                                    <td>
                                        @if($inventory->color_id)
                                            <div style="background: #{{ \App\Models\Color::find($inventory->color_id)->color_code }}; height: 20px; width: 20px; display: inline-block;"></div>
                                            <span class="text-sm">{{ \App\Models\Color::find($inventory->color_id)->color_name }}</span>
                                        @else
                                            <span class="text-danger">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($inventory->size_id)
                                            {{ \App\Models\Size::find($inventory->size_id)->size_name }}
                                        @else
                                            <span class="text-danger">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ ($inventory->quantity) }}
                                    </td>
                                    <td>{{ $inventory->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="#"
                                           class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Add Inventory</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/inventory/insert') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="product_id" value="{{ $product_id }}" class="form-control">
                                <input type="read" value="{{ $product_name }}" class="form-control bg-secondary" readonly>
                            </div>
                            <div class="mb-3">
                                <select name="color_id" class="form-control">
                                    <option value=""> === Select Color === </option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}" style="background: #{{$color->color_code}}; text-transform: capitalize">
                                            {{ $color->color_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="size_id" class="form-control">
                                    <option value=""> === Select Size === </option>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="">Product Quantity</label>
                                <input type="text" name="quantity" class="form-control" placeholder="Enter quantity code" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-info">Add Inventory</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
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
            icon: 'success',
            title: '{{ session('success') }}'
        })
        @endif
    </script>
@endsection
