@extends('layouts.app')

@section('title', 'Berita - Puspresma PTMA')

@section('styles')
<style>
    :root {
        --primary: #1a3a6b;
        --accent: #e8860a;
        --light-bg: #f5f7fa;
        --border: #e2e8f0;
        --text-muted: #6b7280;
        --text-dark: #1a202c;
        --card-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }

    * { box-sizing: border-box; }

    body {
        font-family: 'Segoe UI', sans-serif;
        color: var(--text-dark);
        background: #fff;
    }

    /* ===== HERO SLIDER ===== */
    .hero-slider {
        position: relative;
        height: 480px;
        overflow: hidden;
        background: #1a1a2e;
    }

    .hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.7s ease;
    }

    .hero-slide.active { opacity: 1; }

    .hero-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.55;
    }

    .hero-slide-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1a3a6b 0%, #2d5fa6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px 40px;
        background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, transparent 100%);
    }

    .hero-badge {
        display: inline-block;
        background: var(--accent);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 3px 10px;
        border-radius: 3px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .hero-title {
        color: #fff;
        font-size: 26px;
        font-weight: 700;
        line-height: 1.35;
        max-width: 620px;
        margin: 0 0 10px;
    }

    .hero-meta {
        color: rgba(255,255,255,0.75);
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .hero-meta i { font-size: 12px; }

    /* Slider dots */
    .hero-dots {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .hero-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
    }

    .hero-dot.active {
        background: var(--accent);
        transform: scale(1.3);
    }

    /* ===== SECTION HEADERS ===== */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        border-bottom: 2px solid var(--primary);
        padding-bottom: 10px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        position: relative;
    }

    .section-title::before {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--accent);
    }

    .section-link {
        font-size: 13px;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s;
    }

    .section-link:hover { color: var(--accent); }

    /* ===== MAIN CONTAINER ===== */
    .main-container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ===== BERITA TERBARU ===== */
    .berita-section { padding: 40px 0 30px; }

    /* Featured post (large horizontal card) */
    .featured-card {
        display: flex;
        gap: 24px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 24px;
        box-shadow: var(--card-shadow);
        transition: box-shadow 0.2s;
        text-decoration: none;
        color: inherit;
    }

    .featured-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.12); }

    .featured-img {
        width: 280px;
        min-height: 180px;
        flex-shrink: 0;
        overflow: hidden;
        background: var(--light-bg);
    }

    .featured-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }

    .featured-card:hover .featured-img img { transform: scale(1.04); }

    .featured-img-placeholder {
        width: 100%;
        height: 100%;
        min-height: 180px;
        background: linear-gradient(135deg, #dbe4f0, #c3d3e8);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .featured-img-placeholder i {
        font-size: 40px;
        color: #8fa8c8;
    }

    .featured-body {
        padding: 20px 20px 20px 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .card-kategori {
        font-size: 11px;
        font-weight: 700;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .card-date {
        font-size: 12px;
        color: var(--text-muted);
        margin-left: 8px;
    }

    .featured-title {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.4;
        margin: 0 0 10px;
        color: var(--text-dark);
    }

    .featured-excerpt {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Grid cards */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 16px;
    }

    .news-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        text-decoration: none;
        color: inherit;
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }

    .news-card-img {
        position: relative;
        height: 160px;
        overflow: hidden;
        background: var(--light-bg);
    }

    .news-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }

    .news-card:hover .news-card-img img { transform: scale(1.05); }

    .news-card-img-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #dbe4f0, #c3d3e8);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .news-card-img-placeholder i {
        font-size: 32px;
        color: #8fa8c8;
    }

    .view-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 3px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .news-card-body {
        padding: 14px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .news-card-title {
        font-size: 14px;
        font-weight: 700;
        line-height: 1.45;
        margin: 0 0 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-card-excerpt {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.55;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Small list cards */
    .small-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .small-card {
        display: flex;
        gap: 12px;
        text-decoration: none;
        color: inherit;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid var(--border);
        transition: background 0.2s, box-shadow 0.2s;
    }

    .small-card:hover {
        background: var(--light-bg);
        box-shadow: var(--card-shadow);
    }

    .small-card-img {
        width: 80px;
        height: 60px;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
        background: var(--light-bg);
    }

    .small-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .small-card-img-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #dbe4f0, #c3d3e8);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .small-card-img-placeholder i {
        font-size: 18px;
        color: #8fa8c8;
    }

    .small-card-title {
        font-size: 12px;
        font-weight: 600;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .small-card-meta {
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* ===== KATEGORI ===== */
    .kategori-section {
        background: var(--light-bg);
        padding: 40px 0;
        margin: 10px 0;
    }

    .kategori-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .kategori-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 18px 20px;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .kategori-card:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(26,58,107,0.12);
    }

    .kategori-name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .kategori-count {
        font-size: 12px;
        color: var(--text-muted);
    }

    .kategori-arrow {
        color: var(--text-muted);
        font-size: 14px;
        transition: color 0.2s, transform 0.2s;
    }

    .kategori-card:hover .kategori-arrow {
        color: var(--primary);
        transform: translateX(3px);
    }

    /* ===== VIDEO ===== */
    .video-section { padding: 40px 0; }

    .video-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    /* Video featured left */
    .video-featured {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        background: #111;
        text-decoration: none;
        display: block;
    }

    .video-featured img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        opacity: 0.75;
        transition: opacity 0.3s;
    }

    .video-featured:hover img { opacity: 0.9; }

    .video-featured-placeholder {
        width: 100%;
        height: 280px;
        background: linear-gradient(135deg, #1a3a6b, #2d5fa6);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-play-btn {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-play-btn span {
        width: 56px;
        height: 56px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--primary);
        transition: transform 0.2s, background 0.2s;
    }

    .video-featured:hover .video-play-btn span {
        transform: scale(1.1);
        background: #fff;
    }

    .video-featured-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 16px;
        background: linear-gradient(to top, rgba(0,0,0,0.75), transparent);
    }

    .video-badge {
        display: inline-block;
        background: #e53e3e;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 3px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .video-featured-title {
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.35;
        margin: 0 0 4px;
    }

    .video-featured-meta {
        color: rgba(255,255,255,0.7);
        font-size: 12px;
    }

    /* Video list right */
    .video-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .video-list-item {
        display: flex;
        gap: 14px;
        text-decoration: none;
        color: inherit;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid var(--border);
        transition: background 0.2s, box-shadow 0.2s;
    }

    .video-list-item:hover {
        background: var(--light-bg);
        box-shadow: var(--card-shadow);
    }

    .video-thumb {
        position: relative;
        width: 120px;
        height: 72px;
        flex-shrink: 0;
        border-radius: 4px;
        overflow: hidden;
        background: #ddd;
    }

    .video-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-thumb-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1a3a6b, #4a7fd4);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-thumb-placeholder i {
        font-size: 20px;
        color: rgba(255,255,255,0.7);
    }

    .video-thumb-play {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-thumb-play span {
        width: 26px;
        height: 26px;
        background: rgba(255,255,255,0.85);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: var(--primary);
    }

    .video-info { flex: 1; }

    .video-list-meta {
        font-size: 11px;
        color: var(--accent);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .video-list-title {
        font-size: 13px;
        font-weight: 700;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 4px;
    }

    .video-list-desc {
        font-size: 11px;
        color: var(--text-muted);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 40px;
        display: block;
        margin-bottom: 12px;
        color: #c9d8e8;
    }

    .empty-state p {
        font-size: 14px;
        margin: 0;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .cards-grid, .small-cards-grid { grid-template-columns: repeat(2, 1fr); }
        .kategori-grid { grid-template-columns: repeat(2, 1fr); }
        .video-grid { grid-template-columns: 1fr; }
        .hero-title { font-size: 20px; }
        .featured-card { flex-direction: column; }
        .featured-img { width: 100%; height: 200px; }
    }

    @media (max-width: 600px) {
        .cards-grid { grid-template-columns: 1fr; }
        .small-cards-grid { grid-template-columns: 1fr; }
        .kategori-grid { grid-template-columns: 1fr; }
        .hero-slider { height: 320px; }
        .hero-title { font-size: 17px; }
        .hero-content { padding: 16px 20px; }
    }
</style>
@endsection

@section('content')

{{-- ========== HERO SLIDER ========== --}}
<section class="hero-slider" id="heroSlider">

    @if($heroBerita->count() > 0)
        @foreach($heroBerita as $index => $b)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
            @if($b->gambar && file_exists(public_path('storage/' . $b->gambar)))
                <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->Judul }}">
            @else
                <div class="hero-slide-placeholder"></div>
            @endif
            <div class="hero-content">
                <span class="hero-badge">{{ $b->Kategori }}</span>
                <h2 class="hero-title">{{ $b->Judul }}</h2>
                <div class="hero-meta">
                    <i>📅</i>
                    {{ \Carbon\Carbon::parse($b->tanggal_publish)->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>
        @endforeach

        {{-- Dots --}}
        <div class="hero-dots">
            @foreach($heroBerita as $index => $b)
            <div class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
            @endforeach
        </div>
    @else
        {{-- Placeholder saat tidak ada data --}}
        <div class="hero-slide active">
            <div class="hero-slide-placeholder"></div>
            <div class="hero-content">
                <span class="hero-badge">Headline</span>
                <h2 class="hero-title">Selamat Datang di Puspresma PTMA</h2>
                <div class="hero-meta">
                    <i>📅</i> Belum ada berita
                </div>
            </div>
        </div>
    @endif

</section>

{{-- ========== BERITA TERBARU ========== --}}
<section class="berita-section">
    <div class="main-container">

        <div class="section-header">
            <h2 class="section-title">Berita Terbaru</h2>
            <a href="#" class="section-link">Lihat Semua &rarr;</a>
        </div>

        @if($beritaTerbaru->count() > 0)

            {{-- Featured card (berita pertama) --}}
            @php $featured = $beritaTerbaru->first(); @endphp
            <a href="#" class="featured-card">
                <div class="featured-img">
                    @if($featured->gambar && file_exists(public_path('storage/' . $featured->gambar)))
                        <img src="{{ asset('storage/' . $featured->gambar) }}" alt="{{ $featured->Judul }}">
                    @else
                        <div class="featured-img-placeholder"><i>🖼️</i></div>
                    @endif
                </div>
                <div class="featured-body">
                    <div>
                        <span class="card-kategori">{{ $featured->Kategori }}</span>
                        <span class="card-date">{{ \Carbon\Carbon::parse($featured->tanggal_publish)->format('d M Y') }}</span>
                    </div>
                    <h3 class="featured-title">{{ $featured->Judul }}</h3>
                    <p class="featured-excerpt">{{ Str::limit(strip_tags($featured->Konten), 180) }}</p>
                </div>
            </a>

            {{-- Grid 3 kolom (berita ke 2-4) --}}
            @php $gridBerita = $beritaTerbaru->slice(1, 3); @endphp
            @if($gridBerita->count() > 0)
            <div class="cards-grid">
                @foreach($gridBerita as $b)
                <a href="#" class="news-card">
                    <div class="news-card-img">
                        @if($b->gambar && file_exists(public_path('storage/' . $b->gambar)))
                            <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->Judul }}">
                        @else
                            <div class="news-card-img-placeholder"><i>🖼️</i></div>
                        @endif
                        <span class="view-badge">👁 {{ number_format($b->view) }}</span>
                    </div>
                    <div class="news-card-body">
                        <div>
                            <span class="card-kategori">{{ $b->Kategori }}</span>
                            <span class="card-date">{{ \Carbon\Carbon::parse($b->tanggal_publish)->format('d M Y') }}</span>
                        </div>
                        <h4 class="news-card-title">{{ $b->Judul }}</h4>
                        <p class="news-card-excerpt">{{ Str::limit(strip_tags($b->Konten), 100) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

            {{-- Small list cards (berita ke 5-10) --}}
            @php $smallBerita = $beritaTerbaru->slice(4, 6); @endphp
            @if($smallBerita->count() > 0)
            <div class="small-cards-grid" style="margin-top:16px;">
                @foreach($smallBerita as $b)
                <a href="#" class="small-card">
                    <div class="small-card-img">
                        @if($b->gambar && file_exists(public_path('storage/' . $b->gambar)))
                            <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->Judul }}">
                        @else
                            <div class="small-card-img-placeholder"><i>🖼️</i></div>
                        @endif
                    </div>
                    <div>
                        <p class="small-card-title">{{ $b->Judul }}</p>
                        <p class="small-card-meta">
                            <span style="color:var(--accent);font-weight:700;">{{ $b->Kategori }}</span>
                            &middot; {{ \Carbon\Carbon::parse($b->tanggal_publish)->format('d M Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

        @else
            <div class="empty-state">
                <i>📰</i>
                <p>Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif

    </div>
</section>

{{-- ========== KATEGORI ========== --}}
<section class="kategori-section">
    <div class="main-container">

        <div class="section-header">
            <h2 class="section-title">Kategori</h2>
        </div>

        @php
            $kategoriList = [
                'Beasiswa', 'Prestasi', 'Penelitian dan Inovasi',
                'Pendidikan', 'Seminar/Workshop', 'Liputan/Berita'
            ];
        @endphp

        <div class="kategori-grid">
            @foreach($kategoriList as $kat)
            @php
                $jumlah = isset($kategoriCount[$kat]) ? $kategoriCount[$kat] : 0;
            @endphp
            <a href="#" class="kategori-card">
                <div>
                    <p class="kategori-name">{{ $kat }}</p>
                    <p class="kategori-count">{{ $jumlah }} Artikel Total</p>
                </div>
                <span class="kategori-arrow">›</span>
            </a>
            @endforeach
        </div>

    </div>
</section>

{{-- ========== VIDEO ========== --}}
<section class="video-section">
    <div class="main-container">

        <div class="section-header">
            <h2 class="section-title">Video</h2>
            <a href="#" class="section-link">Lihat Semua &rarr;</a>
        </div>

        @if($videos->count() > 0)
        <div class="video-grid">

            {{-- Video featured kiri --}}
            @php $featuredVideo = $videos->first(); @endphp
            <a href="{{ $featuredVideo->link_video ?? '#' }}" class="video-featured" target="_blank" rel="noopener">
                @if($featuredVideo->thumbnail && file_exists(public_path('storage/' . $featuredVideo->thumbnail)))
                    <img src="{{ asset('storage/' . $featuredVideo->thumbnail) }}" alt="{{ $featuredVideo->Judul }}">
                @else
                    <div class="video-featured-placeholder">
                        <i style="font-size:60px;color:rgba(255,255,255,0.3);">▶</i>
                    </div>
                @endif
                <div class="video-play-btn">
                    <span>▶</span>
                </div>
                <div class="video-featured-info">
                    <span class="video-badge">Video</span>
                    <p class="video-featured-title">{{ $featuredVideo->Judul }}</p>
                    <p class="video-featured-meta">
                        {{ \Carbon\Carbon::parse($featuredVideo->tanggal_publish)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </a>

            {{-- Video list kanan --}}
            <div class="video-list">
                @foreach($videos->slice(1, 3) as $v)
                <a href="{{ $v->link_video ?? '#' }}" class="video-list-item" target="_blank" rel="noopener">
                    <div class="video-thumb">
                        @if($v->thumbnail && file_exists(public_path('storage/' . $v->thumbnail)))
                            <img src="{{ asset('storage/' . $v->thumbnail) }}" alt="{{ $v->Judul }}">
                        @else
                            <div class="video-thumb-placeholder"><i>▶</i></div>
                        @endif
                        <div class="video-thumb-play"><span>▶</span></div>
                    </div>
                    <div class="video-info">
                        <p class="video-list-meta">{{ \Carbon\Carbon::parse($v->tanggal_publish)->format('d M Y') }}</p>
                        <p class="video-list-title">{{ $v->Judul }}</p>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
        @else
            <div class="empty-state">
                <i>🎬</i>
                <p>Belum ada video yang tersedia.</p>
            </div>
        @endif

    </div>
</section>

@endsection

@section('scripts')
<script>
    // Simple auto slider
    (function() {
        const slider = document.getElementById('heroSlider');
        if (!slider) return;

        const slides = slider.querySelectorAll('.hero-slide');
        const dots = slider.querySelectorAll('.hero-dot');
        if (slides.length <= 1) return;

        let current = 0;

        function goTo(index) {
            slides[current].classList.remove('active');
            dots[current] && dots[current].classList.remove('active');
            current = index;
            slides[current].classList.add('active');
            dots[current] && dots[current].classList.add('active');
        }

        // Dot click
        dots.forEach(function(dot, i) {
            dot.addEventListener('click', function() { goTo(i); });
        });

        // Auto play 5 detik
        setInterval(function() {
            goTo((current + 1) % slides.length);
        }, 5000);
    })();
</script>
@endsection
