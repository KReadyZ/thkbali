<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->integer('pilar_filosofi')->default(3);
            $blueprint->integer('peserta_awards')->default(120);
            $blueprint->integer('asesor_aktif')->default(45);
            $blueprint->integer('kategori_awards')->default(12);
            $blueprint->integer('desa_adat_penerima')->default(8);
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
