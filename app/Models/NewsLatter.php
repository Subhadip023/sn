<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLatter extends Model
{
    /** @use HasFactory<\Database\Factories\NewsLatterFactory> */
    use HasFactory;

    protected $fillable = [
        'email',
        'is_active',
        'email_verified_at',
        'unsubscribed_at',
    ];
}
