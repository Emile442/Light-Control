<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title') | {{ env("APP_NAME") }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body class="guest__body">
<div class="wrapper" id="app">
    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
</body>

</html>
