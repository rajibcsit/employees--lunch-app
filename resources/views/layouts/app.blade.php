<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>T-Lunch</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    <div id="app">
        <nav class="bg-white shadow-sm">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <!-- Brand -->
                    <a href="{{ url('/') }}" class="text-2xl font-extrabold text-pink-600">
                        T-Lunch
                    </a>

                    <!-- Hamburger Menu (Mobile) -->
                    <button class="block md:hidden text-gray-600 focus:outline-none" id="navbar-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-6" id="navbar-menu">
                        @guest
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-pink-500 to-pink-700 text-white font-semibold py-2 px-6 rounded shadow hover:from-pink-600 hover:to-pink-800 focus:ring-2 focus:ring-pink-400 focus:outline-none transition duration-300">
                            Login
                        </a>
                        @endif

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-pink-500 to-pink-700 text-white font-semibold py-2 px-6 rounded shadow hover:from-pink-600 hover:to-pink-800 focus:ring-2 focus:ring-pink-400 focus:outline-none transition duration-300">
                            Register
                        </a>
                        @endif
                        @else
                        @if (auth()->user()->role === 'admin' && Route::currentRouteName() !== 'admin.lunch.index')
                        <a href="{{ route('admin.lunch.index') }}" class="text-gray-700 hover:text-pink-600 transition duration-300">
                            Dashboard
                        </a>
                        @elseif (auth()->user()->role === 'employee' && Route::currentRouteName() !== 'lunch.index')
                        <a href="{{ route('lunch.index') }}" class="text-gray-700 hover:text-pink-600 transition duration-300">
                            Dashboard
                        </a>
                        @endif

                        <!-- Authenticated Dropdown -->
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-pink-600 focus:outline-none transition duration-300" id="dropdown-toggle">
                                <span>{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden" id="dropdown-menu">
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div class="md:hidden hidden" id="mobile-menu">
                    <ul class="space-y-4">
                        @guest
                        @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-pink-600 transition duration-300">
                                Login
                            </a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}" class="block text-gray-700 hover:text-pink-600 transition duration-300">
                                Register
                            </a>
                        </li>
                        @endif
                        @else
                        @if (auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.lunch.index') }}" class="block text-gray-700 hover:text-pink-600 transition duration-300">
                                Dashboard
                            </a>
                        </li>
                        @elseif (auth()->user()->role === 'employee')
                        <li>
                            <a href="{{ route('lunch.index') }}" class="block text-gray-700 hover:text-pink-600 transition duration-300">
                                Dashboard
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}" class="block text-gray-700 hover:text-pink-600 transition duration-300"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        // Mobile Menu Toggle
        const navbarToggle = document.getElementById('navbar-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        navbarToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Dropdown Toggle
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');
        dropdownToggle?.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>