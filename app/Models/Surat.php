<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    // Sesuaikan dengan nama tabel di database
    protected $table = 'surat';
    
    // Sesuaikan dengan primary key di migrasi (id_surat)
    protected $primaryKey = 'id_surat';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_kelurahan',
        'nama_pemohon',
        'nama_surat',
        'file_surat',
        'jenis_surat',
        'status_verifikasi',
    ];

    // Relasi ke Model Kelurahan
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}