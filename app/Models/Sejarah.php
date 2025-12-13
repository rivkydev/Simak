<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;

    protected $table = 'sejarah';
    protected $primaryKey = 'id_sejarah';

    protected $fillable = [
        'id_kelurahan',
        'deskripsi',
    ];

    /**
     * Relasi ke model Kelurahan
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}
