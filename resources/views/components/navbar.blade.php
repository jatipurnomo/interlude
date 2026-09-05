@php
    $logoUrl = asset('images/logo_interlude.png') . '?v=' . filemtime(public_path('images/logo_interlude.png'));
@endphp

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <!-- Brand/Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ $logoUrl }}" alt="Interlude" class="navbar-logo">
        </a>
        
        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navbar Content -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="navbarOffcanvasLabel">
                    <img src="{{ $logoUrl }}" alt="Interlude" class="navbar-logo navbar-logo-mobile">
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
                        <a class="nav-link" href="#social">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
                
                <!-- Search Bar & Icons -->
                <div class="d-flex align-items-center ms-lg-3 flex-column flex-lg-row gap-2">
                    <!-- Search Bar -->
                    <form action="{{ route('search') }}" method="GET" class="input-group input-group-sm flex-grow-1" role="search">
                        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari buku..." aria-label="Cari buku">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>