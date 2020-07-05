{{--https://cruip.com/demos/switch/--}}
{{----}}
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Magic List</title>
    <link rel="icon" href="{{asset('img/app/icon/Icon_w_50.png')}}">

    <link href="https://fonts.googleapis.com/css?family=Heebo:400,700|IBM+Plex+Sans:600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/switch/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/Fontawesome5-13-0/css/all.min.css')}}">
    <script src="https://unpkg.com/scrollreveal"></script>

    @include('layouts.headerSnippets')

</head>
<body class="is-boxed has-animations">
<div class="body-wrap boxed-container">
    <header class="site-header">
        <div class="container">
            <div class="site-header-inner">
                <div class="brand header-brand">
                    <h1 class="m-0">
                        <a href="#">
                            <img class="header-logo-image asset-light" src="{{asset('img/app/icon/Icon.svg')}}" alt="Logo"
                                 style="height: 32px">
                            <img class="header-logo-image asset-dark" src="{{asset('img/app/icon/Icon.svg')}}" alt="Logo"
                                 style="height: 32px">
                        </a>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-inner">
                    <div class="hero-copy">
                        <h1 class="hero-title mt-0">Organiza todo con MagicList</h1>
                        <p class="hero-paragraph">
                            Almacena y accede a todas tus listas desde la web. Indicado para guardar tus Recetas, Peliculas, Pendientes y mas.
                        </p>
                        <div class="hero-cta">
                            <a class="button button-primary" href="{{route('register')}}">
                                Regístrate Gratis
                            </a>
                            <a class="button button-primary" href="{{route('login')}}">
                                Ingresar
                            </a>
{{--                            <div class="lights-toggle">--}}
{{--                                <input id="lights-toggle" type="checkbox" name="lights-toggle" class="switch" checked="checked">--}}
{{--                                <label for="lights-toggle" class="text-xs"><span>Turn me <span class="label-text">dark</span></span></label>--}}
{{--                            </div>--}}
                        </div>
                        <br>
                            <a class="button button-primary" href="{{route('explore')}}">
                                Explora Listas
                            </a>
                    </div>
                    <div class="hero-media">
                        <div class="header-illustration">
                            <img class="header-illustration-image asset-light" src="{{asset('vendor/switch/images/header-illustration-light.svg')}}" alt="Header illustration">
                            <img class="header-illustration-image asset-dark" src="{{asset('vendor/switch/images/header-illustration-dark.svg')}}" alt="Header illustration">
                        </div>
                        <div class="hero-media-illustration">
                            <img class="hero-media-illustration-image asset-light" src="{{asset('vendor/switch/images/hero-media-illustration-light.svg')}}" alt="Hero media illustration">
                            <img class="hero-media-illustration-image asset-dark" src="{{asset('vendor/switch/images/hero-media-illustration-dark.svg')}}" alt="Hero media illustration">
                        </div>
                        <div class="hero-media-container">
                            <img class="hero-media-image asset-light" src="{{asset('img/app/welcome/es/demo-app-list-es.jpg')}}"
                                 alt="Hero media" style="width:538px; height:380px">
{{--                            <img class="hero-media-image asset-light" src="{{asset('vendor/switch/images/hero-media-light.svg')}}" alt="Hero media">--}}
                            <img class="hero-media-image asset-dark" src="{{asset('vendor/switch/images/hero-media-dark.svg')}}" alt="Hero media">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features section">
            <div class="container">
                <div class="features-inner section-inner has-bottom-divider">
                    <div class="features-header text-center">
                        <div class="container-sm">
                            <h2 class="section-title mt-0">Caracteristicas</h2>
                            <p class="section-paragraph">
                                Almacena todas tus listas, visualiza contenidos personalizables, y si no puedes decidir que hacer, deja que nosotros seleccionemos por ti.
                            </p>
                            <div class="features-image">
                                <img class="features-illustration asset-dark" src="{{asset('vendor/switch/images/features-illustration-dark.svg')}}" alt="Feature illustration">
                                <img class="features-box asset-dark" src="{{asset('vendor/switch/images/features-box-dark.svg')}}" alt="Feature box">
                                <img class="features-illustration asset-dark" src="{{asset('vendor/switch/images/features-illustration-top-dark.svg')}}" alt="Feature illustration top">
                                <img class="features-illustration asset-light" src="{{asset('vendor/switch/images/features-illustration-light.svg')}}" alt="Feature illustration">
                                <img class="features-box asset-light" src="{{asset('img/app/welcome/es/demo-app-item-es.jpg')}}"
                                     alt="Feature box" style="width: 540px; height: 370px;">
{{--                                <img class="features-box asset-light" src="{{asset('vendor/switch/images/features-box-light.svg')}}" alt="Feature box">--}}
                                <img class="features-illustration asset-light" src="{{asset('vendor/switch/images/features-illustration-top-light.svg')}}" alt="Feature illustration top">
                            </div>
                        </div>
                    </div>
                    <div class="features-wrap">
                        <div class="feature is-revealing">
                            <div class="feature-inner">
                                <div class="feature-icon">
                                    <img class="asset-light" src="{{asset('vendor/switch/images/feature-01-light.svg')}}" alt="Feature 01">
                                    <img class="asset-dark" src="{{asset('vendor/switch/images/feature-01-dark.svg')}}" alt="Feature 01">
                                </div>
                                <div class="feature-content">
                                    <h3 class="feature-title mt-0">
                                        Organizate
                                    </h3>
                                    <p class="text-sm mb-0">
                                        Crea distintas listas y manten organizado todas tus tareas, actividades hechas y por hacer de manera sencilla.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="feature is-revealing">
                            <div class="feature-inner">
                                <div class="feature-icon">
                                    <img class="asset-light" src="{{asset('vendor/switch/images/feature-02-light.svg')}}" alt="Feature 02">
                                    <img class="asset-dark" src="{{asset('vendor/switch/images/feature-02-dark.svg')}}" alt="Feature 02">
                                </div>
                                <div class="feature-content">
                                    <h3 class="feature-title mt-0">
                                        Personalizable
                                    </h3>
                                    <p class="text-sm mb-0">
                                        Visualiza los datos de tu lista y agrega imagenes. Las actividades de tus listas personalizable con html.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="feature is-revealing">
                            <div class="feature-inner">
                                <div class="feature-icon">
                                    <img class="asset-light" src="{{asset('vendor/switch/images/feature-03-light.svg')}}" alt="Feature 03">
                                    <img class="asset-dark" src="{{asset('vendor/switch/images/feature-03-dark.svg')}}" alt="Feature 03">
                                </div>
                                <div class="feature-content">
                                    <h3 class="feature-title mt-0">
                                        Evolucionando
                                    </h3>
                                    <p class="text-sm mb-0">
                                        Comparte con nosotros recomendaciones o sugerencias. Poco a poco si introduciran estas a la aplicacion para que saques el mejor provecho de MagicList.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta section">
            <div class="container-sm">
                <div class="cta-inner section-inner">
                    <div class="cta-header text-center">
                        <h2 class="section-title mt-0">Empieza a utilizarlo ahora gratis</h2>
                        <p class="section-paragraph">Accede a tus listas desde cualquier dispositivo</p>
                        <div class="cta-cta">
                            <a class="button button-primary" href="{{route('register')}}">
                                Registrate Ahora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer has-top-divider">
        <div class="container">
            <div class="site-footer-inner">
                <div class="brand footer-brand">
                    <a href="#">
                        <img class="asset-light" src="{{asset('img/app/icon/Icon.svg')}}" alt="Logo"
                             style="height: 32px">
{{--                        <img class="asset-light" src="{{asset('vendor/switch/images/logo-light.svg')}}" alt="Logo">--}}
                        <img class="asset-dark" src="{{asset('vendor/switch/images/logo-dark.svg')}}" alt="Logo"
                             style="height: 32px">
                    </a>
                </div>
                <ul class="footer-links list-reset">
{{--                    <li>--}}
{{--                        <a href="#">Contact</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">About us</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">FAQ's</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">Support</a>--}}
{{--                    </li>--}}
                </ul>
                <ul class="footer-social-links list-reset">
                    <li>
                        <a href="https://www.facebook.com/app.magic.list">
                            <span class="screen-reader-text">Facebook</span>
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/magic.list/">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/VictorMaderaA">
                            <span class="screen-reader-text">Github</span>
                            <i class="fab fa-github-square"></i>
                        </a>
                    </li>
                </ul>
                <div class="footer-copyright">
                    <strong>
                        Copyright &copy; 2020
                        <a href="https://github.com/VictorMaderaA">
                            Víctor René Madera Arenas
                        </a>.
                    </strong> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{asset('vendor/switch/js/main.min.js')}}"></script>
</body>
</html>
