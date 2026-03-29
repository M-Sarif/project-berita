@extends('admin.layout')

@section('title', 'Manajemen Berita')
@section('page-title', 'Manajemen Berita')
@section('breadcrumb', 'Admin / Berita')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="filter-bar">
            <form method="GET" action="{{ route('admin.berita.index') }}" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:center">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul berita..."
                    class="form-control"
                    style="width:220px"
                >
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="publish" {{ request('status') === 'publish' ? 'selected' : '' }}>Publish</option>
                    <option value="draft"   {{ request('status') === 'draft'   ? 'selected' : '' }}>Draft</option>
                </select>
                <select name="kategori" class="form-control">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $k)
                        <option value="{{ $k }}" {{ request('kategori') === $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-secondary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Filter
                </button>
                @if (request()->hasAny(['search','status','kategori']))
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-sm">Reset</a>
                @endif
            </form>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Berita
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    <th style="width:60px">Foto</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th style="text-align:center">HL</th>
                    <th>Tanggal</th>
                    <th>Views</th>
                    <th style="width:100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($berita as $index => $b)
                <tr>
                    <td style="color:var(--gray-400);font-size:0.8125rem">
                        {{ ($berita->currentPage()-1) * $berita->perPage() + $index + 1 }}
                    </td>
                    <td>
                        @if ($b->gambar)
                            <img src="{{ Storage::url($b->gambar) }}" alt="{{ $b->Judul }}" class="img-thumb">
                        @else
                            <div style="width:56px;height:40px;background:var(--gray-100);border-radius:6px;display:flex;align-items:center;justify-content:center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="var(--gray-400)" stroke-width="1.5" style="width:18px;height:18px">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td style="max-width:250px">
                        <div style="font-weight:600;color:var(--gray-800)">{{ Str::limit($b->Judul, 55) }}</div>
                        <div style="font-size:0.75rem;color:var(--gray-400);margin-top:2px">{{ Str::limit($b->Konten, 60) }}</div>
                    </td>
                    <td>
                        <span style="font-size:0.8125rem;background:var(--blue-light);color:var(--blue-dark);padding:0.2rem 0.6rem;border-radius:6px;font-weight:600">
                            {{ $b->Kategori }}
                        </span>
                    </td>
                    <td style="font-size:0.8125rem">{{ $b->author }}</td>
                    <td>
                        <span class="badge {{ $b->status === 'publish' ? 'badge-publish' : 'badge-draft' }}">
                            {{ $b->status }}
                        </span>
                    </td>

                    {{-- Kolom Headline --}}
                    <td style="text-align:center">
                        @if ($b->is_headline)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#eab308" viewBox="0 0 24 24" stroke="#eab308" stroke-width="1.5" style="width:18px;height:18px" title="Headline">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @else
                            <span style="color:var(--gray-300);font-size:0.75rem">—</span>
                        @endif
                    </td>

                    <td style="font-size:0.8125rem;color:var(--gray-500);white-space:nowrap">
                        {{ $b->tanggal_publish ? $b->tanggal_publish->format('d M Y') : '-' }}
                    </td>
                    <td style="font-size:0.875rem">{{ number_format($b->view) }}</td>
                    <td>
                        <div style="display:flex;gap:0.4rem;align-items:center">
                            <a href="{{ route('admin.berita.edit', $b) }}"
                               class="btn btn-secondary btn-sm"
                               title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST"
                                  action="{{ route('admin.berita.destroy', $b) }}"
                                  onsubmit="return confirm('Hapus berita ini?')"
                                  style="margin:0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align:center;color:var(--gray-400);padding:3rem">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width:40px;height:40px;display:block;margin:0 auto 0.75rem">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Belum ada berita ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($berita->hasPages())
    <div class="pagination-wrap">
        {{ $berita->links() }}
    </div>
    @endif
</div>

@endsection
