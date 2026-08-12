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
            if (!Schema::hasColumn('users', 'specialization')) {
                $table->string('specialization')->nullable()->after('role'); // parahyangan, pawongan, palemahan, umum
            }
        });

        Schema::table('proposals', function (Blueprint $table) {
            if (!Schema::hasColumn('proposals', 'assessor_parahyangan_id')) {
                $table->unsignedBigInteger('assessor_parahyangan_id')->nullable()->after('status');
            }
            if (!Schema::hasColumn('proposals', 'assessor_pawongan_id')) {
                $table->unsignedBigInteger('assessor_pawongan_id')->nullable()->after('assessor_parahyangan_id');
            }
            if (!Schema::hasColumn('proposals', 'assessor_palemahan_id')) {
                $table->unsignedBigInteger('assessor_palemahan_id')->nullable()->after('assessor_pawongan_id');
            }

            if (!Schema::hasColumn('proposals', 'score_parahyangan')) {
                $table->decimal('score_parahyangan', 5, 2)->nullable()->after('assessor_palemahan_id');
            }
            if (!Schema::hasColumn('proposals', 'notes_parahyangan')) {
                $table->text('notes_parahyangan')->nullable()->after('score_parahyangan');
            }

            if (!Schema::hasColumn('proposals', 'score_pawongan')) {
                $table->decimal('score_pawongan', 5, 2)->nullable()->after('notes_parahyangan');
            }
            if (!Schema::hasColumn('proposals', 'notes_pawongan')) {
                $table->text('notes_pawongan')->nullable()->after('score_pawongan');
            }

            if (!Schema::hasColumn('proposals', 'score_palemahan')) {
                $table->decimal('score_palemahan', 5, 2)->nullable()->after('notes_pawongan');
            }
            if (!Schema::hasColumn('proposals', 'notes_palemahan')) {
                $table->text('notes_palemahan')->nullable()->after('score_palemahan');
            }

            if (!Schema::hasColumn('proposals', 'final_score')) {
                $table->decimal('final_score', 5, 2)->nullable()->after('notes_palemahan');
            }
            if (!Schema::hasColumn('proposals', 'award_recommendation')) {
                $table->string('award_recommendation')->nullable()->after('final_score');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropForeign(['assessor_parahyangan_id']);
            $table->dropForeign(['assessor_pawongan_id']);
            $table->dropForeign(['assessor_palemahan_id']);
            $table->dropColumn([
                'assessor_parahyangan_id',
                'assessor_pawongan_id',
                'assessor_palemahan_id',
                'score_parahyangan',
                'score_pawongan',
                'score_palemahan',
                'notes_parahyangan',
                'notes_pawongan',
                'notes_palemahan',
                'final_score',
                'award_decision'
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('specialization');
        });
    }
};
