<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\DashboardController;

Route::middleware(['auth', 'teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/courses', [DashboardController::class, 'courses'])->name('teacher.courses');
    Route::get('/students', [DashboardController::class, 'students'])->name('teacher.students');
    Route::get('/assignments', [DashboardController::class, 'assignments'])->name('teacher.assignments');
    Route::get('/progress', [DashboardController::class, 'progress'])->name('teacher.progress');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('teacher.profile');
}); 