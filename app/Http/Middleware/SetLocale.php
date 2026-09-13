<?php

namespace App\Http\Middleware;

use App\Support\LocaleManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defaultLocale = config('app.locale');
        $defaultLocale = is_string($defaultLocale) ? $defaultLocale : 'ru';
        $locale = $request->cookie('locale', $defaultLocale);

        if (! is_string($locale) || ! LocaleManager::isValid($locale)) {
            $locale = $defaultLocale;
        }

        LocaleManager::apply($locale);

        return $next($request);
    }
}
