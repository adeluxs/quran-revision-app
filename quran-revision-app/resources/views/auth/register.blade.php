@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-white sm:bg-green-50">
  <div class="hidden lg:flex w-1/2 bg-green-50 items-center justify-center p-8">
    <img src="{{ asset('images/login-img.png') }}" alt="Quran Revision Illustration" class="w-full h-full object-cover">
  </div>

  <!-- Right Side: Form -->
  <div class="w-full lg:w-1/2 bg-white p-8 ">
    <h2 class="text-3xl font-extrabold text-green-700 text-center mb-6">Create Your Account</h2>
    <p class="text-lg text-gray-600 text-center mb-6">Start your Quran revision journey today—join a community of committed memorization partners and grow together!</p>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Full Name -->
      <div class="mb-4">
        <label for="name" class="block text-sm font-semibold text-gray-600">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required
               class="w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 placeholder:text-gray-500">
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-semibold text-gray-600">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
               class="w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 placeholder:text-gray-500">
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-semibold text-gray-600">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 placeholder:text-gray-500">
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <label for="password_confirmation" class="block text-sm font-semibold text-gray-600">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required
               class="w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 placeholder:text-gray-500">
      </div>

      <!-- Submit Button -->
      <button type="submit"
              class="w-full bg-green-600 text-white py-3 rounded-md hover:bg-green-700 transition duration-300">
        Register
      </button>

      <p class="mt-4 text-sm text-center">
        Already have an account? 
        <a href="{{ route('login') }}" class="text-green-600 hover:underline">Login</a>
      </p>
    </form>
  </div>
</section>
@endsection
