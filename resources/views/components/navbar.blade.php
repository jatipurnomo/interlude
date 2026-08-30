<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
    <div class="container">
        <!-- Brand/Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="fas fa-book me-2 text-primary"></i>Interlude
        </a>
        
        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navbar Content -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="navbarOffcanvasLabel">
                    <i class="fas fa-book me-2 text-primary"></i>Interlude
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body">
                <!-- Navigation Links -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeri">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
                
                <!-- Search Bar & Icons -->
                <div class="d-flex align-items-center ms-lg-3 flex-column flex-lg-row gap-2">
                    <!-- Search Bar -->
                    <div class="input-group input-group-sm flex-grow-1">
                        <input type="text" class="form-control" placeholder="Cari buku..." aria-label="Cari buku">
                        <button class="btn btn-outline-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <!-- Wishlist Icon -->
                    <a href="#" class="btn btn-light btn-sm" title="Wishlist">
                        <i class="far fa-heart"></i>
                    </a>
                    
                    <!-- Cart Icon -->
                    <a href="#" class="btn btn-light btn-sm position-relative" title="Keranjang">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
                    </a>
                    
                    <!-- Login/Register -->
                    <a href="#" class="btn btn-primary btn-sm">Login</a>
                </div>
            </div>
        </div>
    </div>
</nav>
