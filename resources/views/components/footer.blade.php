<!-- Footer -->
<footer class="bg-dark text-light pt-5 pb-3">
    <div class="container">
        <div class="row mb-4">
            <!-- About Section -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h6 class="fw-bold">Terus Lumaku Tansah Lelaku</h6>
                <p class="text-muted small">
                    Interlude merupakan ruang penerbitan alternatif yang mengusung semangat kebersamaan untuk bersama - sama belajar di Dunia Buku. Dengan semangat bertani buku dalam upaya <i>Ajar Nandur Wiji Keli</i>
                </p>
            </div>
            
            <!-- Navigation Links -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h6 class="fw-bold mb-3">Menu</h6>
                <ul class="list-unstyled">
                    <li><a href="#social" class="text-muted text-decoration-none hover-link">Tentang Kami</a></li>
                    <li><a href="{{ route('search') }}" class="text-muted text-decoration-none hover-link">Katalog</a></li>
                    <li><a href="{{ route('blog') }}" class="text-muted text-decoration-none hover-link">Blog</a></li>
                    <li><a href="#" class="text-muted text-decoration-none hover-link">FAQ</a></li>
                </ul>
            </div>
            
            <!-- Legal Links -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h6 class="fw-bold mb-3">Kebijakan</h6>
                <ul class="list-unstyled">
                    <li><a href="" class="text-muted text-decoration-none hover-link">Kebijakan Privasi</a></li>
                    <li><a href="" class="text-muted text-decoration-none hover-link">Syarat & Ketentuan</a></li>
                    <li><a href="" class="text-muted text-decoration-none hover-link">Kebijakan Pengembalian</a></li>
                    <li><a href="" class="text-muted text-decoration-none hover-link">Pengiriman & Pajak</a></li>
                </ul>
            </div>
            
            <!-- Contact & Social -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled text-muted small">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <a href="https://maps.app.goo.gl/PMMqoWgq9nKuPus79" target="_blank" class="text-muted text-decoration-none">Sumber Kulon, Kalitirto, Kec. Berbah, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55573</a>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <a href="mailto:interludepenerbit@gmail.com" class="text-muted text-decoration-none">interludepenerbit@gmail.com</a>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <a href="tel:+62822-8157-2158" class="text-muted text-decoration-none">(+62)822-8157-2158</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Divider -->
        <hr class="bg-secondary-subtle">
        
        <!-- Copyright -->
        <div class="row">
            <div class="col-md-8 mb-3">
                <p class="text-muted small mb-0">
                    &copy; {{ date('Y') }} Copyright Penerbit Buku Interlude.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="#" class="btn btn-sm btn-link text-muted text-decoration-none">
                    <i class="fas fa-arrow-up me-2"></i>Kembali ke Atas
                </a>
            </div>
        </div>
    </div>
</footer>
