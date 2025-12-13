<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias';
    protected $fillable = ['id_kelurahan', 'nama_kriteria', 'atribut', 'bobot', 'jenis'];
}