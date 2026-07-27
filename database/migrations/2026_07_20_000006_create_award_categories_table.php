<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('award_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name_id');
            $table->string('name_en');
            $table->text('description_id');
            $table->text('description_en');
            $table->string('image');
            $table->json('badges_id'); // e.g. ["Penghargaan", "Komunitas"]
            $table->json('badges_en'); // e.g. ["Award", "Community"]
            $table->string('asesor_init');
            $table->string('asesor_name');
            $table->string('asesor_role');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('award_categories');
    }
};
