<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', 'MagicList') }}</title>
    <link rel="icon" href="{{asset('img/app/icon/Icon_w_50.png')}}">

    <script src="{{ asset('js/app_1.js') }}" defer></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('vendor/Fontawesome5-13-0/css/all.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('mix/adminlte/css/alt/adminlte.core.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mix/adminlte/css/alt/adminlte.components.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mix/snotify/css/material.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @include('layouts.headerSnippets')

</head>


<body class="hold-transition sidebar-mini skin-black" id="sidebar">

    <div class="wrapper">
        <div id="app">
            <app-master inline-template>
                <div>
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

            </app-master>
        </div>

    </div>
    <!-- ./wrapper -->




    <!-- REQUIRED SCRIPTS -->
    <script src="{{asset('mix/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('mix/adminlte/js/adminlte.min.js')}}"></script>



</body>

</html>
