<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_surat_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelurahan');
            $table->string('jenis_surat'); // Contoh: Surat Keterangan Kematian
            $table->integer('nilai');      // Contoh: 100, 80, 50
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_surat_settings');
    }
};