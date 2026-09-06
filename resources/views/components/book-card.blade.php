<!-- Book Card Component -->
<div class="book-card card h-100 shadow-sm border-0 overflow-hidden">
    <!-- Book Cover Image with Badge -->
    <div class="book-cover position-relative overflow-hidden" style="height: 280px; background: #f5f1ed;">
        <img src="{{ $book->cover_image_url }}"
             alt="{{ $book->title }}" 
             class="card-img-top h-100 object-fit-cover" 
             loading="lazy"
             style="object-fit: cover;">
        
        <!-- Badge -->
        @if($badge)
            <span class="badge {{ $badge['class'] }} position-absolute top-2 start-2">
                {{ $badge['text'] }}
            </span>
        @endif
        
        <!-- Ranking Badge for Bestsellers -->
        @if($showRanking && $loop && $loop->iteration <= 3)
            <div class="position-absolute top-2 end-2 bg-danger rounded-circle d-flex align-items-center justify-content-center" 
                 style="width: 40px; height: 40px;">
                <span class="text-white fw-bold small">#{{ $loop->iteration }}</span>
            </div>
        @endif
        
        <!-- Overlay on Hover -->
        <div class="book-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
             style="background: rgba(0,0,0,0.7); opacity: 0; transition: opacity 0.3s ease;">
            <a href="#" class="btn btn-primary btn-sm">
                <i class="fas fa-eye me-2"></i>Lihat Detail
            </a>
        </div>
    </div>
    
    <!-- Card Body -->
    <div class="card-body d-flex flex-column">
        <!-- Title -->
        <h6 class="card-title fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif; line-height: 1.4;">
            {{ Str::limit($book->title, 50) }}
        </h6>
        
        <!-- Author -->
        <p class="card-text text-muted small mb-2">
            <i class="fas fa-pen me-1"></i>{{ $book->author }}
        </p>
        
        <!-- Category Badge -->
        <div class="mb-2">
            <span class="badge bg-light text-dark small">{{ $book->category }}</span>
        </div>
        
        <!-- Stats Row -->
        <div class="d-flex align-items-center gap-2 text-muted small mb-3">
<span title="Wishlist">
                            <i class="far fa-heart text-danger"></i> <span data-wishlist-count>{{ number_format($book->wishlist_count) }}</span>
                        </span>
            <span>•</span>
            <span title="Sold">
                <i class="fas fa-shopping-bag"></i> {{ number_format($book->sold_count) }}
            </span>
            <span>•</span>
            <span title="Dilihat">
                <i class="far fa-eye"></i> {{ number_format($book->view_count) }}
            </span>
        </div>
        
        <!-- Price -->
        <div class="mt-auto">
            <p class="card-text fw-bold text-primary mb-2">
                Rp {{ number_format($book->price, 0, ',', '.') }}
            </p>
            
            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                <a href="{{ route('books.buy', $book) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm flex-grow-1">
                    <i class="fas fa-shopping-cart me-1"></i>Beli
                </a>
                <a href="{{ route('books.wishlist', $book) }}" class="wishlist-btn btn btn-outline-danger btn-sm">
                        <i class="{{ in_array($book->id, session('wishlist', [])) ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>
                    </a>
            </div>
        </div>
    </div>
</div>

<style>
    .book-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
    }
    
    .book-card:hover .book-cover img {
        transform: scale(1.05);
    }
    
    .book-card:hover .book-overlay {
        opacity: 1 !important;
    }
    
    .book-cover img {
        transition: transform 0.3s ease;
    }
</style>
