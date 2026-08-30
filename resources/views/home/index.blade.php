@extends('layouts.app')

@section('title', 'Beranda - Interlude Penerbit Buku')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 hero-content">
                <h1>Setiap Buku, Sebuah Jeda untuk Berpikir</h1>
                <p class="lead">
                    Jelajahi dunia penuh inspirasi, pengetahuan, dan cerita yang akan mengubah cara Anda memandang dunia.
                </p>
                <div class="d-flex gap-3">
                    <a href="#newest-books" class="btn btn-primary btn-lg">
                        <i class="fas fa-search me-2"></i>Jelajahi Koleksi
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <img src="https://via.placeholder.com/300x400?text=Featured+Book" 
                     alt="Buku Unggulan" 
                     class="img-fluid rounded shadow" 
                     loading="lazy"
                     style="max-width: 100%;">
            </div>
        </div>
    </div>
</section>

<!-- Buku Terbaru Section -->
<section class="book-section" id="newest-books">
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
                    <div class="col-lg-3 col-md-4 col-sm-6">
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
<section class="book-section" id="popular-books">
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
                    <div class="col-lg-3 col-md-4 col-sm-6">
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
<section class="book-section" id="bestseller-books">
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
                    <div class="col-lg-3 col-md-4 col-sm-6">
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
<section class="py-5" style="background: linear-gradient(135deg, #f5f1ed 0%, #e8dfd5 100%);">
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
    // Lazy loading for images
    document.addEventListener('DOMContentLoaded', function() {
        // Modern browsers support loading="lazy" natively
        // For older browsers, you can add a library like Lazysizes
    });

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

    // Book card hover effect
    document.querySelectorAll('.book-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>
@endsection
