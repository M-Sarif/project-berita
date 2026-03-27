<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('search')) {
            $query->where('Judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori')) {
            $query->where('Kategori', $request->kategori);
        }

        $berita = $query->orderBy('tanggal_publish', 'desc')->paginate(10)->withQueryString();
        $kategoris = Berita::select('Kategori')->distinct()->pluck('Kategori');

        return view('admin.berita.index', compact('berita', 'kategoris'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Judul'    => 'required|max:100',
            'Kategori' => 'required|max:100',
            'Konten'   => 'required|max:5000',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|in:draft,publish',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        } else {
            $validated['gambar'] = '';
        }

        $validated['author']           = Auth::user()->name;
        $validated['tanggal_publish']  = now();
        $validated['view']             = 0;

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'Judul'    => 'required|max:100',
            'Kategori' => 'required|max:100',
            'Konten'   => 'required|max:5000',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|in:draft,publish',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        } else {
            unset($validated['gambar']); // Tidak update gambar jika tidak ada file baru
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function updateStatus(Request $request, Berita $berita)
    {
        $request->validate(['status' => 'required|in:draft,publish']);
        $berita->update(['status' => $request->status]);

        return back()->with('success', 'Status berita diperbarui.');
    }
}
