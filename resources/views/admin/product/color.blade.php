@extends('layouts.master')

@section('title')
    Add-Color
@endsection

@section('color')
    active
@endsection
@section('inventory_tree_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="m-0">Color</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add-Color</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
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
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colors as $index => $color)
                                <tr>
                                    <td>
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="mark[]" value="{{ $color->id }}" id="check{{ $color->id }}">
                                            <label for="check{{ $color->id }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td style="text-transform: capitalize;">{{ $color->color_name }}</td>
                                    <td>
                                        <p style="background: #{{ $color->color_code }}; height: 20px; width: 40%"></p>
                                        </td>
                                    <td>{{ $color->created_at->diffForHumans() }}</td>
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
            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Add Color</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/color/insert') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Color Name</label>
                                <input type="text" name="color_name" class="form-control" placeholder="Enter color name">
                            </div>
                            <div class="form-group">
                                <label for="">Color Code</label>
                                <input type="text" name="color_code" class="form-control" placeholder="Enter color code">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-info">Add Color</button>
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
