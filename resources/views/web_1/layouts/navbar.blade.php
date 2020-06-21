<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        @yield('navbar-links')
    </ul>


    @yield('navbar-contents')

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
{{--        @include('web_1.layouts.message-dropdown')--}}
{{--        @include('web_1.layouts.notification-dropdown')--}}

        <li class="nav-item dropdown user user-menu">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>


{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">--}}
{{--                <i class="fas fa-th-large"></i>--}}
{{--            </a>--}}
{{--        </li>--}}

    </ul>

</nav>
<!-- /.navbar -->
