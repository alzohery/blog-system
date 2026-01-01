<?php

use App\Modules\Admin\Controllers\AuthController;
use App\Modules\Admin\Controllers\DashboardController;
use App\Http\Middleware\CheckAdminActive;

Route::prefix('admin')->name('admin.')->group(function () {

    // Routes للـ Login / Logout (خارجة عن Middleware)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Middleware للتحقق من تسجيل الدخول + is_active
    Route::middleware(['auth:admin', CheckAdminActive::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // باقي Routes الخاصة بالـ Admin
    });
});
