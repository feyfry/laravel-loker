<?php

use App\Http\Middleware\TrackUserActivityMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Menggunakan array untuk mendefinisikan alias
        $middleware->alias([
            'agent' => Jenssegers\Agent\Facades\Agent::class,
        ]);

        // $middleware->web(TrackUserActivityMiddleware::class);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
