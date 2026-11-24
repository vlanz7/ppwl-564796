<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_pendaftaran')->unique()
                ->constrained('pendaftarans', 'id_pendaftaran')
                ->cascadeOnDelete();
            $table->decimal('total_biaya', 12, 2);
            $table->decimal('total_terbayar', 12, 2)->default(0);
            $table->enum('status_pembayaran', ['Belum Bayar', 'Belum Lunas', 'Lunas'])->default('Belum Bayar');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};