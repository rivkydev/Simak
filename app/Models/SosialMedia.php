<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialMedia extends Model
{
    use HasFactory;

    protected $table = 'sosial_media';

    protected $primaryKey = 'id_sosial_media';

    protected $fillable = [
        'id_kelurahan',
        'jenis_sosial_media',
        'link_sosial_media',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }
}
