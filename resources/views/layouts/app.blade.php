<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
     <meta name="api-token" content="{{ \Auth::user()->api_token }}">
    @endauth
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title') | {{ env("APP_NAME") }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body class="">
<div class="wrapper" id="app">
    @include('layouts._sidebar')

    <div class="main-panel" id="main-panel">
        @include('layouts._navbar')
        @yield('content')
        <footer class="footer">
            <div class=" container-fluid ">
                <nav>
                    <ul>
                        <li>
                            <a href="{{ route('root') }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('network.index') }}">
                                Network
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright" id="copyright">
                    <i class="fas fa-code"></i> by <a href="mailto:emile.lepetit@epitech.eu" target="_blank">Emile LEPETIT</a> & <a href="mailto:paul.bugeon@epitech.eu" target="_blank">Paul BUGEON</a> with <i class="fas fa-heart"></i>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>

@yield('js')

<script>
    $(document).ready(function() {
        demo.initDashboardPageCharts();
    });
</script>
</body>

</html>
