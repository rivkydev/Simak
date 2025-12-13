<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiUMKM extends Model
{
    protected $table = 'informasi_umkm';
    protected $primaryKey = 'id_umkm';

    protected $fillable = [
        'id_kelurahan',
        'nib',
        'nama',
        'alamat',
        'deskripsi',
        'email',
        'telp',
        'gambar',
        'tahun_berdiri',
        'jenis_usaha',
        'instagram',
        'grab',
        'facebook',
        'tiktok',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}
