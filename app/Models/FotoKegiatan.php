<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKegiatan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'foto_kegiatan';

    // Primary key
    protected $primaryKey = 'id_foto';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_profil',
        'nama_kegiatan',
        'foto',
    ];

    // Relasi ke Profil
    public function profil()
    {
        return $this->belongsTo(Profil::class, 'id_profil', 'id_profil');
    }
}
