<?php

namespace App\Models;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    /** @use HasFactory<\Database\Factories\ArticlesFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'featured_image_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_image',
        'og_image_url',
        'category_id',
        'author_id',
        'status',
        'published_at',
        'views',
        'lang',
        'manual_author_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function manualAuthor()
    {
        return $this->belongsTo(ManualAuthor::class, 'manual_author_id');
    }

   public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'article_tags', // 👈 pivot table name
            'article_id',
            'tag_id'
        )->withTimestamps();
    }

    /**
     * Auto-set published_at when an article is first published.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (Articles $article) {
            if ($article->status === 'published' && empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
