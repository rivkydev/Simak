<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potensi extends Model
{
    use HasFactory;

    protected $table = 'potensi';
    protected $primaryKey = 'id_potensi';
    protected $fillable = [
        'id_kelurahan',
        'jenis_potensi',
        'deskripsi_jenis_potensi',
    ];

    // Relasi ke tabel kelurahan
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}
