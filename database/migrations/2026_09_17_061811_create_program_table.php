<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program', function (Blueprint $table) {
            $table->id('id_program');
            $table->string('nama_program');
            $table->string('deskripsi');
            $table->decimal('biaya', 12, 2);
            $table->string('durasi');
            $table->integer('kuota');
            $table->enum('status', ['Tersedia', 'Penuh'])->default('Tersedia');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
