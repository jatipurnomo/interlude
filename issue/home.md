# Homepage Development - Interlude Penerbit Buku

## Deskripsi Proyek

Membangun homepage untuk website penerbit buku bernama **"Interlude"** menggunakan **Laravel 13** dan **Bootstrap 5** (versi terbaru).

---

## Konteks & Identitas Brand

### Nama Penerbit
- **Interlude** - Penerbit buku yang elegan, literary, dan modern

### Kesan yang Ingin Ditampilkan
- Elegan
- Literary (kesusasteraan)
- Hangat dan personal
- Modern dan profesional
- **Cocok untuk penerbit buku, bukan e-commerce umum**

### Palet Warna
- **Warna Utama**: Netral/Earthy (krem, coklat tua, off-white)
- **Warna Aksen**: Maroon atau Navy (dapat disesuaikan dengan brand guideline yang ada)

### Tipografi
- **Judul**: Serif font untuk kesan literary
- **Body Text**: Sans-serif font untuk keterbacaan

---

## Struktur Teknis

### Backend Setup

#### 1. Controller
- **File**: `app/Http/Controllers/HomeController.php`
- **Method**: `index()`
- **Fungsi**: Mengirim data dummy/eloquent untuk 3 kategori buku

#### 2. Model
- **File**: `app/Models/Book.php`
- **Field yang diperlukan**:
  - `id` (Primary Key)
  - `title` (Judul Buku)
  - `author` (Penulis)
  - `cover_image` (Path gambar cover)
  - `price` (Harga)
  - `category` (Kategori)
  - `is_new` (Flag buku baru)
  - `is_popular` (Flag buku populer)
  - `is_bestseller` (Flag buku laris)
  - `published_at` (Tanggal publikasi)
  - `sold_count` (Jumlah penjualan)
  - `description` (Deskripsi singkat)
  - `isbn` (ISBN buku)
  - `created_at`, `updated_at` (Timestamps)

#### 3. Migration & Seeder
- Buat migration untuk tabel `books`
- Buat seeder dengan data dummy buku
- Jalankan migration dan seeder untuk populate database

### Frontend Setup

#### 1. Layout & Views
- **Master Layout**: `resources/views/layouts/app.blade.php`
- **Homepage View**: `resources/views/home/index.blade.php`

#### 2. Komponen Blade (Reusable)
- `resources/views/components/navbar.blade.php`
- `resources/views/components/hero.blade.php`
- `resources/views/components/book-card.blade.php`
- `resources/views/components/footer.blade.php`

#### 3. Framework & Styling
- **Bootstrap 5**: Via CDN atau npm (jelaskan cara install via Vite)
- **Custom CSS**: `resources/css/interlude.css`
- **Vite/Mix Configuration**: Setup untuk bundling CSS dan JavaScript

#### 4. Lazy Loading
- Implementasikan lazy loading untuk gambar cover buku (menggunakan `loading="lazy"` atau library seperti `Lazysizes`)

---

## Struktur Halaman Homepage

### 1. Navbar/Header

#### Komponen:
- **Logo**: "Interlude" di sisi kiri
- **Menu Navigasi**:
  - Beranda
  - Blog
  - Galeri
  - Tentang Kami
  - Kontak
- **Search Bar**: Pencarian buku
- **Icon Tambahan**: 
  - Keranjang/Wishlist (opsional)
  - Tombol Login/Register
- **Responsive**: Collapse menjadi hamburger menu di mobile

#### Teknologi:
- Bootstrap Navbar component
- Bootstrap Offcanvas untuk mobile menu
- Sticky/Fixed header (optional)

---

### 2. Hero Section

#### Konten:
- **Headline Besar**: Tagline penerbit (misal: "Setiap Buku, Sebuah Jeda untuk Berpikir")
- **Subheadline**: Deskripsi singkat tentang Interlude
- **CTA Button**: "Jelajahi Koleksi" → Link ke halaman katalog/koleksi
- **Visual**: Gambar/ilustrasi buku atau banner buku unggulan

#### Fitur:
- Carousel/Slider untuk menampilkan beberapa buku unggulan bergantian (optional)
- Bootstrap grid untuk layout responsif
- Gradient overlay atau solid color background yang sesuai brand

---

### 3. Section "10 Buku Terbaru"

