<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\AccountManagementController;
use App\Http\Controllers\SuperAdmin\LevelManagementController;
use App\Http\Controllers\SuperAdmin\AchievementManagementController;

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/account-management', [AccountManagementController::class, 'index'])
        ->name('superadmin.account-management');

    Route::post('/superadmin/account/delete', [AccountManagementController::class, 'destroy'])
        ->name('superadmin.deleteAccount');

    Route::post('/superadmin/account/update', [AccountManagementController::class, 'update'])
        ->name('superadmin.updateAccount');

    Route::post('/superadmin/account/add', [AccountManagementController::class, 'store'])
        ->name('superadmin.addAccount');

    Route::get('/superadmin/levels', [LevelManagementController::class, 'index'])->name('superadmin.levels.index');
    Route::post('/superadmin/levels', [LevelManagementController::class, 'store'])->name('superadmin.levels.store');
    Route::put('/superadmin/levels/{level}', [LevelManagementController::class, 'update'])->name('superadmin.levels.update');
    Route::delete('/superadmin/levels/{level}', [LevelManagementController::class, 'destroy'])->name('superadmin.levels.destroy');

    // Achievement Management Routes
    Route::get('/superadmin/achievements', [AchievementManagementController::class, 'index'])->name('superadmin.achievements.index');
    Route::post('/superadmin/achievements', [AchievementManagementController::class, 'store'])->name('superadmin.achievements.store');
    Route::put('/superadmin/achievements/{achievement}', [AchievementManagementController::class, 'update'])->name('superadmin.achievements.update');
    Route::delete('/superadmin/achievements/{achievement}', [AchievementManagementController::class, 'destroy'])->name('superadmin.achievements.destroy');

    // Add with other superadmin routes
    Route::get('/activities', function() {
        return view('superadmin.activities.index');
    })->name('superadmin.activities.index');
});
