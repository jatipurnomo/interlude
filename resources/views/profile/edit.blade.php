@extends('layouts.dashboard')

@section('title', 'Profile - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-4">Photo Profil</h2>
                        <div class="profile-preview">
                            @if ($user->avatar_url)
                                <img src="{{ $user->avatar_url }}" alt="Foto {{ $user->name }}" class="avatar avatar-lg" style="object-fit: cover;">
                            @else
                                <span class="avatar avatar-lg">{{ $user->initials() }}</span>
                            @endif
                            <div>
                                <label for="avatar" class="form-label fw-semibold mb-1">Unggah Photo Profil</label>
                                <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,image/webp" class="form-control @error('avatar') is-invalid @enderror">
                                <div class="form-text">Format JPG, PNG, atau WebP. Maksimal 2 MB.</div>
                                @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-4">Informasi Akun</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Kata Sandi Baru <span class="text-muted">(opsional)</span></label>
                                <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Kosongkan jika tidak diganti" class="form-control @error('password') is-invalid @enderror">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i>Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection