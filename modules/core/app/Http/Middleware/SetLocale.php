<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported application locales.
     */
    protected array $supported = ['en', 'vi'];

    /**
     * Handle an incoming request.
     *
     * Determine the locale from (in order):
     * 1. Query parameter  ?locale=vi
     * 2. Session value
     * 3. Browser Accept-Language header
     * 4. Fallback to 'en'
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('locale')
            ?? Session::get('locale')
            ?? $request->getPreferredLanguage($this->supported);

        if (in_array($locale, $this->supported, true)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return $next($request);
    }
}
