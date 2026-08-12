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
        Schema::table('users', function (Blueprint $table) {
            $table->string('pillar_specialization')->nullable()->default('umum')->after('role');
        });

        Schema::table('proposals', function (Blueprint $table) {
            $table->unsignedBigInteger('assessor_parahyangan_id')->nullable()->after('status');
            $table->unsignedBigInteger('assessor_pawongan_id')->nullable()->after('assessor_parahyangan_id');
            $table->unsignedBigInteger('assessor_palemahan_id')->nullable()->after('assessor_pawongan_id');
            
            $table->integer('score_parahyangan')->nullable()->after('assessor_palemahan_id');
            $table->text('notes_parahyangan')->nullable()->after('score_parahyangan');
            
            $table->integer('score_pawongan')->nullable()->after('notes_parahyangan');
            $table->text('notes_pawongan')->nullable()->after('score_pawongan');
            
            $table->integer('score_palemahan')->nullable()->after('notes_pawongan');
            $table->text('notes_palemahan')->nullable()->after('score_palemahan');
            
            $table->decimal('final_score', 5, 2)->nullable()->after('notes_palemahan');
            $table->string('award_recommendation')->nullable()->after('final_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pillar_specialization');
        });

        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'assessor_parahyangan_id',
                'assessor_pawongan_id',
                'assessor_palemahan_id',
                'score_parahyangan',
                'notes_parahyangan',
                'score_pawongan',
                'notes_pawongan',
                'score_palemahan',
                'notes_palemahan',
                'final_score',
                'award_recommendation',
            ]);
        });
    }
};
