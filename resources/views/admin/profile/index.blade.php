@extends('layouts.master')

@section('title')
    Home | Flying Dutchman
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 connectedSortable">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Change Your Name</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/name/update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Your Name</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control border-info">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-outline-info">Name Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 connectedSortable">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Change Your Password</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/password/update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Old Password</label>
                                <input type="password" name="old_password" class="form-control" placeholder="Enter old password">
                                @if(session('wrong_old_pass'))
                                    <small class="text-danger text-sm">
                                        {{ session('wrong_old_pass') }}
                                    </small>
                                @endif

                                @error('old_password')
                                <small class="text-danger text-sm">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter new password">
                                @error('password')
                                <small class="text-danger text-sm">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
                                @error('password_confirmation')
                                <small class="text-danger text-sm">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-outline-secondary">Password Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 connectedSortable">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Profile Image</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/photo/update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-center">
                                <img src="{{ asset('uploads/users') }}/{{ Auth::user()->user_photo }}" id="image" class="img-circle elevation-2" alt="User Image" height="120px" width="120px" style="object-fit: cover">
                            </div>
                            <div class="form-group">
                                <label for="" style="position: absolute; padding: 6px 88px; border: 1px dotted #28a745; border-radius: 5px">Select Profile Photo</label>
                                <input type="file" name="photo" onchange="readURL(this)" accept="image/*" class="form-control" style="opacity: 0; padding: 2px; position: relative; cursor: pointer;">
                                @error('photo')
                                <small class="text-danger text-sm">
                                    {{ $message }}
                                </small>
                                @enderror
                                </div>
                            <div class="form-group text-center">
                                <button class="btn btn-outline-primary">Photo Update</button>
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
        {{--Image Preview--}}
        function readURL(input) {
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result).width(120).height(120);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        @if (session('nameupdate'))
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
            title: '{{ session('nameupdate') }}'
        })
        @endif


        @if (session('wrong_old_pass'))
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
            title: '{{ session('wrong_old_pass') }}'
        })
        @endif

        @if (session('passwordupdate'))
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
            title: '{{ session('passwordupdate') }}'
        })
        @endif

        @if (session('imageupdate'))
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
            title: '{{ session('imageupdate') }}'
        })
        @endif
    </script>
@endsection
