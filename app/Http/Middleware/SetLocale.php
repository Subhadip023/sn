<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Schema;
use App\Models\Translation;
use Illuminate\Support\Facades\Lang;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session()->get('locale', setting('default_language', config('app.locale', 'en')));
        app()->setLocale($locale);

        try {
            if (Schema::hasTable('translations')) {
                $translations = Translation::where('locale', $locale)->pluck('value', 'key')->toArray();
                Lang::addLines($translations, $locale);
            }
        } catch (\Exception $e) {
            // Silently fall back if DB is not set up yet
        }

        return $next($request);
    }
}
