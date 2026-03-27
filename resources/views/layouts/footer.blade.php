{{-- resources/views/headerfooter/footer.blade.php --}}
<footer class="footer-main">
    <div class="footer-container">

        {{-- Kolom 1 --}}
        <div class="footer-col footer-brand">
            <div class="footer-logo-wrap">
                <img src="{{ asset('images/ptma.png') }}" alt="Logo PTMA" height="80">

            </div>
            <p class="footer-desc">
                Pusat Prestasi Mahasiswa<br>
                Perguran Tinggi Muhammadiyah & Aisyiyah
            </p>
        </div>

        {{-- Kolom 2 --}}
        <div class="footer-col">
            <h4 class="footer-heading">NAVIGASI CEPAT</h4>
            <ul class="footer-links">
                <li><a href="{{ url('/') }}">Berita</a></li>
                <li><a href="{{ url('/informasi-layanan') }}">Informasi Layanan</a></li>
                <li><a href="{{ url('/selayang-pandang') }}">Selayang Pandang</a></li>
                <li><a href="{{ url('/tentang') }}">Tentang Kami</a></li>
            </ul>
        </div>

        {{-- Kolom 3 --}}
        <div class="footer-col">
            <h4 class="footer-heading">Hubungi Kami</h4>
            <ul class="footer-contact">
                <li>
                    📍 <span>Kantor Pusat<br>Yogyakarta</span>
                </li>
                <li>
                    📞 <span>0857 827** ****</span>
                </li>
                <li>
                    ✉️ <span>info@puspresma.com</span>
                </li>
            </ul>
        </div>

        {{-- Kolom 4 --}}
        <div class="footer-col">
            <h4 class="footer-heading">Ikuti Kami</h4>
            <ul class="footer-social">
                <li><a href="#">Instagram</a></li>
                <li><a href="#">YouTube</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="mailto:info@puspresma.com">Email</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} Puspresma PTMA</p>
    </div>
</footer>

<style>
@import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap');

.footer-main {
    background: linear-gradient(90deg, #0d3b7a 0%, #1565c0 60%, #1976d2 100%);
    font-family: 'Barlow', sans-serif;
    color: white;
    padding-top: 12px;
    padding-bottom: 6px;
    border-top: 2px solid #f9c74f;
}

/* Container */
.footer-container {
    max-width: 1200px;
    margin: auto;
    padding: 0 16px 32x;
    display: grid;
    grid-template-columns: 1.3fr 1fr 1.2fr 1.2fr;
    gap: 16px;
}

/* Brand */
.footer-logo-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
}

.footer-brand-top {
    font-size: 14px;
    font-weight: 700;
}

.footer-brand-bottom {
    font-size: 12px;
    font-weight: 700;
    color: #f9c74f;
}

.footer-desc {
    font-size: 14px;
    font-weight: bold;
    color: rgba(255,255,255,0.75);
    line-height: 1.5;
}

/* Heading */
.footer-heading {
    font-size: 12px;
    font-weight: 700;
    color: #f9c74f;
    margin-bottom: 8px;
}

/* Links */
.footer-links,
.footer-contact,
.footer-social {
    list-style: none;
    padding: 0;
}

.footer-links li,
.footer-social li {
    margin-bottom: 6px;
}

.footer-links a,
.footer-social a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-size: 12.5px;
    transition: 0.2s;
}

.footer-links a:hover,
.footer-social a:hover {
    color: #f9c74f;
}

/* Contact */
.footer-contact li {
    font-size: 12px;
    margin-bottom: 6px;
}

/* Bottom */
.footer-bottom {
    text-align: center;
     padding: 0 1px 10x;
    font-size: 11.5px;
    color: rgba(255,255,255,0.6);
    border-top: 1px solid rgba(255,255,255,0.2);
}

/* Responsive */
@media (max-width: 900px) {
    .footer-container {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 500px) {
    .footer-container {
        grid-template-columns: 1fr;
    }
}
</style>
