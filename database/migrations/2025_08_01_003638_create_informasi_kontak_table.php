<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('informasi_kontak', function (Blueprint $table) {
            $table->id('id_informasi_kontak');
            $table->unsignedBigInteger('id_kelurahan')->nullable();
            $table->string('jenis_kontak');
            $table->string('informasi_kontak');
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_kontak');
    }
};
