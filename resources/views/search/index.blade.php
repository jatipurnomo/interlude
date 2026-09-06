@extends('layouts.app')

@section('title', 'Hasil Pencarian - Interlude')

@section('content')
<section class="search-page" aria-labelledby="search-page-title">
    <div class="container">
        <div class="search-page-header">
            <div>
                <p class="hero-kicker mb-2">Katalog Interlude</p>
                <h1 id="search-page-title" class="search-page-title">
                    @if($searchTerm !== '')
                        Hasil Pencarian
                    @elseif($collection === 'bestseller')
                        Buku Bestseller
                    @elseif($collection === 'populer')
                        Buku Populer
                    @else
                        Semua Buku
                    @endif
                </h1>
                @if($searchTerm !== '')
                    <p class="mb-0 text-muted">Menampilkan hasil untuk <span class="search-page-query">"{{ $searchTerm }}"</span></p>
                @elseif($collection === 'bestseller')
                    <p class="mb-0 text-muted">Menampilkan semua buku berlabel Bestseller</p>
                @elseif($collection === 'populer')
                    <p class="mb-0 text-muted">Menampilkan semua buku berlabel Populer</p>
                @else
                    <p class="mb-0 text-muted">Jelajahi koleksi Buku - Buku Interlude!</p>
                @endif
            </div>
            <span class="text-muted small">{{ $books->total() }} buku ditemukan</span>
        </div>

        @if($books->count() > 0)
            <div class="row g-4">
                @foreach($books as $book)
                    <div class="col-12">
                        <article class="search-result-card">
                            @php
                                $coverImageUrl = $book->cover_image_url;
                            @endphp
                            <button type="button" class="search-result-cover search-result-cover-button" data-bs-toggle="modal" data-bs-target="#bookImageModal" data-image="{{ $coverImageUrl }}" data-title="{{ $book->title }}" data-author="{{ $book->author }}" aria-label="Perbesar sampul {{ $book->title }}">
                                <img src="{{ $coverImageUrl }}" alt="Sampul {{ $book->title }}" loading="lazy">
                                <span class="search-result-cover-hint"><i class="fas fa-expand" aria-hidden="true"></i></span>
                            </button>
                            <div class="search-result-content">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    @if($book->is_popular)
                                        <span class="badge badge-popular">POPULER</span>
                                    @endif
                                    @if($book->is_bestseller)
                                        <span class="badge badge-bestseller">BEST SELLER</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-1">
                                    <h2 class="search-result-title mb-0">
                                        <a href="{{ route('books.show', $book) }}" class="search-result-title-link">{{ $book->title }}</a>
                                    </h2>
                                    <span class="search-result-price text-nowrap">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                </div>
                                <p class="search-result-author mb-0">
                                    <i class="fas fa-pen me-2" aria-hidden="true"></i>{{ $book->author }}
                                </p>
                                <p class="mb-0 mt-2 text-muted">
                                    <i class="fas fa-layer-group me-2" aria-hidden="true"></i>{{ $book->category }}
                                </p>
                                <p class="search-result-description">{{ $book->description ?: 'Deskripsi buku belum tersedia.' }}</p>
                                <div class="search-result-meta">
                                    <span><strong>ISBN:</strong> {{ $book->isbn ?: 'Belum tersedia' }}</span>
                                    <span><strong>Terbit:</strong> {{ $book->published_at?->format('d M Y') ?: 'Belum tersedia' }}</span>
                                    <span><i class="fas fa-shopping-bag me-1" aria-hidden="true"></i>{{ number_format($book->sold_count) }} terjual</span>
                                    <span><i class="far fa-heart me-1" aria-hidden="true"></i>{{ number_format($book->wishlist_count) }} suka</span>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-2" aria-hidden="true"></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            @if($books->hasPages())
                <div class="search-pagination mt-5 d-flex justify-content-center" aria-label="Navigasi halaman hasil pencarian">
                    {{ $books->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="search-empty">
                <i class="fas fa-book-open fa-2x text-muted mb-3" aria-hidden="true"></i>
                <h2 class="h4">Buku tidak ditemukan</h2>
                <p class="text-muted mb-0">Coba gunakan judul, nama penulis, atau kategori lain.</p>
            </div>
        @endif
    </div>
</section>

<div class="modal fade" id="bookImageModal" tabindex="-1" aria-labelledby="bookImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl search-image-modal-dialog">
        <div class="modal-content search-image-modal">
            <div class="modal-header">
                <h2 class="modal-title h5" id="bookImageModalLabel">Sampul Buku</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="bookImageModalPreview" class="search-image-modal-preview" src="" alt="">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const bookImageModal = document.getElementById('bookImageModal');

    bookImageModal?.addEventListener('show.bs.modal', (event) => {
        const trigger = event.relatedTarget;
        const preview = document.getElementById('bookImageModalPreview');
        const title = document.getElementById('bookImageModalLabel');

        preview.src = trigger.dataset.image;
        preview.alt = `Sampul ${trigger.dataset.title}`;
        title.textContent = `${trigger.dataset.title} - ${trigger.dataset.author}`;
    });
</script>
@endsection
