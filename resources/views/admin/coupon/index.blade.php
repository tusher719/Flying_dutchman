@extends('layouts.master')

@section('title')
    Coupon
@endsection

@section('coupon')
    active
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="m-0">Coupon</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active">Coupon</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 m-auto connectedSortable">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-layer-group"></i>
                            Coupon List
{{--                            <span class="badge bg-success">{{ $total_category }}</span>--}}
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="mb-1">
                                <!-- Check all button -->
                                    <button type="button" class="btn btn-outline-primary btn-sm checkbox-toggle">
                                        <i class="far fa-square"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
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
                                        <th>Coupon Name</th>
                                        <th>Discount %</th>
                                        <th>Validity</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($coupons as $index => $coupon)
                                        <tr>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" name="mark[]" value="{{ $coupon->id }}" id="check{{ $coupon->id }}">
                                                    <label for="check{{ $coupon->id }}"></label>
                                                </div>
                                            </td>
{{--                                            <td>{{ $coupon->firstItem() + $index }}</td>--}}
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $coupon->coupon_name }}</td>
                                            <td>{{ $coupon->discount }}</td>
                                            <td>{{ $coupon->validity }}</td>

                                            <td>{{ $coupon->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ url('/category/edit') }}/{{ $coupon->id }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a href="#" onclick="deleteTrash({{ $coupon->id }});"
                                                   class="btn btn-outline-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        Card
                    </div>
                    <div class="card-body">
                        <form action="{{ route('coupon.insert') }}" method="POST">
                            @csrf
                            <div class="form-group mt-2">
                                <label>Coupon Name</label>
                                <input type="text" name="coupon_name" class="form-control" placeholder="Enter coupon name">

                                @error('coupon_name')
                                <small class="btn text-danger text-sm mt-5">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-group mt-2">
                                <label>Discount %</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="discount" class="form-control" placeholder="Enter discount">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    </div>
                                </div>

                                @error('discount')
                                <small class="btn text-danger text-sm mt-5">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Validity</label>
                                <input type="date" name="validity" class="form-control">
{{--                                <div class="input-group date" id="reservationdate" data-target-input="nearest">--}}
{{--                                    <input type="text" name="validity" class="form-control datetimepicker-input" data-target="#reservationdate"/>--}}
{{--                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">--}}
{{--                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                    </div>--}}

{{--                                    @error('validity')--}}
{{--                                    <small class="btn text-danger text-sm mt-5">--}}
{{--                                        {{ $message }}--}}
{{--                                    </small>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-outline-info">Add Coupon</button>
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
        @if(session('success'))
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


        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'MM/DD/YYYY'
        });
    </script>
@endsection
