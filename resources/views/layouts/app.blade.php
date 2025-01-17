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
                        @foreach (['login' => 'Login', 'register' => 'Register'] as $route => $label)
                        @if (Route::has($route))
                        <a href="{{ route($route) }}" class="bg-gradient-to-r from-pink-500 to-pink-700 text-white font-semibold py-2 px-6 rounded shadow hover:from-pink-600 hover:to-pink-800 focus:ring-2 focus:ring-pink-400 focus:outline-none transition duration-300">
                            {{ $label }}
                        </a>
                        @endif
                        @endforeach
                        @else
                        @php
                        $dashboardRoute = auth()->user()->role === 'admin' ? 'admin.lunch.index' : 'lunch.index';
                        $currentRoute = Route::currentRouteName();
                        @endphp

                        @if ($currentRoute !== $dashboardRoute)
                        <a href="{{ route($dashboardRoute) }}" class="text-gray-700 hover:text-pink-600 transition duration-300">
                            Dashboard
                        </a>
                        @endif

                        <!-- Authenticated Dropdown -->
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-pink-600 focus:outline-none transition duration-300" id="dropdown-toggle">
                                <span>{{ auth()->user()->name }}</span>
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

                    <!-- Mobile Menu -->
                    <div class="absolute top-16 left-0 w-full bg-white/90 border border-gray-200 shadow-lg p-4 rounded-md z-50 md:hidden hidden" id="mobile-menu">
                        <ul class="space-y-4">
                            @guest
                            @foreach (['login' => 'Login', 'register' => 'Register'] as $route => $label)
                            @if (Route::has($route))
                            <li>
                                <a href="{{ route($route) }}" class="bg-gradient-to-r from-pink-500 to-pink-700 text-white font-medium py-1 px-4 rounded-md shadow-md text-sm hover:from-pink-600 hover:to-pink-800 focus:ring-2 focus:ring-offset-1 focus:ring-pink-400 focus:outline-none transition duration-300 text-center">
                                    {{ $label }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                            @else
                            <li>
                                <a href="{{ route($dashboardRoute) }}" class="block text-gray-700 hover:text-pink-600 transition duration-300">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="block text-gray-700 hover:text-pink-600 transition duration-300"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                                    Logout
                                </a>
                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
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
        <!-- Footer Section -->
        <footer class="bg-gray-800 text-white mt-16">
            <div class="container mx-auto px-4 py-12 flex flex-col md:flex-row justify-between">
                <div class="mb-8 md:mb-0">
                    <h3 class="text-2xl font-bold">T-Lunch</h3>
                    <p class="text-gray-400 mt-2">Simplifying employee lunch management with ease and efficiency.</p>
                </div>
                <div class="flex space-x-12">
                    <div>
                        <h4 class="text-lg font-semibold">Company</h4>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-pink-400">About Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-pink-400">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold">Support</h4>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-pink-400">Help Center</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-pink-400">FAQs</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-pink-400">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center py-4 border-t border-gray-700 px-4">
                <p class="text-gray-500">&copy; 2025 T-Lunch. All Rights Reserved.</p>
                <p class="text-gray-500">Developed by TwiteSoft</p>
            </div>
        </footer>
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