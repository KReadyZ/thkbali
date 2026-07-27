<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'image',
        'title_id',
        'title_en',
        'category_id',
        'category_en',
    ];
}
