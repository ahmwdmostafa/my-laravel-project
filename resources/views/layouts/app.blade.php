<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="https://cdn.tailwindcss.com"></script>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <!-- اسم الموقع -->
                    <a class="text-xl font-bold text-gray-800" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <!-- القائمة -->
                    <div>
                        <ul class="flex space-x-4">
                            @guest
                                @if (Route::has('login'))
                                    <li>
                                        <a class="text-gray-700 hover:text-blue-500" href="{{ route('login') }}">تسجيل الدخول</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li>
                                        <a class="text-gray-700 hover:text-blue-500" href="{{ route('register') }}">التسجيل</a>
                                    </li>
                                @endif
                            @else
                                <li class="relative group">
                                    <button class="text-gray-700 hover:text-blue-500 focus:outline-none">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div class="absolute right-0 hidden bg-white shadow-md group-hover:block">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 w-full text-left">
                                                تسجيل الخروج
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
