<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException; // 👈 قم بإضافة هذا السطر

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
       // **الصيغة الصحيحة في Laravel 11 لمعالجة AuthenticationException**
        $exceptions->renderable(function (AuthenticationException $e, Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // يتم التوجيه إلى مسار تسجيل الدخول الخاص بـ Filament
            return redirect()->guest(route('filament.admin.auth.login'));
        });
    })->create();
