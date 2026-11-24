<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->foreignId('id_peserta')->constrained('pesertas', 'id_peserta')->cascadeOnDelete();;
            $table->foreignId('id_program')->constrained('program', 'id_program')->cascadeOnDelete();;
            $table->timestamp('tanggal_pendaftaran')->useCurrent();
            $table->enum('status_pendaftaran', ['Menunggu','Diverifikasi', 'Ditolak', 'Diterima'])->default('Menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
