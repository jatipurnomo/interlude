@extends('layouts.app')

@section('title', $book->title . ' - Interlude')

@section('content')
<section class="book-detail-page" aria-labelledby="book-detail-title">
    <div class="container">
        <nav class="book-detail-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('search') }}">Katalog</a>
            <span aria-hidden="true">/</span>
            <span class="text-muted">{{ Str::limit($book->title, 40) }}</span>
        </nav>

        <div class="book-detail-card">
            <div class="book-detail-cover">
                <img src="{{ $book->cover_image_url }}" alt="Sampul {{ $book->title }}" loading="lazy">
            </div>
            <div class="book-detail-info">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @if($book->is_new)<span class="badge badge-new">BARU</span>@endif
                    @if($book->is_popular)<span class="badge badge-popular">POPULER</span>@endif
                    @if($book->is_bestseller)<span class="badge badge-bestseller">BEST SELLER</span>@endif
                </div>

                <h1 id="book-detail-title" class="book-detail-title">{{ $book->title }}</h1>
                <p class="book-detail-author">
                    <i class="fas fa-pen me-2" aria-hidden="true"></i>{{ $book->author }}
                </p>
                <p class="book-detail-category">
                    <i class="fas fa-layer-group me-2" aria-hidden="true"></i>{{ $book->category }}
                </p>

                <dl class="book-detail-meta">
                    <div class="book-detail-meta-row">
                        <dt>Harga</dt>
                        <dd class="book-detail-price">Rp {{ number_format($book->price, 0, ',', '.') }}</dd>
                    </div>
                    <div class="book-detail-meta-row">
                        <dt>ISBN</dt>
                        <dd>{{ $book->isbn ?: 'Belum tersedia' }}</dd>
                    </div>
                    <div class="book-detail-meta-row">
                        <dt>ISBN</dt>
                        <dd>{{ $book->isbn ?: 'Belum tersedia' }}</dd>
                    </div>
                    <div class="book-detail-meta-row">
                        <dt>Terbit</dt>
                        <dd>{{ $book->published_at?->format('d M Y') ?: 'Belum tersedia' }}</dd>
                    </div>
                    <div class="book-detail-meta-row">
                        <dt>Terjual</dt>
                        <dd>{{ number_format($book->sold_count) }}</dd>
                    </div>
                    <div class="book-detail-meta-row">
                        <dt>Wishlist</dt>
                        <dd data-wishlist-count>{{ number_format($book->wishlist_count) }}</dd>
                    </div>
                </dl>

                @php($wished = in_array($book->id, session('wishlist', [])))
                <div class="book-detail-actions">
                    <a href="{{ route('books.buy', $book) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2" aria-hidden="true"></i>Beli Sekarang
                    </a>
                    <a href="{{ route('books.wishlist', $book) }}" class="wishlist-btn btn {{ $wished ? 'btn-danger' : 'btn-outline-danger' }} btn-lg">
                        <i class="{{ $wished ? 'fas' : 'far' }} fa-heart me-2" aria-hidden="true"></i>Wishlist
                    </a>
                </div>
            </div>
        </div>

        <div class="book-detail-description">
            <h2 class="book-detail-section-title">Deskripsi Buku</h2>
            <p class="mb-0">{{ $book->description ?: 'Deskripsi buku belum tersedia.' }}</p>
        </div>
    </div>
</section>
@endsection