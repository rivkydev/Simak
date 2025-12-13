<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSuratSetting extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat_settings';
    protected $fillable = ['id_kelurahan', 'jenis_surat', 'nilai'];
}