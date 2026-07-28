<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title_id',
        'title_en',
        'category_id',
        'category_en',
        'date',
        'image',
        'content_id',
        'content_en',
        'is_verified',
        'views',
    ];

    protected $casts = [
        'content_id' => 'array',
        'content_en' => 'array',
        'is_verified' => 'boolean',
    ];
}
