<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->id('id_profil');
            $table->unsignedBigInteger('id_kelurahan')->nullable();
            $table->text('misi')->nullable();
            $table->text('visi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('deskripsi_potensi')->nullable();
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil');
    }
};
