@extends('layouts.app')

@section('title', 'Blog - Interlude Penerbit Buku')

@section('content')
<section class="blog-coming-soon">
    <div class="container">
        <div class="blog-coming-soon-content text-center">
            <span class="blog-coming-soon-icon" aria-hidden="true">
                <i class="fas fa-feather-alt"></i>
            </span>
            <p class="blog-eyebrow">Interlude Blog</p>
            <h1>Coming Soon</h1>
            <p class="lead">
                Catatan, cerita, dan gagasan dari dunia buku sedang kami siapkan untuk Anda.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2" aria-hidden="true"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection