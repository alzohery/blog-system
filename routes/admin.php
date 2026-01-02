<?php

use App\Modules\Admin\Controllers\AuthController;
use App\Modules\Admin\Controllers\DashboardController;
use App\Http\Middleware\CheckAdminActive;
use App\Modules\Categories\Controllers\CategoryController;


// =================================
//  Admin Posts Routes
// =================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Login / Logout
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware([CheckAdminActive::class])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Categories CRUD
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
});

