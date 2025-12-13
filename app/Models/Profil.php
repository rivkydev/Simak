<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';
    protected $primaryKey = 'id_profil';
    protected $fillable = [
        'id_kelurahan',
        'visi',
        'misi',
        'deskripsi_potensi',
        'deskripsi',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }
    public function fotoKegiatan()
    {
        return $this->hasMany(FotoKegiatan::class, 'id_profil', 'id_profil');
    }
}
