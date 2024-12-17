<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;

Route::middleware(['auth', 'superadmin', 'web'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/account-management', [AccountManagementController::class, 'index'])
        ->name('superadmin.account-management');

    Route::post('/superadmin/account/delete', [AccountManagementController::class, 'destroy'])
        ->name('superadmin.deleteAccount');

    Route::post('/superadmin/account/update', [AccountManagementController::class, 'update'])
        ->name('superadmin.updateAccount');

    Route::post('/superadmin/account/add', [AccountManagementController::class, 'store'])
        ->name('superadmin.addAccount');
});
