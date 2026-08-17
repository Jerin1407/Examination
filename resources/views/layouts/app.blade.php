<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- custom css -->
    <link href="{{ asset('css/style.css?q=' . time()) }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        p,
        div,
        span,
        ul,
        li,
        a {
            direction: {{ config('app.direction', 'ltr') }};
        }

        .btn-default {
            border: 1px solid #c8c4c4;
        }

        form {
            width: 100%;
        }

        .logo {
            font-size: 20px;
            line-height: 50px;
            text-align: center;
            margin-top: 10px;
            padding: 0 10px;
            width: 100%;
            font-family: 'Kaushan Script', cursive;
            font-weight: 400;
            height: 48px;
            display: block;
            background-color: #367fa9;
            color: #f9f9f9;
            box-sizing: border-box;
        }

        .sidebar {
            width: 16rem !important;
        }

        .logo-style {
            width: 173px;
            float: left;
            margin: 10px 2px 0;
        }
    </style>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        var base_url = "{{ url('/') }}";
    </script>

    @if (request()->segment(1) . '/' . request()->segment(2) != 'quiz/attempt')
        <!-- custom javascript -->
        <script src="{{ asset('js/basic.js?q=' . time()) }}"></script>
    @endif

    <!-- firebase messaging manifest.json -->
    <link rel="manifest" href="{{ asset('js/manifest.json') }}">
</head>

<body>

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <! -- Index -->
        @yield('content')

</body>

</html>
