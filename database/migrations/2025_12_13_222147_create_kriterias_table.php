<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SKRIPSI POIN 5b: Tabel pembobotan untuk setiap kriteria
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelurahan'); // Agar settingan per kelurahan beda-beda
            $table->string('nama_kriteria'); // Contoh: Lama Menunggu
            $table->string('atribut');       // ID internal: 'lama_menunggu'
            $table->float('bobot');          // Nilai bobot (0.1 - 1.0)
            $table->enum('jenis', ['benefit', 'cost']); 
            $table->timestamps();

            // Relasi ke tabel kelurahan
            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};