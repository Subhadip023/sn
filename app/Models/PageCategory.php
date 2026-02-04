<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    protected $table = 'page_categories';

    protected $fillable = ['page_id', 'category_id'];

    
}
