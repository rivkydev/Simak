<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('struktur_pemerintah', function (Blueprint $table) {
            $table->id('id_struktur_pemerintah');
            $table->unsignedBigInteger('id_kelurahan')->nullable();
            $table->string('document_struktur');
            $table->timestamps();
            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_pemerintah');
    }
};