#### Struktur:
- **Judul Section**: "Koleksi Terbaru"
- **Link**: "Lihat Semua →" menuju halaman koleksi lengkap
- **Grid/Carousel**: Menampilkan 10 buku terbaru

#### Data:
```php
Book::where('is_new', true)->latest()->take(10)->get()
```

#### Card Buku:
- Cover gambar
- Judul buku
- Nama penulis
- Harga
- Badge "Baru"
- Hover effect: Zoom cover + Show button "Lihat Detail"

---

### 4. Section "10 Buku Populer"

#### Struktur:
- Sama seperti "Buku Terbaru", tapi berdasarkan `is_popular` atau jumlah view/wishlist
- **Badge**: "Populer"
- **Indikator Tambahan**: Jumlah pembaca/wishlist count
- Urutkan berdasarkan popularitas

#### Data:
```php
Book::where('is_popular', true)->orderBy('view_count', 'desc')->take(10)->get()
```

---

### 5. Section "10 Buku Paling Laris"

#### Struktur:
- Berdasarkan `sold_count` terbanyak, urutkan descending
- **Badge**: "Best Seller"
- **Ranking**: Tampilkan ranking (#1, #2, #3, dst)
- Highlight untuk top 3 bestseller

#### Data:
```php
Book::where('is_bestseller', true)->orderBy('sold_count', 'desc')->take(10)->get()
```

---

### 6. Komponen Book Card (Reusable)

#### File:
`resources/views/components/book-card.blade.php`

#### Props:
- `$book` (Book Model)
- `$showRanking` (boolean, untuk bestseller section)
- `$badge` (string: 'new', 'popular', 'bestseller')

#### Fitur:
- Responsive grid (1 kolom mobile, 2 tablet, 3-4 desktop)
- Hover effect:
  - Cover zoom (transform scale)
  - Shadow effect
  - Show "Lihat Detail" button
- Lazy loading untuk gambar
- Rating/wishlist icon (optional)

#### CSS:
```css
.book-card {
  transition: all 0.3s ease;
}

.book-card:hover img {
  transform: scale(1.05);
}

.book-card:hover {
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
```

---

### 7. Footer

#### Kolom 1: Tentang Interlude
- Logo Interlude
- Deskripsi singkat brand
- Mission/tagline

#### Kolom 2: Menu Navigasi
- Tentang Kami
- Katalog
- Kebijakan Privasi
- Syarat & Ketentuan
- FAQ

#### Kolom 3: Kontak
- Alamat fisik
- Email
- Nomor telepon
- WhatsApp link

#### Kolom 4: Ikuti Kami
- Icon/link Instagram
- Icon/link Twitter/X
- Icon/link Facebook
- Icon/link LinkedIn

#### Kolom 5: Newsletter Subscription
- Form input email
- Submit button "Subscribe"
- Teks benefit/deskripsi singkat

#### Bottom Bar:
- Copyright: "© 2024 Interlude Penerbit Buku. Semua hak dilindungi."
- Back to top button

---

## Requirement Tambahan

### Responsive Design
- ✅ Mobile-first approach
- ✅ Breakpoints: xs (mobile), sm, md (tablet), lg, xl (desktop)
- ✅ Testing di berbagai ukuran viewport
- ✅ Hamburger menu untuk mobile
- ✅ Touch-friendly buttons dan spacing

### Performance
- ✅ Lazy loading untuk semua gambar
- ✅ Image optimization (compress, modern format webp)
- ✅ Minified CSS dan JavaScript
- ✅ Caching strategy untuk static assets

### Accessibility
- ✅ Semantic HTML
- ✅ Alt text untuk semua gambar
- ✅ Proper heading hierarchy (h1, h2, dst)
- ✅ Color contrast sesuai WCAG
- ✅ Keyboard navigation

### Code Quality
- ✅ Komentar kode yang jelas
- ✅ Consistent naming convention
- ✅ DRY principle (reusable components)
- ✅ Proper indentation dan formatting

### Custom Styling
- **File**: `resources/css/interlude.css`
- **Fungsi**: Override/tambahan style di luar Bootstrap default
- **Konten**:
  - Brand color variables
  - Custom font imports
  - Utility classes
  - Component-specific styles
  - Animation/transition definitions

### Dokumentasi
- ✅ File struktur folder yang jelas
- ✅ README dengan setup instructions
- ✅ Komentar di file-file penting
- ✅ Migration/seeder instructions

---

## Struktur File & Folder yang Dihasilkan

```
interlude/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── HomeController.php          # Controller untuk homepage
│   └── Models/
│       └── Book.php                        # Model Book
├── database/
│   ├── migrations/
│   │   └── YYYY_MM_DD_HHMMSS_create_books_table.php
│   └── seeders/
│       └── BookSeeder.php                  # Seeder untuk data dummy
├── resources/
│   ├── css/
│   │   └── interlude.css                   # Custom styling
│   ├── js/
│   │   └── app.js                          # JavaScript bundle
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               # Master layout
│       ├── home/
│       │   └── index.blade.php             # Homepage view
│       └── components/
│           ├── navbar.blade.php            # Navigation component
│           ├── hero.blade.php              # Hero section component
│           ├── book-card.blade.php         # Reusable book card
│           ├── newsletter.blade.php        # Newsletter form
│           └── footer.blade.php            # Footer component
├── routes/
│   └── web.php                             # Route definitions
├── public/
│   └── images/
│       └── books/                          # Book cover images storage
├── vite.config.js                          # Vite configuration
└── package.json                            # Frontend dependencies

```

---

## Tahap Implementasi

### Phase 1: Setup Database
- [ ] Create migration: `books` table
- [ ] Create Model: `Book.php`
- [ ] Create Seeder: `BookSeeder.php` dengan 50+ data dummy
- [ ] Run migration & seeder

### Phase 2: Backend
- [ ] Create Controller: `HomeController.php`
- [ ] Setup routes di `routes/web.php`
- [ ] Test endpoint

### Phase 3: Frontend - Layout & Components
- [ ] Setup Vite + Bootstrap 5
- [ ] Create `layouts/app.blade.php`
- [ ] Create `components/navbar.blade.php`
- [ ] Create `components/footer.blade.php`
- [ ] Create `components/book-card.blade.php`
- [ ] Setup custom CSS: `resources/css/interlude.css`

### Phase 4: Homepage Sections
- [ ] Create `home/index.blade.php`
- [ ] Implement Hero section
- [ ] Implement "Buku Terbaru" section
- [ ] Implement "Buku Populer" section
- [ ] Implement "Buku Paling Laris" section

### Phase 5: Polish & Optimization
- [ ] Add lazy loading untuk gambar
- [ ] Responsive testing (mobile, tablet, desktop)
- [ ] CSS/JS minification
- [ ] Image optimization
- [ ] SEO optimization (meta tags)

### Phase 6: Testing & Documentation
- [ ] Browser compatibility testing
- [ ] Performance testing
- [ ] Accessibility testing
- [ ] Create comprehensive README
- [ ] Code documentation

---

## Catatan Penting

1. **Bootstrap 5**: Pastikan menggunakan versi terbaru, bisa via:
   - CDN: `https://cdn.jsdelivr.net/npm/bootstrap@5.3.x/`
   - NPM: `npm install bootstrap`

2. **Image Handling**: 
   - Gunakan placeholder service saat development
   - Implementasikan storage untuk image uploads
   - Optimize dengan image compression tools

3. **Color Variables**: Definisikan di CSS untuk konsistensi:
   ```css
   :root {
     --primary-color: #2C1810;      /* Coklat tua */
     --accent-color: #8B3A3A;       /* Maroon */
     --light-bg: #F5F1ED;           /* Off-white/krem */
     --text-primary: #333;
   }
   ```

4. **Font Loading**: Setup font families di `interlude.css`:
   - Serif (judul): Merriweather, Playfair Display, Lora
   - Sans-serif (body): Poppins, Inter, Segoe UI

5. **Database Dummy Data**: Buat variasi data yang menarik:
   - Minimal 3 kategori buku
   - Mix of new, popular, bestseller books
   - Realistik prices, descriptions, author names

---

## Links & Resources

- [Laravel 13 Documentation](https://laravel.com/docs/13)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)
- [Vite Documentation](https://vitejs.dev/)
- [Blade Templating](https://laravel.com/docs/13/blade)

---

**Status**: 🚀 Ready for Implementation  
**Last Updated**: 2026-08-31
