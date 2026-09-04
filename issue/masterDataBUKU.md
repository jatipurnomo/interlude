# Master Data Buku - CRUD

## 1. Deskripsi Proyek

Membangun fitur **Master Data Buku** untuk admin website Interlude Penerbit Buku menggunakan **Laravel 13**, **PHP**, **Blade**, dan **Bootstrap 5**.

Fitur ini mencakup operasi lengkap:

- Create: menambahkan data buku baru.
- Read: menampilkan daftar dan detail buku.
- Update: mengubah data buku.
- Delete: menghapus data buku dengan konfirmasi.

Data yang dikelola harus menjadi sumber utama konten buku yang ditampilkan pada halaman homepage.

## 2. Sumber Field dari Homepage

Field input utama mengacu pada informasi yang ditampilkan di komponen kartu buku homepage:

| Field | Label | Tipe Input | Wajib | Keterangan |
| --- | --- | --- | --- | --- |
| `title` | Judul Buku | Text | Ya | Ditampilkan sebagai judul kartu buku. |
| `author` | Penulis | Text | Ya | Ditampilkan sebagai nama penulis. |
| `cover_image` | Cover Buku | URL atau path gambar | Tidak | Ditampilkan sebagai gambar cover. Gunakan fallback jika kosong. |
| `category` | Kategori | Select atau text | Ya | Ditampilkan sebagai badge kategori. |
| `price` | Harga | Number/decimal | Ya | Ditampilkan dalam format Rupiah. |

Field berikut ditampilkan di homepage tetapi tidak diisi sebagai input manual pada form create/update:

| Field | Sumber Data | Keterangan |
| --- | --- | --- |
| `wishlist_count` | Sistem/aplikasi | Jumlah wishlist buku. Default `0`; dapat berubah melalui fitur wishlist. |
| `sold_count` | Sistem/aplikasi | Jumlah buku terjual. Default `0`; tidak boleh diedit langsung dari form master data. |
| `view_count` | Sistem/aplikasi | Jumlah tampilan buku. Default `0`; tidak boleh diedit langsung dari form master data. |

## 3. Field Pendukung Model

Field berikut sudah tersedia pada model dan migration buku untuk mendukung pengelolaan katalog dan filter homepage:

- `description`: deskripsi lengkap buku, nullable.
- `isbn`: ISBN buku, nullable dan unik.
- `published_at`: tanggal publikasi, nullable.
- `is_new`: menandai buku sebagai koleksi terbaru.
- `is_popular`: menandai buku sebagai koleksi populer.
- `is_bestseller`: menandai buku sebagai bestseller.

Field pendukung boleh ditambahkan pada form create/update karena menentukan koleksi tempat buku muncul di homepage. Statistik `sold_count`, `view_count`, dan `wishlist_count` tetap dikelola sistem.

## 4. Aturan Input dan Validasi

### Judul Buku

- Wajib diisi.
- Tipe string.
- Minimal 2 karakter.
- Maksimal 255 karakter.
- Tampilkan pesan validasi jika judul sudah tidak valid.

### Penulis

- Wajib diisi.
- Tipe string.
- Minimal 2 karakter.
- Maksimal 255 karakter.

### Cover Buku

- Boleh dikosongkan.
- Jika menggunakan URL, validasi sebagai URL yang valid.
- Jika menggunakan upload file, hanya izinkan JPG, JPEG, PNG, atau WebP.
- Batasi ukuran file sesuai kebutuhan aplikasi.
- Simpan file menggunakan Laravel Storage, bukan nama file mentah dari user.
- Tampilkan preview gambar sebelum submit jika upload digunakan.

### Kategori

- Wajib diisi.
- Tipe string atau pilihan dari daftar kategori.
- Maksimal 100 karakter.
- Nilai kategori harus konsisten dengan badge yang ditampilkan di homepage.

### Harga

- Wajib diisi.
- Tipe angka decimal.
- Nilai minimal lebih besar atau sama dengan `0`.
- Simpan sebagai nilai numerik, bukan string dengan simbol `Rp` atau pemisah ribuan.
- Tampilkan dalam format Rupiah hanya pada UI.

### Field Pendukung

- `description` boleh kosong dan bertipe text.
- `isbn` boleh kosong, tetapi jika diisi harus unik.
- `published_at` boleh kosong dan harus berupa tanggal valid.
- `is_new`, `is_popular`, dan `is_bestseller` bertipe boolean.
- Statistik `sold_count`, `view_count`, dan `wishlist_count` tidak boleh menerima perubahan dari request form master data.

Gunakan Laravel Form Request untuk validasi create dan update. Jangan mempercayai validasi client-side sebagai satu-satunya perlindungan.

## 5. Authentication dan Authorization

Seluruh halaman master data buku harus hanya dapat diakses oleh user yang sudah login.

