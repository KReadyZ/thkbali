<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'pilar_filosofi',
        'peserta_awards',
        'asesor_aktif',
        'kategori_awards',
        'desa_adat_penerima',
    ];
}
