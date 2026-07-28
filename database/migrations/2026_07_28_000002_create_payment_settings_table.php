<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->default('BPD Bali');
            $table->string('account_number')->default('009.02.12.00001-1');
            $table->string('account_name')->default('Yayasan THK Bali');
            $table->string('amount')->default('Rp 500.000');
            $table->string('description')->nullable();
            $table->string('qr_image')->nullable(); // path to QR code image
            $table->timestamps();
        });

        // Insert default row
        DB::table('payment_settings')->insert([
            'bank_name'      => 'BPD Bali',
            'account_number' => '009.02.12.00001-1',
            'account_name'   => 'Yayasan THK Bali',
            'amount'         => 'Rp 500.000',
            'description'    => 'Transfer dengan mencantumkan nama instansi/perusahaan Anda sebagai berita transfer.',
            'qr_image'       => null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
