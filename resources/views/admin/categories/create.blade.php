@extends('layouts.dashboard')

@section('title', 'Tambah Kategori - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div><p class="eyebrow mb-1">Content management</p><h2 class="mb-0">Tambah Kategori</h2></div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Kembali</a>
    </div>
    <section class="dashboard-panel">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h2 class="h5 mb-4">Informasi Kategori</h2>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kategori</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-0">
                                <label for="description" class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                                <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="h5 mb-3">Tips</h2>
                            <ul class="small text-muted mb-0">
                                <li>Nama kategori akan otomatis dibuatkan slug</li>
                                <li>Deskripsi membantu menjelaskan isi kategori</li>
                                <li>Pastikan nama kategori unik dan jelas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i>Simpan Kategori</button>
            </div>
        </form>
    </section>
</div>
@endsection
