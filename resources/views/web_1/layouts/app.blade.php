<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', 'MagicList') }}</title>
    <link rel="icon" href="{{asset('img/app/icon/Icon_w_50.png')}}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('vendor/Fontawesome5-13-0/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>


<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <!-- Navbar -->
        @include('web_1.layouts.navbar')

        <!-- Main Sidebar Container -->
        @include('web_1.layouts.main-sidebar')

        <!-- Content Wrapper. Contains page content -->
        @include('web_1.layouts.content-wrapper')

        <!-- Control Sidebar -->
        @include('web_1.layouts.control-sidebar')

        <!-- Main Footer -->
        @include('web_1.layouts.main-footer')
    </div>
    <!-- ./wrapper -->




    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('vendor/Bootrstrap4-5-0/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.js')}}"></script>



</body>

</html>
