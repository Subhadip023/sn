<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

    protected $guarded = [];

    public function categories() {
        return $this->belongsToMany(Category::class, 'page_categories', 'page_id', 'category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'page_tags', 'page_id', 'tag_id');
    }
}
