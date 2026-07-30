<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('thk_leader_name')->nullable();
            $table->string('thk_leader_wa')->nullable();
            $table->string('pic_parahyangan_name')->nullable();
            $table->string('pic_parahyangan_wa')->nullable();
            $table->string('pic_pawongan_name')->nullable();
            $table->string('pic_pawongan_wa')->nullable();
            $table->string('pic_palemahan_name')->nullable();
            $table->string('pic_palemahan_wa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'thk_leader_name',
                'thk_leader_wa',
                'pic_parahyangan_name',
                'pic_parahyangan_wa',
                'pic_pawongan_name',
                'pic_pawongan_wa',
                'pic_palemahan_name',
                'pic_palemahan_wa',
            ]);
        });
    }
};
