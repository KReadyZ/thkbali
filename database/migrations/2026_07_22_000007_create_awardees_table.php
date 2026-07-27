<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('awardees', function (Blueprint $table) {
            $table->id();
            $table->string('category_key')->default('desa-adat'); // link to category key
            $table->string('name');
            $table->string('medal'); // Gold, Silver, Bronze
            $table->string('year'); // 2026, etc.
            $table->text('description');
            $table->string('image')->nullable();
            $table->text('parahyangan_achievement')->nullable();
            $table->text('pawongan_achievement')->nullable();
            $table->text('palemahan_achievement')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('awardees');
    }
};
