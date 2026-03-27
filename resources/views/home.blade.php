
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PIMTANAS 5 - Universitas Muhammadiyah Banjarmasin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />

</head>

<body>
    @include('headerfooter.navbar');
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <header class="hero-section">
        <div class="static-background">
            <svg width="100%" height="100%" viewBox="0 0 1920 1080" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"></svg>
        </div>

        <canvas id="particle-canvas"></canvas>

        <img class="hero-mascot" id="mascot-image" src="maskot/1.png" alt="Maskot PIMTANAS 5">

        <nav class="navbar">
            <a href="#" class="navbar-brand">
                <img class="logo" src="assets/logo/umbjm.png" alt="Logo UMBJM">
                <img class="logo" src="assets/logo/pimtanas.png" alt="Logo PIMTANAS 5">
            </a>

            <div class="navbar-right-side">
                <div class="hamburger" id="hamburger-menu">
                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>
                </div>
                <ul class="nav-links" id="nav-links">
                    <li class="dropdown"><a href="#">Informasi <i class="bi bi-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="tentang_pimtanas.php">TENTANG PIMTANAS</a></li>
                            <li><a href="kegiatan.php">KEGIATAN</a></li>
                            <li><a href="persyaratan_umum.php">PERSYARATAN</a></li>
                            <li><a href="ketentuan_pelaksanaan.php">KETENTUAN PELAKSANAAN</a></li>
                            <li><a href="faq.php">FAQ</a></li>
                        </ul>
                    </li>
                    <li><a href="selayang_pandang.php">Selayang Pandang UMB</a></li>
                    <li class="dropdown"><a href="#">Unduhan <i class="bi bi-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#logo-pimtanas">LOGO PIMTANAS</a></li>
                            <li><a href="#buku-panduan">BUKU PANDUAN</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#">Update <i class="bi bi-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="berita/berita.php">BERITA PIMTANAS</a></li>
                            <li><a href="/jadwal/jadwal.php">JADWAL PIMTANAS</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="btn btn-primary">Daftar <i class="bi bi-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="form_pendaftaran.php">Pendaftaran</a></li>
                            <li><a href="">Upload Berkas</a></li>
                        </ul>
                    </li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
        <div class="hero-content">
            <h1>PEKAN ILMIAH MAHASISWA PERGURUAN TINGGI</h1>
            <h1>MUHAMMADIYAH & AISYIYAH TINGKAT NASIONAL</h1>
            <h2>PIMTANAS 5</h2>
            <p class="hero-theme">"Karya Nyata Mahasiswa PTMA: Inovasi, Kolaborasi, dan Kontribusi untuk Negeri"</p>
            <div class="hero-buttons">
                <a href="#panduan" class="btn btn-secondary">Unduh Buku Panduan</a>
            </div>
        </div>
    </header>

    <script src="assets/js/animation.js"></script>
    @include('headerfooter.footer');
</body>

</html>
