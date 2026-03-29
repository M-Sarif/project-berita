<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita (Halaman Index)
     */
    public function index(Request $request)
    {
        $query = Berita::query();

        // Fitur Pencarian
        if ($request->filled('search')) {
            $query->where('Judul', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Fitur Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('Kategori', $request->kategori);
        }

        $berita   = $query->orderBy('tanggal_publish', 'desc')->paginate(10)->withQueryString();
        $kategoris = Berita::select('Kategori')->distinct()->pluck('Kategori');

        return view('admin.berita_index', compact('berita', 'kategoris'));
    }

    /**
     * Form tambah berita baru
     */
    public function create()
    {
        return view('admin.berita_create');
    }

    /**
     * Menyimpan data berita ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Judul'    => 'required|max:100',
            'Kategori' => 'required|max:100',
            'Konten'   => 'required',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|in:draft,publish',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        } else {
            $validated['gambar'] = null;
        }

        $validated['author']          = Auth::user()->name;
        $validated['tanggal_publish'] = now();
        $validated['view']            = 0;

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail berita
     */
    public function show(Berita $berita)
    {
        return view('admin.berita_show', compact('berita'));
    }

    /**
     * Form edit berita
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita_edit', compact('berita'));
    }

    /**
     * Memperbarui data berita
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'Judul'    => 'required|max:100',
            'Kategori' => 'required|max:100',
            'Konten'   => 'required',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|in:draft,publish',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Menghapus berita
     */
    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Update status berita (Quick Action)
     */
    public function updateStatus(Request $request, Berita $berita)
    {
        $request->validate(['status' => 'required|in:draft,publish']);

        $berita->update(['status' => $request->status]);

        return back()->with('success', 'Status berita diperbarui.');
    }
}
