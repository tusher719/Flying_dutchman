@extends('layouts.master')

@section('title')
    Category
@endsection

@section('category')
    active
@endsection
@section('tree_menu')
    menu-open
@endsection

{{--Page Title--}}
@section('pageTitle')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="m-0">Category</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

{{--Main Content--}}
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-10 m-auto connectedSortable">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-layer-group"></i>
                            Category List
                            <span class="badge bg-success">{{ $total_category }}</span>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ url('/mark/delete') }}" method="post">
                            @csrf
                            <div class="d-flex justify-content-between mb-1">
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
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Category Image</th>
                                        <th>Added By</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $index=> $category)
                                        <tr>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" name="mark[]" value="{{ $category->id }}" id="check{{ $category->id }}">
                                                    <label for="check{{ $category->id }}"></label>
                                                </div>
                                            </td>
                                            {{--                                        <td>{{ $categories->firstItem() + $index }}</td>--}}
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>
                                                @if($category->category_image)
                                                    <img style="width: 120px;" src="{{ asset('uploads/category')}}/{{ $category->category_image }}" alt="">
                                                @else()
                                                    <span class="text-danger">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ App\Models\User::find($category->added_by)->name }}</td>
                                            <td>
                                                <a href="{{ url('/category/status') }}/{{ $category->id }}"
                                                   class="btn btn-outline-{{ ($category->status==0)?'secondary':'success' }} btn-sm">
                                                    {{ ($category->status==0)?'Deactive':'Active' }}
                                                </a>
                                            </td>
                                            <td>{{ $category->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ url('/category/edit') }}/{{ $category->id }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a href="#" onclick="deleteTrash({{ $category->id }});"
                                                   class="btn btn-outline-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                                <form id="delete-data-{{ $category->id }}"
                                                      action="{{ url('/category/delete') }}/{{ $category->id }}" method="POST"
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
                    <!-- /.card-body -->
                </div>
            </div>


            {{-- Trash Category --}}
            <div class="col-md-10 m-auto connectedSortable">
                <div class="card card-danger mt-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-trash-alt"></i>
                            Trash List
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
                                <button type="button" class="btn btn-outline-primary btn-sm trashbox-toggle">
                                    <i class="far fa-square"></i>
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
                            <table id="example2" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Category Image</th>
                                    <th>Added By</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($trash_categories as $index=> $trash_category)
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkboxs"  id="check">
                                                <label for="check"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $trash_category->category_name }}</td>
                                        <td>
                                            <img style="width: 120px;" src="{{ asset('uploads/category')}}/{{ $trash_category->category_image }}" alt="">
                                        </td>
                                        <td>{{ App\Models\User::find($trash_category->added_by)->name }}</td>
                                        <td>{{ $trash_category->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url('/category/restore') }}/{{ $trash_category->id }}"
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-reply"></i>
                                            </a>

                                            <a href="#" onclick="deleteCategory({{ $trash_category->id }});"
                                               class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash-restore"></i>
                                            </a>
                                            <form id="delete-data-{{ $trash_category->id }}"
                                                  action="{{ url('/category/permanent/delete') }}/{{ $trash_category->id }}" method="POST"
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

            <div class="modal fade " id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/category/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-div mt-2">
                                    <div class="div">
                                        {{-- <label>Category Name</label>--}}
                                        <h5>Category Name</h5>
                                        <input type="text" name="category_name" class="input">
                                        @error('category_name')
                                        <small class="btn text-danger text-sm mt-5">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Category Image</label>
                                    <input type="file" name="category_image" class="form-control">
                                    @error('category_image')
                                    <small class="btn text-danger text-sm mt-5">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="mt-3 text-center">
                                    <button type="submit" class="btn btn-outline-info">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>








        </div>
    </div>

@endsection


@section('footer_script')
    <script>
        function deleteTrash(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This data moved to trash!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your data has been Trashed.',
                        'success'
                    )
                    event.preventDefault();
                    document.getElementById('delete-data-' + id).submit();
                }
            })
        }

        //Trash Alart
        @if (session('trash'))
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
            title: '{{ session('trash') }}'
        })
        @endif

         // Permanently Delete Function
        function deleteCategory(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "This data Delete Permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Category Deleted Successfully',
                        'success'
                    )
                    event.preventDefault();
                    document.getElementById('delete-data-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your Data is safe :)',
                        'error'
                    )
                }
            })
        }

        // Permanently Delete Alert
        @if (session('perdelete'))
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
                title: '{{ session('perdelete') }}'
            })
        @endif


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


        @if (session('update'))
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
                title: '{{ session('update') }}'
            })
        @endif

        @if (session('restore'))
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
                title: '{{ session('restore') }}'
            })
        @endif

        @if (session('mark_delete'))
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
                title: '{{ session('mark_delete') }}'
            })
        @endif


    </script>
@endsection
