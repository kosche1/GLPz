<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\AccountManagementController;
use App\Http\Controllers\SuperAdmin\LevelManagementController;

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
});
