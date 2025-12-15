<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->unsignedBigInteger('id_kelurahan');
            $table->string('nama_pemohon');
            $table->string('nama_surat');
            $table->string('file_surat')->nullable();  // ✅ SUDAH NULLABLE
            $table->string('jenis_surat');
            $table->enum('status_verifikasi', ['diterima', 'ditolak'])->nullable();
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};