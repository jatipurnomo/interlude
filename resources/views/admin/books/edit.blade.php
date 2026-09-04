@extends('layouts.dashboard')

@section('title', 'Edit Buku - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="mb-4"><p class="eyebrow mb-1">Content management</p><h2 class="mb-0">Edit Buku</h2></div>
    <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.books._form')
    </form>
</div>
@endsection
