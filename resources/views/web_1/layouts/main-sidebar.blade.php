<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
{{--        <img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
{{--             style="opacity: .8">--}}
        <img alt="MagicList Logo" class="brand-image"
            sizes="(max-width: 1024px) 100vw, 1024px"
            srcset="{{asset('img/app/icon/Icon_w_50.png')}} 50w,
                    {{asset('img/app/icon/Icon_w_522.png')}} 522w,
                    {{asset('img/app/icon/Icon_w_1024.png')}} 1024w"
            src="{{asset('img/app/icon/Icon_w_1024.png')}}">
        <span class="brand-text font-weight-light">{{ config('app.name', 'MagicList') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

{{--            <div class="image">--}}
{{--                <img src="{{asset('img/boxed-bg.jpg')}}" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}

            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Active Page</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
