<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;

Route::get('/', function () {
    return view('welcome');
});



// Show login form
Route::get('/login', [CustomAuthController::class, 'showLoginForm'])->name('login');

// Handle login
Route::post('/login', [CustomAuthController::class, 'login']);

// Show registration form
Route::get('/register', [CustomAuthController::class, 'showRegisterForm'])->name('register');

// Handle registration
Route::post('/register', [CustomAuthController::class, 'register']);

// Logout
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');
