<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('potensi', function (Blueprint $table) {
            $table->id('id_potensi');
            $table->unsignedBigInteger('id_kelurahan')->nullable();
            $table->string('jenis_potensi');
            $table->text('deskripsi_jenis_potensi');
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potensi');
    }
};
