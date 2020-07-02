<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="icon" href="{{asset('img/app/icon/Icon_w_50.png')}}">

    <title>MagicList - Public Lists</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('mix/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/Fontawesome5-13-0/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('mix/snotify/css/material.css') }}">

    <script src="{{ asset('js/app_explore.js') }}" defer></script>


    <script data-ad-client="ca-pub-8453462599655086" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158934272-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-158934272-2');
    </script>
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="19bfd6a3-a271-4038-bd50-5cd52c8f01c4" data-blockingmode="auto" type="text/javascript"></script>

</head>

<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">MagicList</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome')}}">Welcome</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="">Explore Lists <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}"><strong>My Lists</strong></a>
                </li>
            </ul>
{{--            <form class="form-inline mt-2 mt-md-0">--}}
{{--                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">--}}
{{--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
{{--            </form>--}}
        </div>
    </nav>
</header>

<main role="main" id="app">

    <explore-lists :lists="{{ json_encode($lists) }}"></explore-lists>

</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>
            <strong>
                Copyright &copy; 2020
                <a href="https://github.com/VictorMaderaA">
                    Víctor René Madera Arenas
                </a>.
            </strong> All rights reserved.
        </p>

        <ul class="nav flex-row ml-md-auto d-none d-md-flex float-right">
            <li class="nav-item" style="padding: 5px">
                <a href="https://www.facebook.com/app.magic.list">
                    <i class="fab fa-facebook-f text-black-50"></i>
                </a>
            </li>
            <li class="nav-item" style="padding: 5px">
                <a href="https://www.instagram.com/magic.list/">
                    <i class="fab fa-instagram text-black-50"></i>
                </a>
            </li>
            <li class="nav-item" style="padding: 5px">
                <a href="https://github.com/VictorMaderaA">
                    <i class="fab fa-github-square text-black-50"></i>
                </a>
            </li>
        </ul>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('mix/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('mix/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('mix/holderjs/holder.min.js') }}"></script>

</body>

<style>
    :root {
        --jumbotron-padding-y: 3rem;
    }

    .jumbotron {
        padding-top: var(--jumbotron-padding-y);
        padding-bottom: var(--jumbotron-padding-y);
        margin-bottom: 0;
        background-color: #fff;
    }

    @media (min-width: 768px) {
        .jumbotron {
            padding-top: calc(var(--jumbotron-padding-y) * 2);
            padding-bottom: calc(var(--jumbotron-padding-y) * 2);
        }
    }

    .jumbotron p:last-child {
        margin-bottom: 0;
    }

    .jumbotron-heading {
        font-weight: 300;
    }

    .jumbotron .container {
        max-width: 40rem;
    }

    html {
        position: relative;
        min-height: 100%;
    }
    body {
        margin-bottom: 60px; /* Margin bottom by footer height */
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Set the fixed height of the footer here */
        line-height: 60px; /* Vertically center the text there */
        background-color: #f5f5f5;
    }

    .box-shadow {
        box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
    }

</style>

</html>
