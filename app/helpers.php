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
