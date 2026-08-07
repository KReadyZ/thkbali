<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    protected $table = 'web_settings';

    protected $fillable = [
        'site_name',
        'site_tagline',
        'logo_path',
    ];
}
