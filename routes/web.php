<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Superadmin\AccountManagementController;

include 'superadmin.php';
Route::middleware(['web'])->group(function () {
    // Public routes
    Route::get('/', function () {
        // dd(Auth::user()->role);
        return view('welcome');
    })->name('welcome');

    // Auth routes
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Registration routes
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.post');

    // Password Reset Routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/verify-identity', [ForgotPasswordController::class, 'verifyIdentity'])
        ->name('password.verify');
    Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset.form');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])
        ->name('password.update');
});

// Protected routes
Route::middleware(['auth', 'web'])->group(function () {
    // Student dashboard
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        if ($role == 'student') {
            return view('dashboard');
        } else if ($role == 'admin') {
            return view('admin.dashboard');
        } else if ($role == 'superadmin') {
            return view('superadmin.dashboard');
        }
    })->name('dashboard');

   

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/courses', function () {
        return view('courses');
    })->name('courses');

    Route::get('/missions', function () {
        return view('missions');
    })->name('missions');

    Route::get('/rewards', function () {
        return view('rewards');
    })->name('rewards');

    Route::get('/leaderboard', function () {
        return view('leaderboard');
    })->name('leaderboard');

    Route::get('/community', function () {
        return view('community');
    })->name('community');
});
