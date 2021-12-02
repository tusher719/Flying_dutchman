@extends('layouts.master')

@section('title')
    Setting
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0">Setting</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Setting</li>
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
                        <h3 class="card-title">Brand Name</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/brand/Name') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="brand_name" value="{{ $brand[0]->brand_name }}" class="form-control" placeholder="Enter name">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-outline-success">Name Update</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Brand Footer</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/brandUpdate') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Footer</label>
                                <input type="text" name="footer" class="form-control" placeholder="Enter footer name">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-outline-success">Footer Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


                <div class="col-lg-4 connectedSortable">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Brand Image</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/brandUpdate') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group text-center">
                                    <img src="{{asset('uploads/brand/'.$brand[0]->brand_img)}}" id="image" class="img-rounded elevation-2" alt="User Image" height="auto" width="120px">
                                </div>
                                <div class="form-group">
                                    <label for="" style="position: absolute; padding: 6px 88px; border: 1px dotted #28a745; border-radius: 5px">Select Profile Photo</label>
                                    <input type="file" name="brand_img" onchange="readURL(this)" accept="image/*" class="form-control" style="opacity: 0; padding: 2px; position: relative; cursor: pointer;">
                                    @error('brand_img')
                                    <small class="text-danger text-sm">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-outline-success">Photo Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 connectedSortable">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Brand Social</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/brandUpdate') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="text-primary">Facebook</label>
                                    <input type="text" name="facebook" class="form-control border-primary" placeholder="Enter Facebook link">
                                </div>
                                <div class="form-group">
                                    <label class="text-pink">Instagram</label>
                                    <input type="text" name="insta" class="form-control" placeholder="Enter instagram link" style="border: 1px solid #e83e8c">
                                </div>

                                <div class="form-group">
                                    <label class="text-danger">Youtube</label>
                                    <input type="text" name="youtube" class="form-control border-danger" placeholder="Enter youtube link">
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Twiiter</label>
                                    <input type="text" name="twitter" class="form-control border-info" placeholder="Enter twitter link">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-outline-success">Social Link Update</button>
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
                    $('#image').attr('src', e.target.result).width(120).height(auto);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
