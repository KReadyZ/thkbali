<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'title',
        'contributor',
        'date_range',
        'time',
        'place',
        'image',
        'description',
        'views',
    ];
}
