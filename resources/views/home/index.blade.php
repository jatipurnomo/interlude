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
                        <i class="fas fa-search me-2"></i>Jelajahi Koleksi
                    </a>
                    <a href="#popular-books" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center hero-art">
                <div class="hero-orbit hero-orbit-one"></div>
                <div class="hero-orbit hero-orbit-two"></div>
                <div class="hero-book-frame">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=700&q=85"
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
                <h2 class="section-title">Koleksi Terbaru</h2>
                <p class="text-muted">Temukan buku-buku terbaru dari penerbit Interlude</p>
            </div>
            <a href="#" class="see-all">
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
                    <p class="text-muted">Belum ada buku baru tersedia.</p>
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
                <p class="text-muted">Pilihan buku yang paling diminati pembaca</p>
            </div>
            <a href="#" class="see-all">
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

<!-- Buku Paling Laris Section -->
<section class="book-section animated-section" id="bestseller-books" data-reveal>
    <div class="container">
        <!-- Section Header -->
        <div class="section-header mb-5">
            <div>
                <h2 class="section-title">Buku Paling Laris</h2>
                <p class="text-muted">Koleksi buku terlaris yang paling dicari pembaca</p>
            </div>
            <a href="#" class="see-all">
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

<!-- CTA Section -->
<section class="homepage-cta py-5" data-reveal>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="mb-3">Jangan Lewatkan Update Terbaru!</h3>
                <p class="text-muted mb-4">
                    Dapatkan notifikasi langsung tentang buku-buku terbaru, penawaran khusus, dan acara penerbit Interlude.
                </p>
                <form class="d-flex gap-2 justify-content-center flex-wrap">
                    <input type="email" class="form-control form-control-lg" placeholder="Masukkan email Anda" style="max-width: 300px;" required>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Subscribe
                    </button>
                </form>
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
