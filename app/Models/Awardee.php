<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Awardee extends Model
{
    protected $fillable = [
        'name',
        'medal',
        'year',
        'description',
        'image',
        'category_key',
        'parahyangan_achievement',
        'pawongan_achievement',
        'palemahan_achievement',
    ];
}
