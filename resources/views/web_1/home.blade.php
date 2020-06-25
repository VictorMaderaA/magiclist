@extends('web_1.layouts.app')

@section('sidebar-menu')
    <sidebar-ul ref="sidebarUl"
                @create-list="onShowCreateNewList"
                @list-selected="onListSelected">
    </sidebar-ul>

{{--    <div style="max-width: 225px; max-height: 225px; background: rgba(1,1,1,0.1);">--}}
{{--        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
{{--        <!-- app/sidebar-footer -->--}}
{{--        <ins class="adsbygoogle"--}}
{{--            style="display:inline-block;width:225px;height:225px"--}}
{{--            data-ad-client="ca-pub-8453462599655086"--}}
{{--            data-ad-slot="7316267219"></ins>--}}
{{--        <script>--}}
{{--            (adsbygoogle = window.adsbygoogle || []).push({});--}}
{{--        </script>--}}
{{--    </div>--}}
@endsection

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i></a>
    </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('contact')}}" class="nav-link">Reportar Error/Sugerencia</a>
        </li>

{{--    <li class="nav-item d-none d-sm-inline-block">--}}
{{--        <a href="" class="nav-link">Home</a>--}}
{{--    </li>--}}

{{--    <li class="nav-item d-none d-sm-inline-block">--}}
{{--        <a href="#" class="nav-link">Recommend Us</a>--}}
{{--    </li>--}}
@endsection

@section('navbar-contents')
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
@endsection

@section('content')

    <main-component ref="mainComponent"
    ></main-component>

    <section class="content">













    </section>
@endsection
