<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Blog')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-4">
        @include('partials.alerts')
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
