<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SetLocale;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use App\Support\LocaleManager;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state', 'locale']);

        $middleware->web(append: [
            SetLocale::class,
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->respond(function (Response $response, Throwable $exception, Request $request): Response {
            if ($response->getStatusCode() !== 404 || $request->expectsJson()) {
                return $response;
            }

            $locale = app()->getLocale();

            return Inertia::render('site/NotFound', [
                'settings' => SiteSettingResource::make(SiteSetting::current())->resolve($request),
                'locale' => $locale,
                'locales' => LocaleManager::available(),
                'translations' => LocaleManager::translations($locale),
            ])->toResponse($request)->setStatusCode(404);
        });
    })->create();
