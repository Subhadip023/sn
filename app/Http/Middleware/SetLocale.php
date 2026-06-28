<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Schema;
use App\Models\Translation;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;

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
                $translations = Cache::rememberForever("translations_{$locale}", function () use ($locale) {
                    return Translation::where('locale', $locale)->pluck('value', 'key')->toArray();
                });
                
                $translator = app('translator');
                $translator->load('*', '*', $locale);

                $setJsonTranslations = function ($locale, $translations) {
                    foreach ($translations as $key => $value) {
                        $this->loaded['*']['*'][$locale][$key] = $value;
                    }
                };
                \Closure::bind($setJsonTranslations, $translator, $translator)($locale, $translations);
            }
        } catch (\Exception $e) {
            // Silently fall back if DB is not set up yet
        }

        return $next($request);
    }
}
