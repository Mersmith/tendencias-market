<?php

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckComprador;
use App\Http\Middleware\CheckVendedor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'check.admmin'])
                ->prefix('erp')
                ->name('erp.')
                ->group(base_path('routes/erp.php'));
            Route::middleware(['web'])
                ->name('ecommerce.')
                ->group(base_path('routes/ecommerce.php'));
            Route::middleware(['web', 'check.comprador'])
                ->prefix('comprador')
                ->name('comprador.')
                ->group(base_path('routes/comprador.php'));
            Route::middleware(['web', 'check.vendedor'])
                ->prefix('vendedor')
                ->name('vendedor.')
                ->group(base_path('routes/vendedor.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'check.admmin' => CheckAdmin::class,
            'check.vendedor' => CheckVendedor::class,
            'check.comprador' => CheckComprador::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
