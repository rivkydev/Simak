<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturPemerintah extends Model
{
    use HasFactory;

    protected $table = 'struktur_pemerintah';
    protected $primaryKey = 'id_struktur_pemerintah';

    protected $fillable = [
        'id_kelurahan',
        'document_struktur',
    ];

    /**
     * Relasi ke tabel kelurahan
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}
