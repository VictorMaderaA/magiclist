@extends('web_1.layouts.app')

@section('sidebar-menu')
   @include('web_1.app.sidebar')
@endsection

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title align-middle">
                            Nombre de la Lista 1
                        </h3>

                        <div class="card-tools">
                            <a class="btn btn-sm">
                                <i class="fas fa-edit text-blue"></i>
                            </a>

                            <a class="btn btn-sm">
                                <i class="fas fa-trash text-red"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="row" style="margin: 10px;">
                        <div class="col-6">
                            ESto es la columna no se que mierda quieres que diga por aqui
                        </div>
                        <div class="col-6">

                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">


                            <li class="">
                                <!-- drag handle -->
                                <span class="handle ui-sortable-handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <!-- todo text -->
                                <span class="text">Design a nice theme</span>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-trash"></i>
                                </div>
                            </li>

                            <li class="done">
                                <!-- drag handle -->
                                <span class="handle ui-sortable-handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <!-- todo text -->
                                <span class="text">Design a nice theme</span>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-trash"></i>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
@endsection
