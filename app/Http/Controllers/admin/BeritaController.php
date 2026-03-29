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
     * Menampilkan daftar berita
     */
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

        $berita    = $query->orderBy('tanggal_publish', 'desc')->paginate(10)->withQueryString();
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
            'Judul'       => 'required|max:100',
            'Kategori'    => 'required|max:100',
            'Konten'      => 'required',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hastag'      => 'nullable|max:100',
            'author'      => 'required|max:50',
            'status'      => 'required|in:draft,publish',
            'is_headline' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        } else {
            $validated['gambar'] = null;
        }

        $validated['tanggal_publish'] = now();
        $validated['view']            = 0;
        $validated['is_headline']     = $request->has('is_headline') ? 1 : 0;
        $validated['hastag']          = $request->input('hastag', '');

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
     *
     * BUG FIX: Sebelumnya, jika tidak ada file gambar baru yang diupload,
     * key 'gambar' tidak ada di $validated sehingga $berita->update($validated)
     * tidak menyertakan gambar sama sekali — akibatnya DB menjadi null/kosong.
     *
     * Fix: unset key 'gambar' dari $validated jika tidak ada upload baru,
     * sehingga nilai gambar lama di DB tetap dipertahankan.
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'Judul'       => 'required|max:100',
            'Kategori'    => 'required|max:100',
            'Konten'      => 'required',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hastag'      => 'nullable|max:100',
            'author'      => 'required|max:50',
            'status'      => 'required|in:draft,publish',
            'is_headline' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            // Ada file baru → hapus gambar lama, simpan yang baru
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        } else {
            // Tidak ada file baru → JANGAN sentuh kolom gambar sama sekali
            // Unset agar $berita->update() tidak menimpa gambar lama dengan null
            unset($validated['gambar']);
        }

        $validated['is_headline'] = $request->has('is_headline') ? 1 : 0;
        $validated['hastag']      = $request->input('hastag', '');

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

    /**
     * Toggle headline berita (Quick Action dari dashboard)
     */
    public function toggleHeadline(Berita $berita)
    {
        $berita->update(['is_headline' => ! $berita->is_headline]);

        $msg = $berita->is_headline ? 'Berita dijadikan Headline.' : 'Berita dicopot dari Headline.';

        return back()->with('success', $msg);
    }
}
