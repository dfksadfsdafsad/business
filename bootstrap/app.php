<?php

use App\Http\Middleware\LoadWebsiteSettings;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\InjectVisualBuilderBridge;
use App\Http\Middleware\SetAdminLocale;
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
        $middleware->alias([
            'admin' => EnsureAdmin::class,
        ]);

        $middleware->web(append: [
            LoadWebsiteSettings::class,
            SetAdminLocale::class,
            InjectVisualBuilderBridge::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
