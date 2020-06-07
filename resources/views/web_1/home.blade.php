@extends('web_1.layouts.app')

@section('sidebar-menu')
    <sidebar-ul :lists="{{json_encode(auth()->user()->lists()->get()->toArray())}}"
                @create-list="onShowCreateNewList"
                @list-selected="onListSelected">
    </sidebar-ul>
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

    <main-component ref="mainComponent"></main-component>


    <section class="content">


        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title align-middle">
                                Item Name like Order Pizza for 10 people
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

                        <div class="card-body">
                            <h3>
                                Contents:
                            </h3>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <dl>
                                        <dt>Definition list</dt>
                                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.</dd>
                                        <dt>Lorem ipsum dolor sit amet</dt>
                                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.</dd>
                                    </dl>

                                    <ol>
                                        <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                                        <li>Aliquam tincidunt mauris eu risus.</li>
                                        <li>Vestibulum auctor dapibus neque.</li>
                                    </ol>

                                    <table>
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <div class="col-11">
                                <hr>
                            </div>
                        </div>

                        <div class="card-body">
                            <h3>
                                Gallery:
                            </h3>
                            <div class="row justify-content-center">
                                <br>
                                <div class="col-10">
                                    Show Here The Gallery
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->





        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title align-middle">
                            Create New Item
                        </h3>

                        <div class="card-tools">
                            <a class="btn btn-sm">
                                <i class="fas fa-times text-red"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form">
                            <div class="row justify-content-center">
                                <div class="col-sm-8">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="name">Item Name</label>
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Date with Maruchan...">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" class="btn btn-primary">Save & Create Other</button>
                        <button type="submit" class="btn btn-primary">Save & Edit</button>
                        <button type="submit" class="btn btn-default float-right">Cancel</button>
                    </div>

                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->





        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title align-middle">
                            Edit Item
                        </h3>

                        <div class="card-tools">
                            <a class="btn btn-sm">
                                <i class="fas fa-times text-red"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form">
                            <div class="row justify-content-center">
                                <div class="col-sm-8">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="name">List Name</label>
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Cooking List...">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-10">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" rows="3" id="description"
                                                  placeholder="Enter description..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group row justify-content-center">
                                <div class="col-5">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                               accept="image/*|.mp4">
                                        <label class="custom-file-label" for="inputGroupFile01">Upload Images</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                Show interactable gallery
                            </div>

                        </form>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" class="btn btn-default float-right">Cancel</button>
                    </div>

                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->

    </section>
@endsection
