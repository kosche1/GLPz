<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Superadmin\AccountManagementController;

Route::middleware(['web'])->group(function () {
    // Public routes
    Route::get('/', function () {
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
        return view('dashboard');
    })->name('dashboard');

    // Admin dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Super Admin dashboard
    Route::get('/superadmin/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('superadmin.dashboard');

    Route::get('/superadmin/account-management', [AccountManagementController::class, 'index'])
        ->name('superadmin.account-management');

    Route::post('/superadmin/account/delete', [AccountManagementController::class, 'destroy'])
        ->name('superadmin.deleteAccount');

    Route::post('/superadmin/account/update', [AccountManagementController::class, 'update'])
        ->name('superadmin.updateAccount');

    Route::post('/superadmin/account/add', [AccountManagementController::class, 'store'])
        ->name('superadmin.addAccount');

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
