<?php

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\MailPreview\Http\Middleware\AddMailPreviewOverlayToResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(AddMailPreviewOverlayToResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->stopIgnoring(HttpException::class);
        $exceptions->dontReportDuplicates();
        $exceptions->throttle(function (Throwable $e) {
            // return Lottery::odds(1, 1000)
            return Limit::perMinute(1)->by($e->getMessage());
        });
    })
    ->create();
