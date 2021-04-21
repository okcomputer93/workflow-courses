<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/df1c4e8a69.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Artisans</title>
</head>
<body>
    <nav class="bg-white font-sans">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between px-6">
                <h1 class="flex-1 visible sm:hidden">Me</h1>
                <div class="flex-shrink-0 flex justify-between items-center">
                    <h1 class="pr-2">
                        <a href="{{ url('/') }}">
                            <img class="hidden lg:block h-8 w-auto text-blue-800" src="/images/workflow-logo.svg" alt="Artisans Logo">
                            <img class="block lg:hidden h-8 w-auto text-blue-800" src="/images/workflow-mark.svg" alt="Artisans Logo">
                        </a>
                    </h1>
                    <div class="hidden sm:block sm:ml-6">
                        <ul>
                            <li class="inline-block px-4 py-6 cursor-pointer text-base text-gray-500 font-medium border-b-2 border-transparent hover:text-gray-900 hover:border-blue-400 hover:border-b-4">
                                <a href="#">Home</a>
                            </li>
                            <li class="inline-block px-4 py-6 cursor-pointer text-base text-gray-500 font-medium border-b-2 border-transparent hover:text-gray-900 hover:border-blue-400 hover:border-b-4">
                                <a href="#">Cursos</a>
                            </li>
                            <li class="inline-block px-4 py-6 cursor-pointer text-base text-gray-500 font-medium border-b-2 border-transparent hover:text-gray-900 hover:border-blue-400 hover:border-b-4">
                                <a href="#">Nosotros</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex-1 flex justify-end">
                    <ul>
                        @guest
                            @if (Route::has('login'))
                                <li class="inline-block inline-block px-1 sm:px-4 py-6 cursor-pointer text-xs sm:text-base text-gray-500 font-medium border-b-2 border-transparent hover:text-gray-900 hover:border-blue-400 hover:border-b-4">
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="inline-block inline-block px-1 sm:px-4 py-6 cursor-pointer text-xs sm:text-base text-gray-500 font-medium border-b-2 border-transparent hover:text-gray-900 hover:border-blue-400 hover:border-b-4">
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="inline-block">
                                <a href="#">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="inline-block">
                                <a href="{{ route('logout') }}">{{ __('Logout') }}</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main class="py-8 bg-gray-100 shadow-inner">
        <div class="mx-auto max-w-7xl px-6">
            <h1>This is a body</h1>
            @yield('content')
        </div>
    </main>
    <footer class="bg-white font-sans py-10">
        <div class="flex flex-col justify-center items-center">
            <div class="flex flex-col items-center sm:flex-row my-3 sm:my-6 mt-3 sm:mt-6">
                <a class="px-4 text-gray-400 text-sm sm:text-base py-3 sm:py-0 font-normal hover:text-gray-600" href="#">Nosotros</a>
                <a class="px-4 text-gray-400 text-sm sm:text-base py-3 sm:py-0 font-normal hover:text-gray-600" href="#">Cursos</a>
                <a class="px-4 text-gray-400 text-sm sm:text-base py-3 sm:py-0 font-normal hover:text-gray-600" href="#">Accesibilidad</a>
                <a class="px-4 text-gray-400 text-sm sm:text-base py-3 sm:py-0 font-normal hover:text-gray-600" href="#">Promociones</a>
            </div>
            <div class="flex my-3 sm:my-6">
                <a href="#">
                    <i class="fab fa-facebook fa-lg text-gray-400 px-4 hover:text-blue-400"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram fa-lg text-gray-400 px-4 hover:text-blue-400"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter fa-lg text-gray-400 px-4 hover:text-blue-400"></i>
                </a>
                <a href="#">
                    <i class="fab fa-github-alt fa-lg text-gray-400 px-4 hover:text-blue-400"></i>
                </a>
            </div>
            <div>
                <p class="mt-3 text-sm sm:text-base sm:mt-6 text-gray-400 font-normal">&copy; Workflow, Inc, All rights reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>
