<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/layout-dashboard.css') }}"> -->
    <script src="{{asset('assets/js/jquery.js')}}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div>
            @yield('css-content')
        </div>

        <main class="py-4">
            @yield('content')
        </main>

        <div>
            @yield('js-content')
        </div>
    </div>
</body>
</html>
