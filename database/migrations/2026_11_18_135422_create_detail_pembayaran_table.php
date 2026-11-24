<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pembayaran', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_pembayaran')->constrained('pembayaran', 'id_pembayaran')->cascadeOnDelete();
            $table->decimal('jumlah_bayar', 12, 2);
            $table->date('tanggal_bayar');
            $table->enum('metode_pembayaran', ['Transfer Bank', 'QRIS', 'Lainnya']);
            $table->enum('status_cicilan', ['Menunggu', 'Diverifikasi', 'Ditolak'])->default('Menunggu');
            $table->timestamp('verified_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pembayaran');
    }
};