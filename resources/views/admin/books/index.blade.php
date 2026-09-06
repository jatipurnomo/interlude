@extends('layouts.dashboard')

@section('title', 'Master Data Buku - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div><p class="eyebrow mb-1">Content management</p><h2 class="mb-0">Master Data Buku</h2></div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Buku</a>
    </div>
    @if (session('success'))<div class="alert alert-success alert-fade">{{ session('success') }}</div>@endif
    <section class="dashboard-panel">
        <form method="GET" action="{{ route('admin.books.index') }}" class="row g-2 mb-4">
            <div class="col-12 col-md-3">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $selectedCategory === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3">
                <select name="collection" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Koleksi</option>
                    <option value="popular" {{ $selectedCollection === 'popular' ? 'selected' : '' }}>Populer</option>
                    <option value="bestseller" {{ $selectedCollection === 'bestseller' ? 'selected' : '' }}>Bestseller</option>
                </select>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="input-group">
                    <input name="search" value="{{ $search }}" class="form-control" placeholder="Cari judul, penulis, atau ISBN">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </div>
            @if ($search || $selectedCategory || $selectedCollection)
                <div class="col-12 col-md-auto"><a class="btn btn-light w-100" href="{{ route('admin.books.index') }}">Reset</a></div>
            @endif
        </form>
        @if ($books->isEmpty())
            <div class="text-center py-5"><i class="bi bi-journal-bookmark display-5 text-muted"></i><h3 class="h5 mt-3">Belum ada buku</h3><p class="text-muted">Tambahkan buku pertama ke katalog Interlude.</p></div>
        @else
            <div class="table-responsive"><table class="table align-middle mb-0">
                <thead><tr><th class="text-center">Buku</th><th class="text-center">Kategori</th><th class="text-center">Harga</th><th class="text-center">Koleksi</th><th class="text-center">Statistik</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>@foreach ($books as $book)<tr>
                    <td><div class="d-flex align-items-center gap-3"><img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" width="48" height="68" class="rounded object-fit-cover"><div><strong>{{ $book->title }}</strong><small class="d-block text-muted">{{ $book->author }}</small></div></div></td>
                    <td>{{ $book->category }}</td><td>Rp {{ number_format((float) $book->price, 0, ',', '.') }}</td>
                    <td><div class="d-flex flex-wrap gap-1">@if($book->is_popular)<span class="badge text-bg-info">Populer</span>@endif @if($book->is_bestseller)<span class="badge text-bg-warning">Bestseller</span>@endif</div></td>
                    <td><small class="d-block"><i class="bi bi-cart-check me-1"></i>{{ number_format($book->sold_count) }} terjual</small><small class="d-block text-muted"><i class="bi bi-heart me-1"></i>{{ number_format($book->wishlist_count) }} suka</small><small class="text-muted"><i class="bi bi-eye me-1"></i>{{ number_format($book->view_count) }} dilihat</small></td>
                    <td class="text-end"><div class="d-inline-flex gap-1"><a href="{{ route('admin.books.show', $book) }}" class="btn btn-sm btn-light" aria-label="Lihat {{ $book->title }}"><i class="bi bi-eye"></i></a><a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-light" aria-label="Edit {{ $book->title }}"><i class="bi bi-pencil"></i></a><form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="delete-form">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="button" aria-label="Hapus {{ $book->title }}" onclick="confirmDelete(this)"><i class="bi bi-trash"></i></button></form></div></td>
                </tr>@endforeach</tbody>
            </table></div>
            @if ($books->hasPages())
                <nav class="book-pagination mt-4" aria-label="Navigasi halaman buku">
                    {{ $books->links('pagination::bootstrap-5') }}
                </nav>
            @endif
        @endif
    </section>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Hapus buku ini?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>
@endsection
