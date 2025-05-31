<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            //'auth' => \App\Http\Middleware\Authenticate::class,
            // ... các middleware alias khác đã có sẵn
            'admin' => \App\Http\Middleware\AdminMiddleware::class, // <-- Đặt dòng này Ở ĐÂY
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    
