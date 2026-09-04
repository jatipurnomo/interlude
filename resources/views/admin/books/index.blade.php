@extends('layouts.dashboard')

@section('title', 'Master Data Buku - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div><p class="eyebrow mb-1">Content management</p><h2 class="mb-0">Master Data Buku</h2></div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Buku</a>
    </div>
    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <section class="dashboard-panel">
        <form method="GET" action="{{ route('admin.books.index') }}" class="row g-2 mb-4">
            <div class="col-md-8"><label class="visually-hidden" for="search">Cari buku</label><input id="search" name="search" value="{{ $search }}" class="form-control" placeholder="Cari judul, penulis, kategori, atau ISBN"></div>
            <div class="col-auto"><button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search me-1"></i>Cari</button></div>
            @if ($search)<div class="col-auto"><a class="btn btn-light" href="{{ route('admin.books.index') }}">Reset</a></div>@endif
        </form>
        @if ($books->isEmpty())
            <div class="text-center py-5"><i class="bi bi-journal-bookmark display-5 text-muted"></i><h3 class="h5 mt-3">Belum ada buku</h3><p class="text-muted">Tambahkan buku pertama ke katalog Interlude.</p></div>
        @else
            <div class="table-responsive"><table class="table align-middle mb-0">
                <thead><tr><th>Book</th><th>Category</th><th>Price</th><th>Collections</th><th>Stats</th><th class="text-end">Action</th></tr></thead>
                <tbody>@foreach ($books as $book)<tr>
                    <td><div class="d-flex align-items-center gap-3"><img src="{{ $book->cover_image_url ?: 'https://via.placeholder.com/48x68?text=Book' }}" alt="{{ $book->title }}" width="48" height="68" class="rounded object-fit-cover"><div><strong>{{ $book->title }}</strong><small class="d-block text-muted">{{ $book->author }}</small></div></div></td>
                    <td>{{ $book->category }}</td><td>Rp {{ number_format((float) $book->price, 0, ',', '.') }}</td>
                    <td><div class="d-flex flex-wrap gap-1">@if($book->is_new)<span class="badge text-bg-success">Baru</span>@endif @if($book->is_popular)<span class="badge text-bg-info">Populer</span>@endif @if($book->is_bestseller)<span class="badge text-bg-warning">Bestseller</span>@endif</div></td>
                    <td><small class="d-block">{{ number_format($book->sold_count) }} sold</small><small class="text-muted">{{ number_format($book->wishlist_count) }} wishlist</small></td>
                    <td class="text-end"><div class="d-inline-flex gap-1"><a href="{{ route('admin.books.show', $book) }}" class="btn btn-sm btn-light" aria-label="Lihat {{ $book->title }}"><i class="bi bi-eye"></i></a><a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-light" aria-label="Edit {{ $book->title }}"><i class="bi bi-pencil"></i></a><form method="POST" action="{{ route('admin.books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit" aria-label="Hapus {{ $book->title }}"><i class="bi bi-trash"></i></button></form></div></td>
                </tr>@endforeach</tbody>
            </table></div>
            <div class="mt-4">{{ $books->links() }}</div>
        @endif
    </section>
</div>
@endsection
