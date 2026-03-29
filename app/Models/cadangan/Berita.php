<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table      = 'berita';
    protected $primaryKey = 'id_berita';
    public    $timestamps = false; // tabel tidak punya created_at / updated_at

    protected $fillable = [
        'Judul',
        'Kategori',
        'Konten',
        'gambar',
        'author',
        'tanggal_publish',
        'status',
        'view',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];
}
