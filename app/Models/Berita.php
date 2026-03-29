<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table      = 'berita';
    protected $primaryKey = 'id_berita';
    public    $incrementing = true;
    protected $keyType    = 'int';
    public    $timestamps = false;

    protected $fillable = [
        'Judul',
        'Kategori',
        'Konten',
        'gambar',
        'hastag',
        'author',
        'tanggal_publish',
        'status',
        'view',
        'is_headline',  // kolom baru: 0 = biasa, 1 = headline
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'is_headline'     => 'boolean',
    ];
}
