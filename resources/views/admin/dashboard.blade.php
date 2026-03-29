@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Admin / Dashboard')

@section('content')

@php
    $totalBerita   = \App\Models\Berita::count();
    $published     = \App\Models\Berita::where('status','publish')->count();
    $draft         = \App\Models\Berita::where('status','draft')->count();
    $totalView     = \App\Models\Berita::sum('view');
    $totalHeadline = \App\Models\Berita::where('is_headline', 1)->count();
    $latestBerita  = \App\Models\Berita::orderBy('tanggal_publish','desc')->limit(5)->get();
@endphp

{{-- Stat Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background:#eff6ff">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3b82f6" stroke-width="2">
                <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $totalBerita }}</h3>
            <p>Total Berita</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:#f0fdf4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#22c55e" stroke-width="2">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $published }}</h3>
            <p>Dipublikasikan</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:#f8fafc">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="2">
                <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $draft }}</h3>
            <p>Draft</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:#fefce8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#eab308" stroke-width="2">
                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $totalHeadline }}</h3>
            <p>Headline</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:#fff7ed">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#f97316" stroke-width="2">
                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ number_format($totalView) }}</h3>
            <p>Total Views</p>
        </div>
    </div>
</div>

{{-- Latest News --}}
<div class="card">
    <div class="card-header">
        <h2>Berita Terbaru</h2>
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
                    <th style="width:64px">Foto</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Views</th>
                    <th style="text-align:center;width:90px">Headline</th>
                    <th style="width:110px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestBerita as $b)
                <tr>

                    {{-- Thumbnail --}}
                    <td>
                        @if ($b->gambar)
                            <img
                                src="{{ Storage::url($b->gambar) }}"
                                alt="{{ $b->Judul }}"
                                style="width:56px;height:40px;object-fit:cover;border-radius:6px;display:block"
                            >
                        @else
                            <div style="width:56px;height:40px;background:var(--gray-100);border-radius:6px;display:flex;align-items:center;justify-content:center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="var(--gray-400)" stroke-width="1.5" style="width:18px;height:18px">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </td>

                    {{-- Judul --}}
                    <td style="max-width:220px">
                        <a href="{{ route('admin.berita.edit', $b) }}"
                           style="color:var(--blue-dark);font-weight:600;text-decoration:none">
                            {{ Str::limit($b->Judul, 50) }}
                        </a>
                        <div style="font-size:0.75rem;color:var(--gray-400);margin-top:2px">
                            {{ $b->author }}
                        </div>
                    </td>

                    <td style="font-size:0.8125rem">{{ $b->Kategori }}</td>

                    <td>
                        <span class="badge {{ $b->status === 'publish' ? 'badge-publish' : 'badge-draft' }}">
                            {{ $b->status }}
                        </span>
                    </td>

                    <td style="font-size:0.8125rem;color:var(--gray-500);white-space:nowrap">
                        {{ $b->tanggal_publish ? $b->tanggal_publish->format('d M Y') : '-' }}
                    </td>

                    <td style="font-size:0.875rem">{{ number_format($b->view) }}</td>

                    {{-- Toggle Headline --}}
                    <td style="text-align:center">
                        <form method="POST"
                              action="{{ route('admin.berita.headline', $b) }}"
                              style="margin:0;display:inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    title="{{ $b->is_headline ? 'Copot dari Headline' : 'Jadikan Headline' }}"
                                    style="
                                        border:none;cursor:pointer;
                                        background:{{ $b->is_headline ? '#fef9c3' : '#f1f5f9' }};
                                        color:{{ $b->is_headline ? '#a16207' : '#94a3b8' }};
                                        border-radius:6px;padding:0.3rem 0.6rem;
                                        font-size:0.8rem;font-weight:600;
                                        display:inline-flex;align-items:center;gap:0.3rem;
                                    ">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="{{ $b->is_headline ? 'currentColor' : 'none' }}"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                     style="width:14px;height:14px">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                {{ $b->is_headline ? 'Headline' : 'Set' }}
                            </button>
                        </form>
                    </td>

                    {{-- Aksi: Edit & Hapus --}}
                    <td>
                        <div style="display:flex;gap:0.4rem;align-items:center">

                            {{-- Edit --}}
                            <a href="{{ route('admin.berita.edit', $b) }}"
                               class="btn btn-secondary btn-sm"
                               title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            {{-- Hapus --}}
                            <form method="POST"
                                  action="{{ route('admin.berita.destroy', $b) }}"
                                  onsubmit="return confirm('Hapus berita \'{{ addslashes($b->Judul) }}\'?')"
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
                    <td colspan="8" style="text-align:center;color:var(--gray-400);padding:2rem">
                        Belum ada berita.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
