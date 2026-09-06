@csrf
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h2 class="h5 mb-4">Book information</h2>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Buku</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $book->title ?? '') }}" class="form-control @error('title') is-invalid @enderror" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="author" class="form-label">Penulis</label>
                        <input id="author" name="author" type="text" value="{{ old('author', $book->author ?? '') }}" class="form-control @error('author') is-invalid @enderror" required>
                        @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Kategori</label>
                        <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $book->category ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input id="price" name="price" type="text" inputmode="numeric" value="{{ old('price', isset($book) && $book->price ? number_format((int) $book->price, 0, ',', '.') : '') }}" class="form-control @error('price') is-invalid @enderror" required>
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="isbn" class="form-label">ISBN <span class="text-muted">(opsional)</span></label>
                        <input id="isbn" name="isbn" type="text" value="{{ old('isbn', $book->isbn ?? '') }}" class="form-control @error('isbn') is-invalid @enderror">
                        @error('isbn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-3 mb-3">
                    <label for="cover_image" class="form-label">Cover Buku <span class="text-muted">(opsional)</span></label>
                    <input id="cover_image" name="cover_image" type="file" accept="image/jpeg,image/png,image/webp" class="form-control @error('cover_image') is-invalid @enderror">
                    <div class="form-text">Format JPG, PNG, atau WebP. Maksimal 2 MB.</div>
                    @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if (!empty($book?->cover_image))
                        <img src="{{ $book->cover_image_url }}" alt="Cover {{ $book->title }}" class="img-thumbnail mt-3" style="max-height: 180px;">
                    @endif
                </div>
                <div class="mb-0">
                    <label for="description" class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                    <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description ?? '') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h2 class="h5 mb-4">Publication</h2>
                <label for="published_at" class="form-label">Tanggal Publikasi</label>
                <input id="published_at" name="published_at" type="datetime-local" value="{{ old('published_at', isset($book) && $book->published_at ? $book->published_at->format('Y-m-d\TH:i') : '') }}" class="form-control @error('published_at') is-invalid @enderror">
                @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h2 class="h5 mb-3">Homepage collections</h2>
                @foreach(['is_popular' => 'Buku Populer', 'is_bestseller' => 'Bestseller'] as $field => $label)
                    <div class="form-check mb-3">
                        <input id="{{ $field }}" name="{{ $field }}" value="1" type="checkbox" class="form-check-input" @checked(old($field, $book->$field ?? false))>
                        <label for="{{ $field }}" class="form-check-label">{{ $label }}</label>
                    </div>
                @endforeach
                <p class="small text-muted mb-0">Views, wishlist, dan sold count dikelola otomatis oleh sistem.</p>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.books.index') }}" class="btn btn-light">Batal</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i>{{ isset($book) ? 'Simpan Perubahan' : 'Simpan Buku' }}</button>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceInput = document.getElementById('price');

        function formatNumber(value) {
            const digits = value.replace(/\D/g, '');
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        priceInput.addEventListener('input', function () {
            const cursorPos = this.selectionStart;
            const oldLen = this.value.length;
            this.value = formatNumber(this.value);
            const newLen = this.value.length;
            this.setSelectionRange(cursorPos + (newLen - oldLen), cursorPos + (newLen - oldLen));
        });

        priceInput.closest('form').addEventListener('submit', function () {
            priceInput.value = priceInput.value.replace(/\D/g, '');
        });

        $('#category').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Pilih Kategori'
        });
    });
</script>
@endsection
