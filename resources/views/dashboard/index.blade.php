@extends('layouts.dashboard')

@section('title', 'Dashboard - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <section class="welcome-panel mb-4">
        <div><p class="eyebrow">{{ now()->format('l, d F Y') }}</p><h2>Welcome back, {{ $user->name }}</h2></div>
        <span class="welcome-icon"><i class="bi bi-stars" aria-hidden="true"></i></span>
    </section>

    <div class="row g-3 mb-4">
        @foreach($statistics as $stat)
        <div class="col-6 col-lg-4 col-xl-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi {{ $stat['icon'] }} fs-3 text-{{ $stat['color'] }}"></i></div>
                    <div class="fw-bold fs-5">{{ $stat['value'] }}</div>
                    <small class="text-muted">{{ $stat['label'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3"><i class="bi bi-heart-fill text-danger me-2"></i>Buku Paling Disukai</h3>
                    @if($popularBooks->isEmpty())
                        <p class="text-muted mb-0">Belum ada data.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead><tr><th>Judul</th><th class="text-end">Suka</th></tr></thead>
                                <tbody>
                                    @foreach($popularBooks as $book)
                                    <tr><td>{{ Str::limit($book->title, 30) }}</td><td class="text-end">{{ number_format($book->wishlist_count) }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3"><i class="bi bi-trophy-fill text-warning me-2"></i>Buku Terlaris</h3>
                    @if($bestsellerBooks->isEmpty())
                        <p class="text-muted mb-0">Belum ada data.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead><tr><th>Judul</th><th class="text-end">Terjual</th></tr></thead>
                                <tbody>
                                    @foreach($bestsellerBooks as $book)
                                    <tr><td>{{ Str::limit($book->title, 30) }}</td><td class="text-end">{{ number_format($book->sold_count) }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3"><i class="bi bi-eye-fill text-info me-2"></i>Buku Paling Banyak Dilihat</h3>
                    @if($mostViewedBooks->isEmpty())
                        <p class="text-muted mb-0">Belum ada data.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead><tr><th>Judul</th><th class="text-end">Dilihat</th></tr></thead>
                                <tbody>
                                    @foreach($mostViewedBooks as $book)
                                    <tr><td>{{ Str::limit($book->title, 30) }}</td><td class="text-end">{{ number_format($book->view_count) }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3"><i class="bi bi-folder-fill text-primary me-2"></i>Buku per Kategori</h3>
                    @if($categoryStats->isEmpty())
                        <p class="text-muted mb-0">Belum ada data.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead><tr><th>Kategori</th><th class="text-end">Jumlah</th></tr></thead>
                                <tbody>
                                    @foreach($categoryStats as $cat)
                                    <tr><td>{{ $cat->name }}</td><td class="text-end"><span class="badge text-bg-secondary">{{ $cat->books_count }}</span></td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3"><i class="bi bi-clock-history text-secondary me-2"></i>Buku Terbaru</h3>
                    @if($recentBooks->isEmpty())
                        <p class="text-muted mb-0">Belum ada data.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead><tr><th>Judul</th><th>Penulis</th><th>Kategori</th><th class="text-end">Harga</th><th class="text-end">Dibuat</th></tr></thead>
                                <tbody>
                                    @foreach($recentBooks as $book)
                                    <tr>
                                        <td>{{ Str::limit($book->title, 30) }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td><span class="badge text-bg-light">{{ $book->category }}</span></td>
                                        <td class="text-end">Rp {{ number_format((float) $book->price, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ $book->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
