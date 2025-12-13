<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $primaryKey = 'id_kelurahan';

    protected $fillable = [
        'nama',
        'kecamatan',
        'kode_pos',
        'foto_kelurahan',
        'lokasi_maps',
    ];

    public function profil()
    {
        return $this->hasOne(Profil::class, 'id_kelurahan');
    }
    public function umkms()
    {
        return $this->hasMany(InformasiUMKM::class, 'id_kelurahan', 'id_kelurahan');
    }
}
