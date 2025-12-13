<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    protected $fillable = ['nama'];

    // Relasi ke Pegawai
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan');
    }
}
