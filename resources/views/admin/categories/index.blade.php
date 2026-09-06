@extends('layouts.dashboard')

@section('title', 'Master Data Kategori - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div><p class="eyebrow mb-1">Content management</p><h2 class="mb-0">Master Data Kategori</h2></div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Kategori</a>
    </div>
    @if (session('success'))<div class="alert alert-success alert-fade">{{ session('success') }}</div>@endif
    @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    <section class="dashboard-panel">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-2 mb-4">
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="input-group">
                    <input name="search" value="{{ $search }}" class="form-control" placeholder="Cari nama kategori">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </div>
            @if ($search)
                <div class="col-12 col-md-auto"><a class="btn btn-light w-100" href="{{ route('admin.categories.index') }}">Reset</a></div>
            @endif
        </form>
        @if ($categories->isEmpty())
            <div class="text-center py-5"><i class="bi bi-folder display-5 text-muted"></i><h3 class="h5 mt-3">Belum ada kategori</h3><p class="text-muted">Tambahkan kategori pertama untuk mengelola buku.</p></div>
        @else
            <div class="table-responsive"><table class="table align-middle mb-0">
                <thead><tr><th class="text-center">No</th><th class="text-center">Nama Kategori</th><th class="text-center">Slug</th><th class="text-center">Deskripsi</th><th class="text-center">Jumlah Buku</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>@foreach ($categories as $category)<tr>
                    <td class="text-center">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td><code>{{ $category->slug }}</code></td>
                    <td><small class="text-muted">{{ Str::limit($category->description ?: '-', 50) }}</small></td>
                    <td class="text-center"><span class="badge text-bg-secondary">{{ $category->books_count ?? 0 }}</span></td>
                    <td class="text-end"><div class="d-inline-flex gap-1"><a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-light" aria-label="Lihat {{ $category->name }}"><i class="bi bi-eye"></i></a><a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-light" aria-label="Edit {{ $category->name }}"><i class="bi bi-pencil"></i></a><form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="delete-form">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="button" aria-label="Hapus {{ $category->name }}" onclick="confirmDelete(this)"><i class="bi bi-trash"></i></button></form></div></td>
                </tr>@endforeach</tbody>
            </table></div>
            @if ($categories->hasPages())
                <nav class="book-pagination mt-4" aria-label="Navigasi halaman kategori">
                    {{ $categories->links('pagination::bootstrap-5') }}
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
            title: 'Hapus kategori ini?',
            text: 'Kategori yang dihapus tidak dapat dikembalikan.',
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
