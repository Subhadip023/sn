<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale',
        'key',
        'value',
    ];

    /**
     * Clear the translation cache for all active/known locales.
     */
    public static function clearCache()
    {
        try {
            $locales = self::distinct()->pluck('locale');
            foreach ($locales as $locale) {
                Cache::forget("translations_{$locale}");
            }
        } catch (\Exception $e) {
            foreach (array_keys(languages()) as $locale) {
                Cache::forget("translations_{$locale}");
            }
        }
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }
}
