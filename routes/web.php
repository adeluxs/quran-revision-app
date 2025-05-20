<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RevisionSessionController;
use App\Http\Controllers\PartnerController;

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
    // Only accessible by users with 'memorizer' role

    Route::get('/user/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('user/matches', [MatchController::class, 'index'])->name('matches.index');

    
        Route::get('/calendar', [RevisionSessionController::class, 'index'])->name('calendar.index');
        Route::resource('sessions', RevisionSessionController::class)->except(['show', 'edit']);
        Route::get('user/sessions/create-revision', [RevisionSessionController::class, 'create'])->name('sessions.create');
        Route::post('user/sessions/store-revision-session', [RevisionSessionController::class, 'store'])->name('sessions.store');
        Route::get('user/partners', [PartnerController::class, 'myPartners'])->name('myPartners');
        Route::post('user/partner-request', [PartnerController::class, 'sendRequest'])->name('sendrequest');
        Route::post('user/accept-partner-request{id}', [PartnerController::class, 'accept'])->name('partners.accept');
        Route::post('user/decline-partner-request{id}', [PartnerController::class, 'decline'])->name('partners.decline');
        Route::post('/sessions/{session}/accept', [RevisionSessionController::class, 'accept']);
        Route::post('/sessions/{session}/decline', [RevisionSessionController::class, 'decline']);
        Route::post('/sessions/{session}/cancel', [RevisionSessionController::class, 'cancel']);
});   
//Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth', 'role:memorizer')->name('dashboard');


