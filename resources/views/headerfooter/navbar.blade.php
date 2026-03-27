{{-- resources/views/headerfooter/navbar.blade.php --}}
{{-- Cara pakai di halaman lain: @include('headerfooter.navbar') --}}

<nav class="navbar-main">
    <div class="navbar-container">

        {{-- Logo & Nama Organisasi --}}
        <a href="{{ url('/') }}" class="navbar-brand">
            <div class="navbar-logo">
                <img src="{{ asset('images/ptma.png') }}" alt="Logo PTMA" height="60">
            </div>

        </a>

        {{-- Tombol Hamburger (Mobile) --}}
        <button class="navbar-toggle" id="navbarToggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- Menu Navigasi Tengah --}}
        <ul class="navbar-menu" id="navbarMenu">
            <li class="nav-item {{ Request::is('/') || Request::is('berita*') ? 'active' : '' }}">
                <a href="{{ url('/') }}" class="nav-link">BERITA</a>
            </li>
            <li class="nav-item {{ Request::is('informasi-layanan*') ? 'active' : '' }}">
                <a href="{{ url('/informasi-layanan') }}" class="nav-link">INFORMASI LAYANAN</a>
            </li>
            <li class="nav-item {{ Request::is('selayang-pandang*') ? 'active' : '' }}">
                <a href="{{ url('/selayang-pandang') }}" class="nav-link">SELAYANG PANDANG</a>
            </li>
            <li class="nav-item {{ Request::is('tentang*') ? 'active' : '' }}">
                <a href="{{ url('/tentang') }}" class="nav-link">TENTANG</a>
            </li>
        </ul>

        {{-- Kanan: Pilihan Bahasa & Search --}}
        <div class="navbar-right">
            {{-- Bendera Indonesia --}}
            <button class="lang-btn active" title="Bahasa Indonesia" onclick="setLang('id')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20" width="28" height="19">
                    <rect width="30" height="10" fill="#CE1126"/>
                    <rect y="10" width="30" height="10" fill="white"/>
                </svg>
            </button>

            {{-- Bendera Inggris --}}
            <button class="lang-btn" title="English" onclick="setLang('en')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 30" width="28" height="19">
                    <clipPath id="uk">
                        <path d="M0,0 v30 h60 v-30 z"/>
                    </clipPath>
                    <path d="M0,0 v30 h60 v-30 z" fill="#012169"/>
                    <path d="M0,0 L60,30 M60,0 L0,30" stroke="white" stroke-width="6"/>
                    <path d="M0,0 L60,30 M60,0 L0,30" stroke="#C8102E" stroke-width="4"/>
                    <path d="M30,0 v30 M0,15 h60" stroke="white" stroke-width="10"/>
                    <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6"/>
                </svg>
            </button>

            {{-- Tombol Search --}}
            <button class="search-btn" id="searchToggle" title="Cari">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"/>
                    <line x1="16.5" y1="16.5" x2="22" y2="22"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Search Bar (muncul saat ikon search diklik) --}}
    <div class="search-bar" id="searchBar">
        <div class="search-bar-inner">
            <input type="text" placeholder="Cari berita, informasi layanan..." id="searchInput"/>
            <button class="search-submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"/>
                    <line x1="16.5" y1="16.5" x2="22" y2="22"/>
                </svg>
            </button>
        </div>
    </div>
</nav>

