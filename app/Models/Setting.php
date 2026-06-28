<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    protected static $requestCache = null;

    protected static function booted()
    {
        static::saved(function () {
            static::clearCache();
        });

        static::deleted(function () {
            static::clearCache();
        });
    }

    public static function clearCache()
    {
        static::$requestCache = null;
        \Illuminate\Support\Facades\Cache::forget('site_settings');
    }

    /**
     * Get a setting value by key.
     */
    public static function get($key, $default = null)
    {
        if (static::$requestCache === null) {
            static::$requestCache = \Illuminate\Support\Facades\Cache::rememberForever('site_settings', function () {
                return self::pluck('value', 'key')->toArray();
            });
        }

        return array_key_exists($key, static::$requestCache) ? static::$requestCache[$key] : $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set($key, $value)
    {
        $setting = self::updateOrCreate(['key' => $key], ['value' => $value]);
        self::clearCache();
        return $setting;
    }
}
