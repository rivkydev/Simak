<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->unsignedBigInteger('verified_by')->nullable()->after('status_verifikasi');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
            
            $table->foreign('verified_by')->references('id_pegawai')->on('pegawai')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['verified_by', 'verified_at']);
        });
    }
};