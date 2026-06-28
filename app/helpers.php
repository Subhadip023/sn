<?php

if (!function_exists('all_roles')) {
    function all_roles()
    {
       return [
            0 =>'user',
            1 => 'admin',
            2 => 'editor',
            3 => 'journalist',
       ];
    }
}

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('languages')) {
    function languages()
    {
        return [
            'en' => 'English',
            'bn' => 'Bengali',
        ];
    }
}