{{-- ===================== CSS ===================== --}}
<style>
    /* Import Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .navbar-main {
        background: linear-gradient(90deg, #0d3b7a 0%, #1565c0 60%, #1976d2 100%);
        font-family: 'Barlow', sans-serif;
        box-shadow: 0 2px 12px rgba(0,0,0,0.25);
        position: sticky;
        top: 0;
        z-index: 1000;
        border-bottom: 3px solid #C9A35B;
    }

    .navbar-container {
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        padding: 0 20px;
        height: 62px;
        gap: 16px;
    }

    /* ---- Brand / Logo ---- */
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        flex-shrink: 0;
    }

    .navbar-logo {
        display: flex;
        align-items: center;
        filter: drop-shadow(0 1px 3px rgba(0,0,0,0.3));
    }

    .navbar-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
    }

    .brand-top {
        color: white;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .brand-bottom {
        color: #f9c74f;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Pemisah vertikal */
    .navbar-brand::after {
        content: '';
        display: block;
        width: 1px;
        height: 36px;
        background: rgba(255,255,255,0.3);
        margin-left: 14px;
    }

    /* ---- Menu Navigasi ---- */

    .navbar-menu {
        display: flex;
        list-style: none;
    flex: 1;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 0;
}
    .nav-item {
         display: flex;
         align-items: center;
    }

    .nav-link {
         display: flex;
    align-items: center;
    justify-content: center;
    height: 62px; /* samakan dengan navbar */
    padding: 0 16px;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.8px;
    transition: 0.2s;
    }

    .nav-link:hover {
        background: rgba(255,255,255,0.15);
        color: white;
    }

    .nav-item.active .nav-link {
        color: #f9c74f;
    }

    .nav-item.active .nav-link::after {
        content: '';
        display: block;
        width: 100%;
        height: 2px;
        background: #f9c74f;
        border-radius: 2px;
        margin-top: 2px;
    }

    /* ---- Kanan: Bahasa + Search ---- */
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .lang-btn {
        background: none;
        border: 2px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        padding: 2px;
        display: flex;
        align-items: center;
        transition: border-color 0.2s, transform 0.2s;
        opacity: 0.6;
    }

    .lang-btn:hover,
    .lang-btn.active {
        border-color: rgba(255,255,255,0.7);
        opacity: 1;
        transform: scale(1.05);
    }

    .search-btn {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
    }

    .search-btn:hover {
        background: rgba(255,255,255,0.25);
        transform: scale(1.08);
    }

    /* ---- Search Bar ---- */
    .search-bar {
        display: none;
        background: #0d3b7a;
        border-top: 1px solid rgba(255,255,255,0.15);
        padding: 10px 20px;
    }

    .search-bar.open {
        display: block;
        animation: slideDown 0.2s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .search-bar-inner {
        max-width: 600px;
        margin: 0 auto;
        display: flex;
        gap: 8px;
    }

    .search-bar-inner input {
        flex: 1;
        padding: 9px 16px;
        border-radius: 6px;
        border: none;
        font-size: 14px;
        font-family: 'Barlow', sans-serif;
        outline: none;
        background: white;
        color: #1a1a2e;
    }

    .search-submit {
        background: #e53935;
        border: none;
        border-radius: 6px;
        padding: 0 16px;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background 0.2s;
    }

    .search-submit:hover {
        background: #b71c1c;
    }

    /* ---- Hamburger (Mobile) ---- */
    .navbar-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        margin-left: auto;
    }

    .navbar-toggle span {
        display: block;
        width: 24px;
        height: 2px;
        background: white;
        border-radius: 2px;
        transition: all 0.3s;
    }

    /* ---- Responsive Mobile ---- */
    @media (max-width: 900px) {
        .navbar-toggle {
            display: flex;
        }

        .navbar-menu {
            display: none;
            position: absolute;
            top: 65px;
            left: 0;
            right: 0;
            background: #0d3b7a;
            flex-direction: column;
            padding: 12px 0;
            gap: 0;
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }

        .navbar-menu.open {
            display: flex;
        }

        .nav-link {
            padding: 12px 24px;
            border-radius: 0;
            font-size: 14px;
        }

        .navbar-container {
            position: relative;
        }

        .navbar-brand::after {
            display: none;
        }
    }
</style>

{{-- ===================== JavaScript ===================== --}}
<script>
    // Toggle menu hamburger (mobile)
    const toggle = document.getElementById('navbarToggle');
    const menu   = document.getElementById('navbarMenu');

    toggle.addEventListener('click', () => {
        menu.classList.toggle('open');
    });

    // Toggle search bar
    const searchToggle = document.getElementById('searchToggle');
    const searchBar    = document.getElementById('searchBar');
    const searchInput  = document.getElementById('searchInput');

    searchToggle.addEventListener('click', () => {
        searchBar.classList.toggle('open');
        if (searchBar.classList.contains('open')) {
            searchInput.focus();
        }
    });

    // Enter untuk submit search
    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            const keyword = searchInput.value.trim();
            if (keyword) {
                window.location.href = '/search?q=' + encodeURIComponent(keyword);
            }
        }
    });

    // Fungsi ganti bahasa (bisa disambungkan ke logic i18n)
    function setLang(lang) {
        document.querySelectorAll('.lang-btn').forEach(btn => btn.classList.remove('active'));
        event.currentTarget.classList.add('active');
        // Contoh: simpan preferensi bahasa ke localStorage
        localStorage.setItem('lang', lang);
        // Tambahkan logika redirect / translasi di sini jika diperlukan
        console.log('Bahasa dipilih:', lang);
    }
</script>
