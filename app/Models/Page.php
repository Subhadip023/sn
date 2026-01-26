<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

    protected $guarded = [];

    public function blocks(){
        
        return $this->hasMany(PageBlock::class)->orderBy('position');
    }

}
