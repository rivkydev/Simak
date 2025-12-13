<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id('id_jabatan'); // Primary Key
            $table->string('nama');   // Atribut
            $table->timestamps();     // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};

