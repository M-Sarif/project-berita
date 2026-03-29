@extends('admin.layout')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')
@section('breadcrumb', 'Admin / Berita / Tambah')

@section('content')

<form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
@csrf

<div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start">

    {{-- Kolom Kiri: Konten Utama --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

        {{-- Judul --}}
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
                        value="{{ old('Judul') }}"
                        class="form-control {{ $errors->has('Judul') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan judul berita..."
                        maxlength="100"
                        required
                    >
                    @error('Judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Konten --}}
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
                        placeholder="Tulis isi berita di sini..."
                        maxlength="5000"
                        rows="16"
                        required
                    >{{ old('Konten') }}</textarea>
                    <div class="form-hint" style="display:flex;justify-content:space-between">
                        <span>Maksimal 5.000 karakter</span>
                        <span id="char-count">0 / 5000</span>
                    </div>
                    @error('Konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Hastag --}}
        <div class="card">
            <div class="card-header"><h2>Hastag</h2></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="hastag">Hastag</label>
                    <input
                        type="text"
                        id="hastag"
                        name="hastag"
                        value="{{ old('hastag') }}"
                        class="form-control {{ $errors->has('hastag') ? 'is-invalid' : '' }}"
                        placeholder="Contoh: #PendidikanTinggi #Beasiswa #PTMA"
                        maxlength="100"
                    >
                    <div class="form-hint">Pisahkan dengan spasi. Contoh: #Beasiswa #Prestasi</div>
                    @error('hastag')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

    </div>

    {{-- Kolom Kanan: Meta --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

        {{-- Publish Box --}}
        <div class="card">
            <div class="card-header"><h2>Publikasi</h2></div>
            <div class="card-body">

                {{-- Author (bisa diketik manual) --}}
                <div class="form-group">
                    <label class="form-label" for="author">
                        Author <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="author"
                        name="author"
                        value="{{ old('author', Auth::user()->name) }}"
                        class="form-control {{ $errors->has('author') ? 'is-invalid' : '' }}"
                        placeholder="Nama penulis..."
                        maxlength="50"
                        required
                    >
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="status">
                        Status <span class="required">*</span>
                    </label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="draft"   {{ old('status','draft') === 'draft'   ? 'selected' : '' }}>Draft</option>
                        <option value="publish" {{ old('status') === 'publish' ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>

                {{-- Headline Toggle --}}
                <div class="form-group" style="margin-bottom:1rem">
                    <label style="display:flex;align-items:center;gap:0.6rem;cursor:pointer;font-size:0.875rem;font-weight:500;color:var(--gray-700)">
                        <input
                            type="checkbox"
                            name="is_headline"
                            value="1"
                            {{ old('is_headline') ? 'checked' : '' }}
                            style="width:16px;height:16px;cursor:pointer;accent-color:var(--primary)"
                        >
                        Jadikan Headline
                    </label>
                    <div class="form-hint" style="margin-top:0.3rem">Berita akan tampil di bagian Headline halaman utama.</div>
                </div>

                <div style="display:flex;gap:0.75rem">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary" style="flex:1;justify-content:center">Batal</a>
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
                    </button>
                </div>
            </div>
        </div>

        {{-- Kategori — Headline & Berita dihapus sesuai permintaan --}}
        <div class="card">
            <div class="card-header"><h2>Kategori</h2></div>
            <div class="card-body" style="padding-bottom:1.25rem">
                <div class="form-group" style="margin-bottom:0.75rem">
                    <label class="form-label" for="Kategori">
                        Pilih Kategori <span class="required">*</span>
                    </label>
                    <select id="Kategori" name="Kategori" class="form-control {{ $errors->has('Kategori') ? 'is-invalid' : '' }}" required>
                        <option value="">— Pilih Kategori —</option>
                        @foreach ([
                            'Beasiswa',
                            'Prestasi',
                            'Penelitian dan Inovasi',
                            'Pendidikan',
                            'Seminar/Workshop',
                            'Liputan/Berita',
                        ] as $kat)
                            <option value="{{ $kat }}" {{ old('Kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    @error('Kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <p class="form-hint">Atau ketik kategori baru di kolom berikut:</p>
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

        {{-- Gambar --}}
        <div class="card">
            <div class="card-header"><h2>Gambar Utama</h2></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="gambar">Upload Gambar</label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        class="form-control {{ $errors->has('gambar') ? 'is-invalid' : '' }}"
                        accept="image/jpeg,image/png,image/webp"
                        onchange="previewImage(this)"
                    >
                    <div class="form-hint">JPG, PNG, WEBP. Maks 2MB.</div>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="preview-wrap" style="margin-top:0.875rem;display:none">
                        <img id="img-preview" class="img-preview" src="" alt="Preview">
                    </div>
                </div>
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
