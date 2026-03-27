<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function index()
    {
        // Ambil berita terbaru yang sudah publish (max 10)
        $beritaTerbaru = DB::table('berita')
            ->where('status', 'publish')
            ->orderBy('tanggal_publish', 'desc')
            ->limit(10)
            ->get();

        // Hero slider: 5 berita terbaru
        $heroBerita = $beritaTerbaru->take(5);

        // Hitung jumlah berita per kategori
        $kategoriCount = DB::table('berita')
            ->where('status', 'publish')
            ->select('Kategori', DB::raw('count(*) as total'))
            ->groupBy('Kategori')
            ->pluck('total', 'Kategori')
            ->toArray();

        // Ambil video terbaru (max 4)
        $videos = DB::table('video')
            ->orderBy('tanggal_publish', 'desc')
            ->limit(4)
            ->get();

        return view('berita', compact(
            'beritaTerbaru',
            'heroBerita',
            'kategoriCount',
            'videos'
        ));
    }
}
