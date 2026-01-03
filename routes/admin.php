<?php

use App\Modules\Admin\Controllers\AuthController;
use App\Modules\Admin\Controllers\DashboardController;
use App\Http\Middleware\CheckAdminActive;
use App\Modules\Categories\Controllers\CategoryController;
use App\Modules\Posts\Controllers\PostController;
use App\Modules\ActivityLog\Controllers\ActivityLogController;
use App\Modules\Users\Controllers\UserController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Login / Logout
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware([CheckAdminActive::class])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 
        // =========================
        // Categories crud
        // =========================
        Route::resource('categories', CategoryController::class)->except(['show']);

        // =========================
        // Posts Routes 
        // =========================

        // Posts create
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

        // Posts Index
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

        // Posts Edit
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

        // Update Post
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        
        // Delete Post
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

        // =========================
        // view log
        // =========================
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

        // =========================
        // Users Management (Admin)
        // =========================
        Route::resource('users', UserController::class)->except(['show']);

    });
});
