<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('foto_kegiatan', function (Blueprint $table) {
            $table->id('id_foto'); // Primary key
            $table->unsignedBigInteger('id_profil');
            $table->string('foto');
            $table->string('nama_kegiatan'); // tambahkan ini
            $table->timestamps();
            // Relasi foreign key ke tabel profil
            $table->foreign('id_profil')
                ->references('id_profil')
                ->on('profil')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_kegiatan');
    }
};
