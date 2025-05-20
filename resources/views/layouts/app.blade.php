<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Quran Revision Partner') }}</title>
  
  <!-- external js-->

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

   <!-- internal css-->
  <link rel="stylesheet" href="https://8000-adeluxs-quranrevisionap-c55s05x1yza.ws-eu118.gitpod.io/css/style.css">

  <!-- external css-->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


</head>

<body class="bg-gray-100 text-gray-800 font-sans">

<!-- Navigation -->
<nav class="bg-white shadow-md py-4 px-6 md:px-12 flex justify-between items-center font-[Cairo]" x-data="{ menuOpen: false, notificationOpen: false }">
    <!-- Logo -->
    <a href="/" class="flex items-center space-x-2 text-green-700 hover:text-green-800 transition">
        <img src="https://cdn-icons-png.flaticon.com/512/811/811476.png" alt="Quran Icon" class="w-8 h-8">
        <span class="text-2xl font-extrabold tracking-tight">Quran<span class="text-green-500">Partner</span></span>
    </a>

    <!-- Menu (Desktop) -->
    <div class="hidden md:flex items-center space-x-6 text-sm">
        <a href="/" class="text-gray-700 hover:text-green-700 transition">Home</a>
        <a href="#about" class="text-gray-700 hover:text-green-700 transition">About</a>
        <a href="#contact" class="text-gray-700 hover:text-green-700 transition">Contact</a>

        @auth
            <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-green-700 transition">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-red-600 hover:underline ml-2">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-700 transition">Login</a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-full shadow hover:bg-green-700 transition">Register</a>
        @endauth
    </div>

    <!-- Notifications -->
    @auth
    <div class="relative inline-block">
        <button @click="notificationOpen = !notificationOpen" class="relative text-gray-700 hover:text-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if (auth()->user()->unreadNotifications->count() > 0)
                <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
            @endif
        </button>

        <div x-show="notificationOpen" @click.away="notificationOpen = false" class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg">
            <div class="p-4">
                <h3 class="text-sm font-semibold text-gray-700">Notifications</h3>
                <ul class="mt-2 space-y-2">
                    @forelse (auth()->user()->unreadNotifications as $notification)
                        <li class="text-sm text-gray-600">
                            {{ $notification->data['message'] ?? 'No message available.' }}
                            <a href="{{ $notification->data['url'] ?? '#' }}" class="text-green-600 hover:underline">View</a>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500">No new notifications.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    @endauth

    <!-- Mobile Menu Button (Hamburger Icon) -->
    <button @click="menuOpen = !menuOpen" class="md:hidden text-green-700 hover:text-green-800 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Mobile Menu (Hidden by default) -->
    <div class="md:hidden" x-show="menuOpen" id="mobile-nav" @click.away="menuOpen = false" x-transition>
        <div class="absolute top-0 right-0 bg-white w-64 p-4 shadow-md rounded-lg mt-4 z-50">
            
            <!-- Close Button -->
            <div class="flex justify-end">
                <button @click="menuOpen = false" class="text-gray-500 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <a href="/" class="block text-gray-700 py-2 hover:text-green-700 transition">Home</a>
            <a href="#about" class="block text-gray-700 py-2 hover:text-green-700 transition">About</a>
            <a href="#contact" class="block text-gray-700 py-2 hover:text-green-700 transition">Contact</a>

            @auth
                <a href="{{ route('user.dashboard') }}" class="block text-gray-700 py-2 hover:text-green-700 transition">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="block text-red-600 hover:underline mt-2">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-gray-700 py-2 hover:text-green-700 transition">Login</a>
                <a href="{{ route('register') }}" class="block text-white bg-green-600 px-4 py-2 rounded-full shadow hover:bg-green-700 mt-2">Register</a>
            @endauth
        </div>
    </div>
    <!-- End of Mobile Menu -->
</nav>


@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif


  <main>
    @yield('content')
  </main>

  <footer class="text-center text-sm text-gray-500 py-6">
    &copy; {{ date('Y') }} Quran Revision Partner. All rights reserved.
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
