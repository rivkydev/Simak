<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('informasi_umkm', function (Blueprint $table) {
            $table->id('id_umkm'); // Primary Key
            $table->unsignedBigInteger('id_kelurahan'); // Foreign Key

            // Atribut terbaru
            $table->string('nib')->nullable();
            $table->string('nama');
            $table->text('alamat');
            $table->text('deskripsi');
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->string('gambar')->nullable();
            $table->string('instagram')->nullable();
            $table->string('grab')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('facebook')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('id_kelurahan')
                ->references('id_kelurahan')
                ->on('kelurahan')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_umkm');
    }
};
