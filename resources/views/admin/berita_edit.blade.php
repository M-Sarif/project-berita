@extends('admin.layout')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('breadcrumb', 'Admin / Berita / Edit')

@section('content')

<form method="POST" action="{{ route('admin.berita.update', $berita->id_berita) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start">

    {{-- Kolom Kiri --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

        <div class="card">
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="Judul">
                        Judul Berita <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="Judul"
                        name="Judul"
                        value="{{ old('Judul', $berita->Judul) }}"
                        class="form-control {{ $errors->has('Judul') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan judul berita..."
                        maxlength="100"
                        required
                    >
                    @error('Judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2>Konten Berita</h2></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="Konten">
                        Isi Berita <span class="required">*</span>
                    </label>
                    <textarea
                        id="Konten"
                        name="Konten"
                        class="form-control {{ $errors->has('Konten') ? 'is-invalid' : '' }}"
                        maxlength="5000"
                        rows="16"
                        required
                    >{{ old('Konten', $berita->Konten) }}</textarea>
                    <div class="form-hint" style="display:flex;justify-content:space-between">
                        <span>Maksimal 5.000 karakter</span>
                        <span id="char-count">0 / 5000</span>
                    </div>
                    @error('Konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

    </div>

    {{-- Kolom Kanan --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

        <div class="card">
            <div class="card-header"><h2>Publikasi</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <div style="font-size:0.8125rem;color:var(--gray-500);margin-bottom:0.75rem">
                        <strong>Author:</strong> {{ $berita->author }}<br>
                        <strong>Ditulis:</strong> {{ $berita->tanggal_publish?->format('d M Y, H:i') }}<br>
                        <strong>Views:</strong> {{ number_format($berita->view) }}
                    </div>
                    <label class="form-label" for="status">
                        Status <span class="required">*</span>
                    </label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="draft"   {{ old('status', $berita->status) === 'draft'   ? 'selected' : '' }}>Draft</option>
                        <option value="publish" {{ old('status', $berita->status) === 'publish' ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>

                <div style="display:flex;gap:0.75rem">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary" style="flex:1;justify-content:center">Batal</a>
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                        Update
                    </button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2>Kategori</h2></div>
            <div class="card-body" style="padding-bottom:1.25rem">
                <div class="form-group" style="margin-bottom:0.75rem">
                    <label class="form-label" for="Kategori">
                        Pilih Kategori <span class="required">*</span>
                    </label>
                    <select id="Kategori" name="Kategori" class="form-control {{ $errors->has('Kategori') ? 'is-invalid' : '' }}" required>
                        <option value="">— Pilih Kategori —</option>
                        @foreach (['Berita', 'Headline', 'Beasiswa', 'Prestasi', 'Penelitian dan Inovasi', 'Pendidikan', 'Seminar/Workshop', 'Liputan/Berita'] as $kat)
                            <option value="{{ $kat }}" {{ old('Kategori', $berita->Kategori) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    @error('Kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <p class="form-hint">Atau ketik kategori baru:</p>
                <input
                    type="text"
                    id="custom_kategori"
                    placeholder="Kategori baru..."
                    class="form-control"
                    style="margin-top:0.5rem"
                    oninput="document.getElementById('Kategori').value = this.value"
                >
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2>Gambar Utama</h2></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0">
                    @if ($berita->gambar)
                        <div style="margin-bottom:0.875rem">
                            <p class="form-hint" style="margin-bottom:0.5rem">Gambar saat ini:</p>
                            <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->Judul }}" class="img-preview">
                        </div>
                    @endif
                    <label class="form-label" for="gambar">Ganti Gambar</label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        class="form-control {{ $errors->has('gambar') ? 'is-invalid' : '' }}"
                        accept="image/jpeg,image/png,image/webp"
                        onchange="previewImage(this)"
                    >
                    <div class="form-hint">Kosongkan jika tidak ingin mengganti gambar.</div>
                    @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div id="preview-wrap" style="margin-top:0.875rem;display:none">
                        <img id="img-preview" class="img-preview" src="" alt="Preview Baru">
                    </div>
                </div>
            </div>
        </div>

        {{-- Hapus Berita --}}
        <div class="card" style="border-color:#fecaca">
            <div class="card-body">
                <p style="font-size:0.8125rem;color:var(--gray-600);margin-bottom:0.875rem">
                    <strong style="color:var(--danger)">Zona Berbahaya</strong><br>
                    Menghapus berita tidak dapat dibatalkan.
                </p>
                <form method="POST"
                      action="{{ route('admin.berita.destroy', $berita->id_berita) }}"
                      onsubmit="return confirm('Yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Berita Ini
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

</form>

@endsection

@push('scripts')
<script>
function previewImage(input) {
    const wrap = document.getElementById('preview-wrap');
    const img  = document.getElementById('img-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; wrap.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}

const textarea  = document.getElementById('Konten');
const charCount = document.getElementById('char-count');
function updateCount() {
    const len = textarea.value.length;
    charCount.textContent = len + ' / 5000';
    charCount.style.color = len > 4800 ? 'var(--danger)' : 'var(--gray-400)';
}
textarea.addEventListener('input', updateCount);
updateCount();
</script>
@endpush
