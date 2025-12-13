<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai'); // Primary key

            // Foreign keys
            $table->unsignedBigInteger('id_kelurahan');
            $table->unsignedBigInteger('id_pangkat')->nullable();
            $table->unsignedBigInteger('id_jabatan');

            // Data fields
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('password');

            $table->timestamps();

            // Constraints
            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
            $table->foreign('id_pangkat')->references('id_pangkat')->on('pangkat')->onDelete('cascade');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