Jika aplikasi sudah memiliki sistem role/permission, operasi CRUD harus dibatasi untuk admin atau role yang berwenang. User biasa tidak boleh membuat, mengubah, atau menghapus buku.

Contoh route protection:

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/books', BookController::class)
        ->names('admin.books');
});
```

Jika middleware role admin belum tersedia, dokumentasikan kebutuhan tersebut dan jangan menganggap autentikasi saja sebagai authorization final.

## 6. Struktur File Laravel

Gunakan struktur berikut:

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       └── BookController.php
│   └── Requests/
│       ├── StoreBookRequest.php
│       └── UpdateBookRequest.php
│
resources/
└── views/
    ├── layouts/
    │   └── dashboard.blade.php
    └── admin/
        └── books/
            ├── index.blade.php
            ├── create.blade.php
            ├── edit.blade.php
            ├── show.blade.php
            └── _form.blade.php

routes/
└── web.php

tests/
└── Feature/
    └── Admin/
        └── BookControllerTest.php
```

Gunakan model `App\Models\Book` yang sudah tersedia dan pertahankan mass assignment protection serta casts yang sudah didefinisikan.

## 7. Halaman Daftar Buku - Read

Buat halaman `admin/books/index.blade.php` dengan fitur:

- Judul halaman **Master Data Buku**.
- Tombol **Tambah Buku**.
- Tabel daftar buku yang responsive dan dapat di-scroll horizontal pada mobile.
- Kolom cover thumbnail, judul, penulis, kategori, harga, status koleksi, dan action.
- Tampilkan badge untuk status `Baru`, `Populer`, dan `Bestseller`.
- Tampilkan jumlah terjual dan wishlist sebagai informasi read-only.
- Search berdasarkan judul, penulis, ISBN, atau kategori.
- Filter berdasarkan kategori dan status koleksi jika datanya sudah tersedia.
- Pagination jika jumlah buku bertambah.
- Empty state ketika belum ada data.
- Flash message untuk keberhasilan atau kegagalan operasi.

Query harus berada di controller atau layer aplikasi, bukan di Blade.

## 8. Halaman Tambah Buku - Create

Buat halaman `admin/books/create.blade.php` menggunakan partial form yang dapat digunakan kembali oleh halaman edit.

Form harus berisi:

- Judul buku.
- Penulis.
- Cover buku.
- Kategori.
- Harga.
- Deskripsi.
- ISBN.
- Tanggal publikasi.
- Checkbox `Buku Terbaru` (`is_new`).
- Checkbox `Buku Populer` (`is_popular`).
- Checkbox `Bestseller` (`is_bestseller`).

Kebutuhan UX:

- Semua input mempunyai label yang terhubung dengan `for` dan `id`.
- Pertahankan nilai input menggunakan `old()` ketika validasi gagal.
- Tampilkan error di dekat field terkait.
- Sediakan tombol **Simpan Buku** dan **Batal**.
- Sediakan preview cover jika upload file digunakan.
- Sertakan `@csrf` pada form.
- Jangan menampilkan input editable untuk `sold_count`, `view_count`, atau `wishlist_count`.

Setelah berhasil, redirect ke daftar buku dengan flash message.

## 9. Halaman Detail Buku - Read

Buat halaman `admin/books/show.blade.php` untuk melihat detail satu buku.

Tampilkan:

- Cover buku.
- Judul.
- Penulis.
- Kategori.
- Harga dalam format Rupiah.
- Deskripsi.
- ISBN.
- Tanggal publikasi.
- Status Baru, Populer, dan Bestseller.
- Total views, wishlist, dan terjual sebagai informasi read-only.
- Tombol **Edit**.
- Tombol **Hapus** dengan konfirmasi.
- Link kembali ke daftar buku.

Output dari user atau database harus dirender menggunakan escaping Blade.

## 10. Halaman Edit Buku - Update

Buat halaman `admin/books/edit.blade.php` menggunakan partial `_form.blade.php` yang sama dengan halaman create.

Kebutuhan:

- Isi form dengan data buku yang sedang diedit.
- Terapkan validasi update yang sama dengan create.
- Pastikan validasi ISBN mengabaikan ISBN milik record yang sedang diedit.
- Pertahankan nilai lama jika validasi gagal.
- Cover lama tetap digunakan jika cover baru tidak diunggah.
- Hapus atau ganti file cover lama dengan aman ketika diperlukan.
- Sertakan `@csrf` dan `@method('PUT')`.
- Redirect ke halaman detail atau daftar setelah update berhasil.
- Tampilkan flash message keberhasilan.

## 11. Hapus Buku - Delete

Operasi delete harus menggunakan form method `DELETE`, bukan link GET.

```blade
<form method="POST" action="{{ route('admin.books.destroy', $book) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>
```

Kebutuhan:

- Tampilkan konfirmasi sebelum menghapus.
- Gunakan authorization sebelum delete.
- Jangan menghapus data melalui request GET.
- Tangani file cover yang tersimpan jika record dihapus.
- Redirect ke daftar buku setelah berhasil.
- Tampilkan flash message.
- Jika buku tidak ditemukan, gunakan response `404` bawaan Laravel.

