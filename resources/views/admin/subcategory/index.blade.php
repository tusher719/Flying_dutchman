@extends('layouts.master')
{{--@extends('layouts.app')--}}

{{-- Page Title --}}
@section('title')
    SubCategory | Flying Dutchman
@endsection

{{-- MenuBar Active --}}
@section('subcategory')
    active
@endsection
@section('tree_menu')
    menu-open
@endsection

{{-- Container Title --}}
@section('pageTitle')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">SubCategory</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item active">SubCategory</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 connectedSortable">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-list-ul"></i>
                            SubCategory List
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
                                    <th>Subcategory Name</th>
                                    <th>Category Name</th>
                                    <th>Added By</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($subcategories as $index => $subcategory)
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check{{ $subcategory->id }}">
                                                <label for="check{{ $subcategory->id }}"></label>
                                            </div>
                                        </td>
{{--                                        <td>{{ $subcategories->firstItem() + $index }}</td>--}}
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ App\Models\Category::find($subcategory->category_id)->category_name }}</td>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ App\Models\User::find($subcategory->added_by)->name }}</td>
                                        <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url('/subcategory/edit') }}/{{ $subcategory->id }}"
                                               class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <a href="#" onclick="deleteCategory({{ $subcategory->id }});"
                                               class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="far fa-trash-alt"></i>
                                            </a>

                                            <form id="delete-data-{{ $subcategory->id }}"
                                                  action="{{ url('/subcategory/delete') }}/{{ $subcategory->id }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
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
            <div class="col-md-3 connectedSortable">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-plus-square"></i>
                            Add Subcategory
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('/subcategory/insert') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="">Category List</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Cetegory</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="btn text-danger text-sm">
                                    {{ $message }}
                                </small>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label>Subcategory Name</label>
                                <input type="text" name="subcategory_name" class="form-control"
                                       placeholder="Enter Subcategory name">
                                @error('subcategory_name')
                                <small class="btn text-danger text-sm">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-info">Add Subcategory</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>







    {!! Toastr::message() !!}
@endsection

{{--@section('footer_script')--}}
{{--    <script>--}}
{{--        --}}{{-- Success Function --}}
{{--        @if (session('success'))--}}
{{--        const Toast = Swal.mixin({--}}
{{--            toast: true,--}}
{{--            position: 'top-end',--}}
{{--            showConfirmButton: false,--}}
{{--            timer: 3000,--}}
{{--            timerProgressBar: true,--}}
{{--            didOpen: (toast) => {--}}
{{--                toast.addEventListener('mouseenter', Swal.stopTimer)--}}
{{--                toast.addEventListener('mouseleave', Swal.resumeTimer)--}}
{{--                }--}}
{{--            })--}}
{{--        Toast.fire({--}}
{{--            icon: 'success',--}}
{{--            title: '{{ session('success') }}'--}}
{{--        })--}}
{{--        @endif--}}

{{--        --}}{{-- Update Function --}}
{{--        @if (session('update'))--}}
{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 3000,--}}
{{--                timerProgressBar: true,--}}
{{--                didOpen: (toast) => {--}}
{{--                    toast.addEventListener('mouseenter', Swal.stopTimer)--}}
{{--                    toast.addEventListener('mouseleave', Swal.resumeTimer)--}}
{{--                }--}}
{{--            })--}}

{{--            Toast.fire({--}}
{{--                icon: 'success',--}}
{{--                title: '{{ session('update') }}'--}}
{{--            })--}}
{{--        @endif--}}

{{--        --}}{{-- Already Exist Function --}}
{{--        @if (session('exist_subcategory'))--}}
{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 3000,--}}
{{--                timerProgressBar: true,--}}
{{--                didOpen: (toast) => {--}}
{{--                    toast.addEventListener('mouseenter', Swal.stopTimer)--}}
{{--                    toast.addEventListener('mouseleave', Swal.resumeTimer)--}}
{{--                }--}}
{{--            })--}}

{{--            Toast.fire({--}}
{{--                icon: 'error',--}}
{{--                title: '{{ session('exist_subcategory') }}'--}}
{{--            })--}}
{{--        @endif--}}


{{--        --}}{{-- Delete Function --}}
{{--        function deleteCategory(id) {--}}
{{--            const swalWithBootstrapButtons = Swal.mixin({--}}
{{--                customClass: {--}}
{{--                    confirmButton: 'btn btn-success',--}}
{{--                    cancelButton: 'btn btn-danger'--}}
{{--                },--}}
{{--                buttonsStyling: false--}}
{{--            })--}}

{{--            swalWithBootstrapButtons.fire({--}}
{{--                title: 'Are you sure?',--}}
{{--                text: "This will be delete permanently!",--}}
{{--                icon: 'warning',--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonText: 'Yes, delete it!',--}}
{{--                cancelButtonText: 'No, cancel!',--}}
{{--                reverseButtons: true--}}
{{--            }).then((result) => {--}}
{{--                if (result.isConfirmed) {--}}
{{--                    swalWithBootstrapButtons.fire(--}}
{{--                        'Deleted!',--}}
{{--                        'SubCategory Deleted Successfully',--}}
{{--                        'success'--}}
{{--                    )--}}
{{--                    event.preventDefault();--}}
{{--                    document.getElementById('delete-data-' + id).submit();--}}
{{--                } else if (--}}
{{--                    /* Read more about handling dismissals below */--}}
{{--                    result.dismiss === Swal.DismissReason.cancel--}}
{{--                ) {--}}
{{--                    swalWithBootstrapButtons.fire(--}}
{{--                        'Cancelled',--}}
{{--                        'Your SubCategory is safe :)',--}}
{{--                        'error'--}}
{{--                    )--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}
{{--        --}}{{-- Delete Function --}}
{{--        @if (session('delete'))--}}
{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 3000,--}}
{{--                timerProgressBar: true,--}}
{{--                didOpen: (toast) => {--}}
{{--                    toast.addEventListener('mouseenter', Swal.stopTimer)--}}
{{--                    toast.addEventListener('mouseleave', Swal.resumeTimer)--}}
{{--                }--}}
{{--            })--}}

{{--            Toast.fire({--}}
{{--                icon: 'success',--}}
{{--                title: '{{ session('delete') }}'--}}
{{--            })--}}
{{--        @endif--}}
{{--    </script>--}}
{{--@endsection--}}
