@extends('layouts.app')

@section('title', 'Beranda - Interlude Penerbit Buku')

@section('content')

<!-- Hero Section -->
<section class="hero homepage-hero" data-reveal>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <p class="hero-kicker">Interlude Publishing House</p>
                <h1>Setiap Buku, Sebuah Jeda untuk Berpikir</h1>
                <p class="lead">
                    Jelajahi dunia penuh inspirasi, pengetahuan, dan cerita yang akan mengubah cara Anda memandang dunia.
                </p>
                <div class="d-flex gap-3">
                    <a href="#newest-books" class="btn btn-primary btn-lg hero-cta">
                        <i class="fas fa-book me-2"></i>Koleksi Terbaru
                    </a>
                    <a href="{{ route('search') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-search me-2"></i>Jelajahi Buku
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center hero-art">
                <div class="hero-orbit hero-orbit-one"></div>
                <div class="hero-orbit hero-orbit-two"></div>
                <div class="hero-book-frame">
                 <img src="{{ asset('images/CoverBook.jpg') }}?v={{ filemtime(public_path('images/CoverBook.jpg')) }}"
                     alt="Buku Unggulan" 
                     class="img-fluid rounded shadow" 
                     loading="lazy"
                     style="max-width: 100%;">
                 </div>
                 <span class="hero-caption">A new chapter awaits</span>
            </div>
        </div>
    </div>
</section>

<!-- Buku Terbaru Section -->
<section class="book-section animated-section" id="newest-books" data-reveal>
    <div class="container">
        <!-- Section Header -->
        <div class="section-header mb-5">
            <div>
                <h2 class="section-title">Buku Terbaru</h2>
                @if($searchTerm !== '')
                    <p class="text-muted mb-0">Hasil pencarian untuk: <strong>{{ $searchTerm }}</strong></p>
                @else
                    <p class="text-muted">Buku-buku terbaru dari Penerbit Interlude</p>
                @endif
            </div>
            <a href="{{ route('search') }}" class="see-all">
                Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

        <!-- Books Grid -->
        <div class="row g-4">
            @if($newBooks->count() > 0)
                @foreach($newBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 reveal-item" style="--reveal-delay: {{ $loop->index * 80 }}ms;">
                        @include('components.book-card', [
                            'book' => $book,
                            'badge' => ['class' => 'badge-new', 'text' => 'BARU'],
                            'showRanking' => false
                        ])
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada buku terbaru tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Buku Paling Laris Section -->
<section class="book-section animated-section" id="bestseller-books" data-reveal>
    <div class="container">
        <!-- Section Header -->
        <div class="section-header mb-5">
            <div>
                <h2 class="section-title">Buku Paling Laris</h2>
                @if($searchTerm !== '')
                    <p class="text-muted mb-0">Hasil pencarian untuk: <strong>{{ $searchTerm }}</strong></p>
                @else
                    <p class="text-muted">Koleksi buku terlaris yang paling dicari pembaca</p>
                @endif
            </div>
            <a href="{{ route('search') }}?collection=bestseller" class="see-all">
                Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

        <!-- Books Grid -->
        <div class="row g-4">
            @if($bestsellerBooks->count() > 0)
                @foreach($bestsellerBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 reveal-item" style="--reveal-delay: {{ $loop->index * 80 }}ms;">
                        @include('components.book-card', [
                            'book' => $book,
                            'badge' => ['class' => 'badge-bestseller', 'text' => 'BEST SELLER'],
                            'showRanking' => $loop->iteration <= 3 ? true : false
                        ])
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada buku best seller tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Buku Populer Section -->
<section class="book-section animated-section" id="popular-books" data-reveal>
    <div class="container">
        <!-- Section Header -->
        <div class="section-header mb-5">
            <div>
                <h2 class="section-title">Buku Populer</h2>
                <p class="text-muted">Pilihan buku favoritnya para pembaca</p>
            </div>
            <a href="{{ route('search') }}?collection=populer" class="see-all">
                Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

        <!-- Books Grid -->
        <div class="row g-4">
            @if($popularBooks->count() > 0)
                @foreach($popularBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 reveal-item" style="--reveal-delay: {{ $loop->index * 80 }}ms;">
                        @include('components.book-card', [
                            'book' => $book,
                            'badge' => ['class' => 'badge-popular', 'text' => 'POPULER'],
                            'showRanking' => false
                        ])
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada buku populer tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Buku Paling Banyak Dilihat Section -->
<section class="book-section animated-section" id="most-viewed-books" data-reveal>
    <div class="container">
        <!-- Section Header -->
        <div class="section-header mb-5">
            <div>
                <h2 class="section-title">Buku Paling Banyak Dilihat</h2>
                <p class="text-muted">Buku yang paling sering dilihat oleh pengunjung</p>
            </div>
            <a href="{{ route('search') }}?collection=most-viewed" class="see-all">
                Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

        <!-- Books Grid -->
        <div class="row g-4">
            @if($mostViewedBooks->count() > 0)
                @foreach($mostViewedBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 reveal-item" style="--reveal-delay: {{ $loop->index * 80 }}ms;">
                        @include('components.book-card', [
                            'book' => $book,
                            'badge' => null,
                            'showRanking' => false
                        ])
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada buku tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="social-section animated-section" id="social" data-reveal aria-labelledby="social-section-title">
    <div class="container">
        <div class="social-section-inner">
            <div class="social-brand">
                <img src="{{ asset('images/logo-teras-interlude.png') }}" alt="Logo Teras Interlude" loading="lazy">
            </div>
            <div class="social-links-panel">
                <div class="social-links-grid">
                    <a href="https://www.youtube.com/@terasinterlude227" target="_blank" rel="noopener noreferrer" aria-label="Kunjungi YouTube Teras Interlude">
                        <i class="fab fa-youtube" aria-hidden="true"></i>
                        <span>Youtube</span>
                    </a>
                    <a href="https://www.instagram.com/interludepenerbit/" target="_blank" rel="noopener noreferrer" aria-label="Kunjungi Instagram Interlude">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="https://wa.me/6282281572158" target="_blank" rel="noopener noreferrer" aria-label="Hubungi Interlude melalui WhatsApp">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        <span>WhatsApp</span>
                    </a>
                    <a href="https://www.tiktok.com/id-ID/" target="_blank" aria-label="Kunjungi TikTok Interlude">
                        <i class="fab fa-tiktok" aria-hidden="true"></i>
                        <span>TikTok</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    const revealItems = document.querySelectorAll('[data-reveal], .reveal-item');
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px' });

    revealItems.forEach((item) => revealObserver.observe(item));

    // Smooth scroll for links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

</script>
@endsection