## 12. Integrasi dengan Homepage

Data buku pada homepage harus tetap mengambil data melalui `HomeController` dan model `Book`.

Operasi master data harus menghasilkan data yang kompatibel dengan komponen kartu buku yang saat ini menampilkan:

- `title` sebagai judul.
- `author` sebagai penulis.
- `cover_image` sebagai gambar.
- `category` sebagai badge.
- `wishlist_count` sebagai jumlah wishlist.
- `sold_count` sebagai jumlah terjual.
- `price` sebagai harga.
- Flag `is_new`, `is_popular`, dan `is_bestseller` sebagai penentu koleksi homepage.

Pastikan cover kosong memiliki fallback image agar kartu homepage tidak rusak. Data statistik harus memiliki default `0`.

## 13. UI/UX dan Responsive Design

Gunakan Bootstrap 5 dan gaya visual yang konsisten dengan dashboard admin yang sudah ada.

- Tabel dapat di-scroll horizontal pada layar kecil.
- Form satu kolom pada mobile dan dua kolom pada layar besar jika sesuai.
- Tombol action mudah dibedakan dan memiliki icon yang relevan.
- Gunakan badge untuk status koleksi.
- Jangan mengandalkan warna saja untuk menyampaikan status.
- Gunakan modal atau dialog konfirmasi untuk delete.
- Sediakan focus state yang terlihat untuk navigasi keyboard.
- Gunakan alt text berdasarkan judul buku pada cover.
- Hindari menampilkan password atau data sensitif.

## 14. Security

- Lindungi route dengan middleware `auth` dan authorization admin.
- Gunakan `@csrf` pada semua form state-changing.
- Gunakan Form Request untuk validasi server-side.
- Jangan melakukan query database langsung di Blade.
- Gunakan route model binding untuk record buku.
- Gunakan escaping output Blade.
- Batasi file upload berdasarkan MIME type, ekstensi, ukuran, dan dimensi bila diperlukan.
- Simpan upload melalui Laravel Storage dengan nama file yang aman.
- Jangan menerima `sold_count`, `view_count`, atau `wishlist_count` dari request create/update.
- Jangan menggunakan `$guarded = []` untuk menghindari mass assignment protection.
- Jangan menghapus file atau data berdasarkan input path mentah dari user.

## 15. Tahapan Implementasi

### Phase 1: Backend dan Authorization

- [ ] Konfirmasi field dan casts pada model `Book`.
- [ ] Buat `BookController` di namespace admin.
- [ ] Buat `StoreBookRequest` dan `UpdateBookRequest`.
- [ ] Tambahkan resource route dengan middleware authentication.
- [ ] Tambahkan authorization admin/policy jika role system sudah tersedia.

### Phase 2: Read dan Create

- [ ] Buat halaman daftar buku.
- [ ] Tambahkan search, filter, pagination, dan empty state.
- [ ] Buat halaman tambah buku.
- [ ] Implementasikan validasi dan penyimpanan cover.
- [ ] Redirect dan flash message setelah create.

### Phase 3: Detail, Update, dan Delete

- [ ] Buat halaman detail buku.
- [ ] Buat halaman edit dengan partial form reusable.
- [ ] Implementasikan update dan pengelolaan cover lama.
- [ ] Implementasikan delete dengan konfirmasi dan method `DELETE`.
- [ ] Tambahkan cleanup file cover jika diperlukan.

### Phase 4: Integrasi Homepage

- [ ] Pastikan data create/update tampil benar pada homepage.
- [ ] Pastikan flag terbaru, populer, dan bestseller bekerja.
- [ ] Pastikan harga, kategori, cover, wishlist, dan sold count tampil sesuai format.
- [ ] Tambahkan fallback cover dan default statistik.

## 18. Scope dan Catatan

- Fitur ini hanya mengelola master data buku.
- Fitur transaksi, wishlist, laporan, upload manager, dan analytics bukan bagian dari CRUD awal kecuali diperlukan untuk sumber statistik.
- Jika role admin belum tersedia pada aplikasi, implementasi permission harus ditentukan sebelum fitur dirilis ke production.
- Pilihan cover URL atau upload file harus ditetapkan sebelum implementasi form.
- Field yang sudah ditampilkan homepage menjadi prioritas utama; field pendukung dipakai untuk kelengkapan katalog dan pengelompokan koleksi.

## 19. Referensi File

- `app/Models/Book.php`
- `app/Http/Controllers/HomeController.php`
- `resources/views/components/book-card.blade.php`
- `resources/views/home/index.blade.php`
- `database/migrations/2026_08_30_172006_create_books_table.php`
- `routes/web.php`

**Status**: 🚀 Ready for Implementation

**Last Updated**: 2026-09-04
