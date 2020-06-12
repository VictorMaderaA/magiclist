<li class="nav-item dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="color: black">
{{--        <img src="{{asset('img/boxed-bg.jpg')}}" class="user-image" alt="User Image">--}}
        <span class="hidden-xs">{{auth()->user()->name}}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header" style="height: 100px;">
{{--            <img src="{{asset('img/boxed-bg.jpg')}}" class="img-circle" alt="User Image">--}}
            <p>
                {{auth()->user()->name}}
                <small>Member since {{auth()->user()->created_at}}</small>
            </p>
        </li>


        <!-- Menu Body -->
{{--        <li class="user-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xs-4 text-center">--}}
{{--                    <a href="#">Followers</a>--}}
{{--                </div>--}}
{{--                <div class="col-xs-4 text-center">--}}
{{--                    <a href="#">Sales</a>--}}
{{--                </div>--}}
{{--                <div class="col-xs-4 text-center">--}}
{{--                    <a href="#">Friends</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /.row -->--}}
{{--        </li>--}}



        <!-- Menu Footer-->
        <li class="user-footer">
{{--            <div class="pull-left">--}}
{{--                <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
{{--            </div>--}}
            <div class="pull-right">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"
                   class="btn btn-default btn-flat">{{ __('Logout') }}</a>
            </div>
        </li>
{{--    </ul>--}}
</li>
