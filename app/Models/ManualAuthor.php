<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualAuthor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'image_url',
        'position',
        'description',
        'status',
    ];

    /**
     * Articles written by this manual author.
     */
    public function articles()
    {
        return $this->hasMany(Articles::class, 'manual_author_id');
    }

    /**
     * Scope: only active authors (status = 1).
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Resolve the display image URL (uploaded file takes priority over URL).
     */
    public function getDisplayImageAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return $this->image_url ?: null;
    }
}
