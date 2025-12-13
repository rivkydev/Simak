<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->id('id_kelurahan');
            $table->string('kecamatan');
            $table->string('kode_pos');
            $table->string('nama');
            $table->string('foto_kelurahan')->nullable();
            $table->text('lokasi_maps')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelurahan');
    }
};
