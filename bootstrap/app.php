<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // ملف الـ web الافتراضي
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/admin.php',    
            // __DIR__.'/../routes/posts.php',  
        ],

        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        // هنا نقدر نضيف تسجيل Middleware لو احتجنا alias أو middleware global
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
        // هنا نقدر نخصص معالجة الاستثناءات (Custom Exceptions)
    })->create();
