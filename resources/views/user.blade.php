@extends('layouts.master')
{{--@extends('layouts.app')--}}
@section('title')
    User
@endsection

{{-- Menubar Active --}}
@section('user')
    active
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0">Users</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">

                    <div class="card card-success card-outline">
                        <div class="card-header">
                                <h4 class="card-title">Welcome, <span class="badge badge-warning">{{ Auth::user()->name }}</span> <i class="fas fa-angle-double-right"></i>
                                    <span>
                                        @if(Auth::user()->role == 1)
                                            <span class="badge badge-success">Admin</span>
                                        @elseif(Auth::user()->role == 2)
                                            <span class="badge badge-primary">Moderator</span>
                                        @elseif(Auth::user()->role == 3)
                                            <span class="badge badge-info">Shopkeeper</span>
                                        @else
                                            <span class="badge badge-secondary">User</span>
                                        @endif
                                    </span>
                                </h4>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
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
                                            <td>
                                                <img style="height: 40px; width: 40px; object-fit: cover;"
                                                     src="{{ asset('uploads/users') }}/{{ $user->user_photo }}"
                                                     class="img-circle elevation-2" alt="User Image">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role == 1)
                                                    <span class="badge badge-success">Admin</span>
                                                @elseif($user->role == 2)
                                                    <span class="badge badge-primary">Moderator</span>
                                                @elseif($user->role == 3)
                                                    <span class="badge badge-info">Shopkeeper</span>
                                                @else
                                                    <span class="badge badge-secondary">User</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-4">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Add User</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('insert_user') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name...">
                                    @error('name')
                                    <strong class="text-danger text-sm">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email...">
                                    @error('email')
                                    <strong class="text-danger text-sm">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password...">
                                    @error('password')
                                    <strong class="text-danger text-sm">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="from-group">
                                    <select name="role" class="form-control">
                                        <option value=""> ==== Select Role ====</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Moderator</option>
                                        <option value="3">Shopkeeper</option>
                                    </select>
                                </div>
                                <div class="from-group mt-3 text-center">
                                    <button type="submit" class="btn btn-outline-info">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
@endsection
@section('footer_script')
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
@endsection
