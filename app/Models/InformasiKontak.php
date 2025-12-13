<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InformasiKontak extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'informasi_kontak';

    // Primary key
    protected $primaryKey = 'id_informasi_kontak';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_kelurahan',
        'jenis_kontak',
        'informasi_kontak',
    ];

    /**
     * Relasi ke tabel kelurahan
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}
