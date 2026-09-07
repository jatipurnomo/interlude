@extends('layouts.dashboard')

@section('title', $category->name . ' - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    @if (session('success'))<div class="alert alert-success alert-fade">{{ session('success') }}</div>@endif
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div><p class="eyebrow mb-1">Category details</p><h2 class="mb-0">{{ $category->name }}</h2></div>
        <div class="d-flex gap-2"><a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i>Edit</a><a href="{{ route('admin.categories.index') }}" class="btn btn-light">Kembali</a></div>
    </div>
    <section class="dashboard-panel">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Nama</dt>
                            <dd class="col-sm-9">{{ $category->name }}</dd>
                            <dt class="col-sm-3">Slug</dt>
                            <dd class="col-sm-9"><code>{{ $category->slug }}</code></dd>
                            <dt class="col-sm-3">Deskripsi</dt>
                            <dd class="col-sm-9">{{ $category->description ?: '-' }}</dd>
                            <dt class="col-sm-3">Dibuat</dt>
                            <dd class="col-sm-9">{{ $category->created_at->format('d M Y H:i') }}</dd>
                            <dt class="col-sm-3">Diperbarui</dt>
                            <dd class="col-sm-9">{{ $category->updated_at->format('d M Y H:i') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="display-4 fw-bold text-primary">{{ $category->books_count ?? 0 }}</div>
                        <small class="text-muted">Buku dalam kategori ini</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="mt-3 delete-form">@csrf @method('DELETE')<button type="button" class="btn btn-outline-danger" onclick="confirmDelete(this)"><i class="bi bi-trash me-1"></i>Hapus Kategori</button></form>
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
