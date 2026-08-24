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
            $table->string('visit_day_parahyangan')->nullable()->after('assessor_parahyangan_id');
            $table->string('visit_day_pawongan')->nullable()->after('assessor_pawongan_id');
            $table->string('visit_day_palemahan')->nullable()->after('assessor_palemahan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'visit_day_parahyangan',
                'visit_day_pawongan',
                'visit_day_palemahan'
            ]);
        });
    }
};
