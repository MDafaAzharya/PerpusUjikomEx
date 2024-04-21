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
    <link rel="stylesheet" href="{{ asset('assets/css/user/layout-user.css') }}">
    <script src="{{asset('assets/js/jquery.js')}}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm px-5">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="{{asset('assets/img/logo-book.png')}}" alt="" srcset="" width="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <a href="{{route('home')}}" class="nav-link">
                            <p class="text-white fw-medium fs-5 my-auto">Home</p>
                        </a>
                        <a href="{{route('bookmark')}}" class="nav-link">
                            <p class="text-white fw-medium fs-5 ms-md-2 my-auto">Bookmark</p>
                        </a>
                        <a href="{{route('member')}}" class="nav-link">
                            <p class="text-white fw-medium fs-5 ms-md-2 my-auto">Member</p>
                        </a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                         <!-- Authentication Links -->
                        
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div>
                                <a class="btn btn-logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </ul> 
                </div>
        </nav>
       

        <div>
            @yield('css-content')
        </div>

        <main class="py-4">
            @yield('content')
        </main>

        <div>
            @yield('js-content')
        </div>

        <footer class="text-center text-lg-start">
            <!-- Copyright -->
            <div class="px-5 pt-3">
                <hr class="line-footer border border-2 opacity-100">
            </div>
            <div class="px-5 pb-3 text-md-start text-center">
                <img src="{{ asset('assets/img/logo-book.png') }}" alt="" srcset="" width="40">
                <a class=" text-footer" href="https://mdbootstrap.com/">Reading a book</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>
</body>
</html>
