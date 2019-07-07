<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- bootstrap & fontawesome -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/font-awesome/4.5.0/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- text fonts -->
    <link href="{{ asset('/css/fonts.googleapis.com.css') }}" rel="stylesheet">

    <!-- ace styles -->
    <link href="{{ asset('/css/ace.min.css') }}" rel="stylesheet">

    <!--[if lte IE 9]>
        <link href="{{ asset('/css/ace-part2.min.css') }}" rel="stylesheet">
    <![endif]-->
    <link href="{{ asset('/css/ace-skins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/ace-rtl.min.css') }}" rel="stylesheet">

    <!--[if lte IE 9]>
      <link href="{{ asset('/css/ace-ie.min.css') }}" rel="stylesheet">
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{ asset('/js/ace-extra.min.js') }}"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="{{ asset('/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('/js/respond.min.js') }}"></script>
    <![endif]-->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="login-layout">
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
