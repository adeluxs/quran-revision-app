@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
  <!-- Left side: Image -->
  <div class="hidden lg:flex w-1/2 bg-green-50 items-center justify-center p-8">
     <img src="{{ asset('images/login-img.png') }}" alt="Quran Revision Illustration" class="login-img" >
  </div>

  <!-- Right side: Form -->
  <div class="w-full lg:w-1/2 bg-white flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
      <!-- Logo -->
      <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-green-700">Quran<span class="text-green-500">Partner</span></h2>
        <p class="mt-2 text-sm text-gray-600">Login to find your ideal Quran revision partner and strengthen your memorization journey.</p>
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
          <input id="email" type="email" name="email" required autofocus
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input id="password" type="password" name="password" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
          <label class="flex items-center text-sm">
            <input type="checkbox" name="remember" class="text-green-600 border-gray-300 rounded">
            <span class="ml-2 text-gray-700">Remember me</span>
          </label>
          <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">Forgot Password?</a>
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit"
            class="w-full py-2 px-4 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-700 transition">Login</button>
        </div>
      </form>

      <!-- Register Redirect -->
      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">Don't have an account?
          <a href="{{ route('register') }}" class="text-green-600 hover:underline">Register here</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
