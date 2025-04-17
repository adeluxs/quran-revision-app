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
<nav class="bg-white shadow-md py-4 px-6 md:px-12 flex justify-between items-center font-[Cairo]" x-data="{ open: false }">
  <!-- Logo -->
  <a href="/" class="flex items-center space-x-2 text-green-700 hover:text-green-800 transition">
    <img src="https://cdn-icons-png.flaticon.com/512/811/811476.png" alt="Quran Icon" class="w-8 h-8">
    <span class="text-2xl font-extrabold tracking-tight">Quran<span class="text-green-500">Partner</span></span>
  </a>

  <!-- Menu (Desktop) -->
  <div class="hidden md:flex items-center space-x-6 text-sm" >
    <a href="/" class="text-gray-700 hover:text-green-700 transition">Home</a>
    <a href="#about" class="text-gray-700 hover:text-green-700 transition">About</a>
    <a href="#contact" class="text-gray-700 hover:text-green-700 transition">Contact</a>

    @auth
      <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-700 transition">Dashboard</a>
      <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="text-red-600 hover:underline ml-2">Logout</button>
      </form>
    @else
      <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-700 transition">Login</a>
      <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-full shadow hover:bg-green-700 transition">Register</a>
    @endauth
  </div>

  <!-- Mobile Menu Button (Hamburger Icon) -->
<button @click="open = !open" class="md:hidden text-green-700 hover:text-green-800 transition">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
  </svg>
</button>

<!-- Mobile Menu (Hidden by default) -->
<div class="md:hidden" x-show="open" id="mobile-nav" @click.away="open = false" x-transition>
  <div class="absolute top-0 right-0 bg-white w-64 p-4 shadow-md rounded-lg mt-4 z-50">
    
    <!-- Close Button -->
    <div class="flex justify-end">
      <button @click="open = false" class="text-gray-500 hover:text-red-500 transition">
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
      <a href="{{ route('dashboard') }}" class="block text-gray-700 py-2 hover:text-green-700 transition">Dashboard</a>
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

</nav>


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
</body>
</html>
