<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardCategory extends Model
{
    protected $fillable = [
        'key',
        'name_id',
        'name_en',
        'description_id',
        'description_en',
        'image',
        'badges_id',
        'badges_en',
        'asesor_init',
        'asesor_name',
        'asesor_role',
    ];

    protected $casts = [
        'badges_id' => 'array',
        'badges_en' => 'array',
    ];
}
