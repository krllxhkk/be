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

    ->withMiddleware(function (Middleware $middleware): void {

        // Alias voor jouw role-middleware
        $middleware->alias([
            'role' => App\Http\Middleware\RoleMiddleware::class,
            'auth' => App\Http\Middleware\Authenticate::class,
            // 'verified' => App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

    }) // ← вот этой скобки у тебя не было

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();