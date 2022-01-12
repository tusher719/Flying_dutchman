<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('uploads/brand/'.$brand[0]->brand_img)}}" alt=""
             class="brand-image img-rounded elevation-3">
        <span class="brand-text font-weight-light">{{ $brand[0]->brand_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="height: 34px; width: 34px; object-fit: cover;" src="{{ asset('uploads/users') }}/{{ Auth::user()->user_photo }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('/home')}}" class="nav-link @yield('home')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link @yield('gallery')">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/user')}}" class="nav-link @yield('user')">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('coupon') }}" class="nav-link @yield('coupon')">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Coupon</p>
                    </a>
                </li>


                <li class="nav-item @yield('tree_menu')">
                    <a href="#" class="nav-link  @yield('category') @yield('subcategory')">
                        <i class="fas fa-folder nav-icon"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/category')}}" class="nav-link @yield('category')">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>
                                    Main Category
                                    {{-- <span class="badge badge-info right">{{ $total_category }}</span>--}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/subcategory')}}" class="nav-link @yield('subcategory')">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>
                                    Sub-Category
{{--                                    <span class="badge badge-danger right">{{ $total_subcategory }}</span>--}}
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @yield('inventory_tree_menu')">
                    <a href="#" class="nav-link  @yield('color') @yield('size')">
                        <i class="fas fa-folder nav-icon"></i>
                        <p>Inventory
                            <i class="fas fa-angle-left right"></i> <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/add/color')}}" class="nav-link @yield('color')">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p> Add Color </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/add/size')}}" class="nav-link @yield('size')">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p> Add Size</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @yield('tree_product_menu')">
                    <a href="#" class="nav-link  @yield('productAdd') @yield('productManage') @yield('inventory')">
                        <i class="fas fa-folder nav-icon"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">3</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/product/add')}}" class="nav-link @yield('productAdd')">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/product/all')}}" class="nav-link @yield('productManage')">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link @yield('inventory')">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Inventory</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
