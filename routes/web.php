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

// password request
Route::post('/password-request', [CustomAuthController::class, 'password-request'])->name('password.request');



Route::middleware(['auth'])->group(function () {
    // Only accessible by users with 'admin' role
    Route::get('/admin/dashboard', [CustomAuthController::class, 'admindashboard']);
});

Route::middleware(['auth'])->group(function () {
    // Only accessible by users with 'admin' role

    Route::get('/user/dashboard', [CustomAuthController::class, 'dashboard'])->name('user.dashboard');
});   
//Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth', 'role:memorizer')->name('dashboard');