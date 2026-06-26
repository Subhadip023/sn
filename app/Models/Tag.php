<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title', 'slug', 'active', 'lang'];

    public function pages() {
        return $this->belongsToMany(Page::class, 'page_tags', 'tag_id', 'page_id');
    }
}
