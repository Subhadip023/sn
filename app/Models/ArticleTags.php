<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTags extends Model
{
    protected $table = 'article_tags';

    protected $fillable = [
        'article_id',
        'tag_id',
    ];
}
