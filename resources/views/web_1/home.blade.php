@extends('web_1.layouts.app')

@section('sidebar-menu')
    <sidebar-ul ref="sidebarUl"
                @create-list="onShowCreateNewList"
                @list-selected="onListSelected">
    </sidebar-ul>
@endsection

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i></a>
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
                    @list-created="onListCreated"
    ></main-component>

    <section class="content">













    </section>
@endsection
