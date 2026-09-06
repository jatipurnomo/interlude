@extends('layouts.app')

@section('title', 'Galeri YouTube - Interlude')

@section('content')
<section class="search-page" aria-labelledby="youtube-page-title">
    <div class="container">
        <div class="search-page-header">
            <div>
                <p class="hero-kicker mb-2">Teras Interlude</p>
                <h1 id="youtube-page-title" class="search-page-title">Galeri YouTube</h1>
                <p class="mb-0 text-muted">Video terbaru dari channel YouTube Teras Interlude</p>
            </div>
            <a href="https://www.youtube.com/@terasinterlude227/videos" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary">
                <i class="fab fa-youtube me-2"></i>Kunjungi Channel
            </a>
        </div>

        @if($videos->isNotEmpty())
            <div class="row g-4">
                @foreach($videos as $video)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden">
                            <div class="position-relative" style="padding-top: 56.25%;">
                                <iframe 
                                    class="position-absolute top-0 start-0 w-100 h-100" 
                                    src="{{ $video['embed_url'] }}" 
                                    title="{{ $video['title'] }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                    loading="lazy">
                                </iframe>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title fw-bold text-dark mb-2" style="font-family: 'Poppins', sans-serif; line-height: 1.4;">
                                    {{ Str::limit($video['title'], 60) }}
                                </h6>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-calendar me-1" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($video['published_at'])->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="search-empty">
                <i class="fab fa-youtube fa-2x text-muted mb-3" aria-hidden="true"></i>
                <h2 class="h4">Belum ada video</h2>
                <p class="text-muted mb-0">Video YouTube akan segera tersedia.</p>
            </div>
        @endif
    </div>
</section>
@endsection
