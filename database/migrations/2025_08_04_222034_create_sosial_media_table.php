<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sosial_media', function (Blueprint $table) {
            $table->id('id_sosial_media');
            $table->unsignedBigInteger('id_kelurahan')->nullable();
            $table->string('jenis_sosial_media');
            $table->string('link_sosial_media');
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sosial_media');
    }
};
