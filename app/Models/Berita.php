<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    public $timestamps = false;

    protected $fillable = [
        'Judul', 'Kategori', 'Konten', 'gambar',
        'author', 'tanggal_publish', 'status', 'view',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'view'            => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('Kategori', $kategori);
    }

    public static function getKategoriList()
    {
        return self::query()
            ->where('status', 'publish')
            ->select('Kategori')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('Kategori')
            ->get();
    }
}
