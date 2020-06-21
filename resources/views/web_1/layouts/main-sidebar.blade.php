<aside class="main-sidebar elevation-4 sidebar-dark-lightblue">
    <!-- Brand Logo -->
    <a href="" class="brand-link navbar-light">

        <picture>
            <img alt="MagicList Logo" class="brand-image"
                 sizes="(max-width: 1024px) 100vw, 1024px"
                 srcset="{{asset('img/app/icon/Icon_w_50.png')}} 50w,
                    {{asset('img/app/icon/Icon_w_522.png')}} 522w,
                    {{asset('img/app/icon/Icon_w_1024.png')}} 1024w"
                 src="{{asset('img/app/icon/Icon_w_50.png')}}">
        </picture>

        <span class="brand-text font-weight-normal" style="color: black;">
                {{ config('app.name', 'MagicList') }}
        </span>
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
            @yield('sidebar-menu')
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
