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
            $table->text('address')->nullable();
            $table->string('gmaps_link')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_wa')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('prev_accreditation')->nullable();
            $table->string('link_parahyangan')->nullable();
            $table->string('link_pawongan')->nullable();
            $table->string('link_palemahan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'gmaps_link',
                'contact_name',
                'contact_wa',
                'contact_email',
                'payment_proof',
                'prev_accreditation',
                'link_parahyangan',
                'link_pawongan',
                'link_palemahan'
            ]);
        });
    }
};
