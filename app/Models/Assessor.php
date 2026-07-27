<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessor extends Model
{
    protected $fillable = [
        'name',
        'title',
        'image',
        'instagram',
        'facebook',
        'youtube',
        'linkedin',
        'website',
    ];
}
