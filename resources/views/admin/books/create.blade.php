@extends('layouts.dashboard')

@section('title', 'Tambah Buku - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="mb-4"><p class="eyebrow mb-1">Content management</p><h2 class="mb-0">Tambah Buku</h2></div>
    <form method="POST" action="{{ route('admin.books.store') }}">
        @include('admin.books._form')
    </form>
</div>
@endsection
