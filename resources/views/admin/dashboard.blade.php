@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Admin / Dashboard')

@section('content')

@php
    $totalBerita  = \App\Models\Berita::count();
    $published    = \App\Models\Berita::where('status','publish')->count();
    $draft        = \App\Models\Berita::where('status','draft')->count();
    $totalView    = \App\Models\Berita::sum('view');
    $latestBerita = \App\Models\Berita::orderBy('tanggal_publish','desc')->limit(5)->get();
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
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Views</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestBerita as $b)
                <tr>
                    <td style="max-width:280px">
                        <a href="{{ route('admin.berita.edit', $b->id_berita) }}"
                           style="color:var(--blue-dark);font-weight:600;text-decoration:none;">
                            {{ Str::limit($b->Judul, 60) }}
                        </a>
                        <div style="font-size:0.75rem;color:var(--gray-400);margin-top:2px">
                            {{ $b->author }}
                        </div>
                    </td>
                    <td><span style="font-size:0.8125rem">{{ $b->Kategori }}</span></td>
                    <td>
                        <span class="badge {{ $b->status === 'publish' ? 'badge-publish' : 'badge-draft' }}">
                            {{ $b->status }}
                        </span>
                    </td>
                    <td style="font-size:0.8125rem;color:var(--gray-500)">
                        {{ $b->tanggal_publish ? $b->tanggal_publish->format('d M Y') : '-' }}
                    </td>
                    <td style="font-size:0.875rem">{{ number_format($b->view) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:var(--gray-400);padding:2rem">
                        Belum ada berita.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
