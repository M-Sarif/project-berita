<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin PTMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-dark:  #0d2b6e;
            --blue:       #1a4ab5;
            --blue-mid:   #2457c5;
            --blue-light: #e8effe;
            --accent:     #f97316;
            --accent-bg:  #fff4ed;
            --white:      #ffffff;
            --bg:         #f4f6fb;
            --sidebar-w:  260px;
            --gray-50:    #f8fafc;
            --gray-100:   #f1f5f9;
            --gray-200:   #e2e8f0;
            --gray-400:   #94a3b8;
            --gray-500:   #64748b;
            --gray-600:   #475569;
            --gray-700:   #334155;
            --gray-800:   #1e293b;
            --success:    #22c55e;
            --warning:    #f59e0b;
            --danger:     #ef4444;
        }

        html, body { height: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--gray-800);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ──────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--blue-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-icon svg { width: 22px; height: 22px; fill: white; }

        .sidebar-brand .brand-text h2 {
            font-size: 0.9375rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }

        .sidebar-brand .brand-text p {
            font-size: 0.6875rem;
            color: rgba(255,255,255,0.45);
            margin-top: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1.25rem 0.75rem;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 0.625rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.3);
            padding: 0 0.75rem;
            margin: 1rem 0 0.5rem;
        }

        .nav-section-label:first-child { margin-top: 0; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.875rem;
            border-radius: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
            margin-bottom: 2px;
        }

        .nav-item svg {
            width: 18px; height: 18px;
            flex-shrink: 0;
            opacity: 0.7;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.9);
        }

        .nav-item:hover svg { opacity: 1; }

        .nav-item.active {
            background: var(--blue);
            color: white;
        }

        .nav-item.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.875rem;
        }

        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--blue-mid);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.875rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .user-details h4 {
            font-size: 0.8125rem;
            font-weight: 600;
            color: white;
            line-height: 1.2;
        }

        .user-details p {
            font-size: 0.6875rem;
            color: rgba(255,255,255,0.4);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.625rem;
            background: rgba(239,68,68,0.15);
            color: #fca5a5;
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
        }

        .btn-logout:hover { background: rgba(239,68,68,0.25); }

        .btn-logout svg { width: 15px; height: 15px; }

        /* ── MAIN CONTENT ─────────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-left h1 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        .topbar-left .breadcrumb {
            font-size: 0.75rem;
            color: var(--gray-400);
            margin-top: 1px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .badge-date {
            font-size: 0.75rem;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
        }

        .page-content {
            flex: 1;
            padding: 1.75rem;
        }

        /* ── FLASH MESSAGES ───────────────────────── */
        .flash {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }

        .flash svg { width: 18px; height: 18px; flex-shrink: 0; }

        .flash-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .flash-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ── CARDS ────────────────────────────────── */
        .card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .card-header h2 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        .card-body { padding: 1.5rem; }

        /* ── BUTTONS ──────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.125rem;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: opacity 0.2s, transform 0.1s;
        }

        .btn:active { transform: scale(0.97); }
        .btn svg { width: 16px; height: 16px; }

        .btn-primary { background: var(--blue-dark); color: white; }
        .btn-primary:hover { opacity: 0.88; }

        .btn-secondary { background: var(--gray-100); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-200); }

        .btn-danger { background: #fef2f2; color: var(--danger); border: 1px solid #fecaca; }
        .btn-danger:hover { background: #fee2e2; }

        .btn-sm { padding: 0.375rem 0.75rem; font-size: 0.8125rem; }

        /* ── TABLE ────────────────────────────────── */
        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        thead tr { background: var(--gray-50); }

        th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            white-space: nowrap;
            border-bottom: 1px solid var(--gray-200);
        }

        td {
            padding: 1rem;
            font-size: 0.875rem;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--gray-50); }

        /* ── BADGES ───────────────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.625rem;
            border-radius: 999px;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-publish { background: #dcfce7; color: #166534; }
        .badge-draft   { background: #f1f5f9; color: #475569; }

        /* ── FORM ─────────────────────────────────── */
        .form-group { margin-bottom: 1.375rem; }

        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
        }

        .form-label span.required { color: var(--danger); margin-left: 2px; }

        .form-control {
            width: 100%;
            padding: 0.6875rem 0.875rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9375rem;
            color: var(--gray-800);
            background: var(--gray-50);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--blue);
            background: white;
            box-shadow: 0 0 0 3px rgba(26,74,181,0.1);
        }

        .form-control.is-invalid { border-color: var(--danger); }

        textarea.form-control { resize: vertical; min-height: 200px; line-height: 1.6; }

        select.form-control { cursor: pointer; }

        .form-hint { font-size: 0.75rem; color: var(--gray-400); margin-top: 0.375rem; }

        .invalid-feedback { font-size: 0.75rem; color: var(--danger); margin-top: 0.375rem; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }

        /* ── STAT CARDS ───────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg { width: 22px; height: 22px; }

        .stat-info h3 { font-size: 1.5rem; font-weight: 800; color: var(--gray-800); }
        .stat-info p  { font-size: 0.8125rem; color: var(--gray-400); margin-top: 1px; }

        /* ── PAGINATION ───────────────────────────── */
        .pagination-wrap {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--gray-100);
        }

        .pagination-wrap .pagination { display: flex; gap: 0.25rem; flex-wrap: wrap; }

        .pagination-wrap .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px; height: 34px;
            padding: 0 0.5rem;
            border-radius: 8px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--gray-600);
            text-decoration: none;
            background: var(--gray-100);
            border: none;
            transition: background 0.15s, color 0.15s;
        }

        .pagination-wrap .page-item.active .page-link {
            background: var(--blue-dark);
            color: white;
        }

        .pagination-wrap .page-item .page-link:hover {
            background: var(--gray-200);
        }

        .pagination-wrap .page-item.disabled .page-link {
            opacity: 0.4;
            pointer-events: none;
        }

        /* ── IMAGE PREVIEW ────────────────────────── */
        .img-preview-wrap {
            position: relative;
            display: inline-block;
        }

        .img-preview {
            width: 100%;
            max-width: 320px;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--gray-200);
            display: block;
        }

        .img-thumb {
            width: 56px; height: 40px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--gray-200);
        }

        /* ── FILTER BAR ───────────────────────────── */
        .filter-bar {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 0;
        }

        .filter-bar .form-control {
            width: auto;
            min-width: 160px;
            padding: 0.5rem 0.875rem;
        }

        /* ── RESPONSIVE ───────────────────────────── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <div class="brand-text">
            <h2>Puspresma PTMA</h2>
            <p>Panel Administrator</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <div class="nav-section-label">Konten</div>

        <a href="{{ route('admin.berita.index') }}"
           class="nav-item {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            Berita
        </a>

        {{-- Tambahkan menu lain di sini nanti --}}
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="user-details">
                <h4>{{ Auth::user()->name }}</h4>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="main-wrap">
    <header class="topbar">
        <div class="topbar-left">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <div class="breadcrumb">@yield('breadcrumb', 'Admin / Dashboard')</div>
        </div>
        <div class="topbar-right">
            <span class="badge-date">{{ now()->isoFormat('D MMMM YYYY') }}</span>
        </div>
    </header>

    <div class="page-content">
        {{-- Flash messages --}}
        @if (session('success'))
            <div class="flash flash-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flash flash-error">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
