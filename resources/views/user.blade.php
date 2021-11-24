@extends('layouts.master')
{{--@extends('layouts.app')--}}
@section('title')
    User | Flying Dutchman
@endsection

{{-- Menubar Active --}}
@section('user')
    active
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">

                    <div class="card card-success card-outline">
                        <div class="card-header">
                                <h5>Welcome, <span class="badge badge-info">{{ Auth::user()->name }}</span></h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="mb-1">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-outline-primary btn-sm checkbox-toggle"><i class="far fa-square"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-danger btn-sm">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created_at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" value="" id="check{{ $user->id }}">
                                                    <label for="check{{ $user->id }}"></label>
                                                </div>
                                            </td>
                                            <td>{{ $users->firstItem() + $index }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created_at</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
@endsection

