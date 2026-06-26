<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Page;
use App\Models\Article;
class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'active',
        'lang',
    ];

    public function pages()
    {
        return $this->belongsToMany(
            Page::class,
            'page_categories'
        );
    }

    public function articles()
    {
        return $this->hasMany(Articles::class);
    }
}
