## Plan: Membuat Spesifikasi Dashboard

Dokumen `issue/dashboard.md` akan dibuat berdasarkan `task/dashboard.txt`, disesuaikan dengan proyek Laravel 13 yang sedang digunakan.

**Isi utama**
1. Deskripsi dashboard admin dan stack Laravel Blade, Bootstrap 5, Bootstrap Icons, serta Chart.js.
2. Alur autentikasi menggunakan middleware `auth`, route `GET /dashboard`, dan logout aktual melalui `POST /logout`.
3. Informasi user dari `Auth::user()` tanpa hardcode.
4. Struktur layout, sidebar, navbar, statistik, chart transaksi, recent activity, dan quick actions.
5. Responsive behavior untuk desktop hingga mobile.
6. Struktur file Laravel yang direkomendasikan.
7. Data dummy dari controller, bukan query langsung di Blade.
8. Security, accessibility, UI/UX, testing, acceptance criteria, dan fase implementasi.
9. Catatan bahwa `role`, avatar, serta route Users/Reports/Settings belum tersedia dan perlu fallback atau integrasi lanjutan.
10. Wireframe ASCII dan metadata status `Ready for Implementation` dengan tanggal `2026-09-04`.

**File terkait**
- [task/dashboard.txt](task/dashboard.txt) sebagai sumber kebutuhan.
- [issue/home.md](issue/home.md) dan [issue/login.md](issue/login.md) sebagai acuan format.
- [routes/web.php](routes/web.php) untuk route autentikasi yang tersedia.
- [app/Http/Controllers/Auth/AuthController.php](app/Http/Controllers/Auth/AuthController.php) untuk alur login/logout.
- [app/Models/User.php](app/Models/User.php) untuk field user yang tersedia.
- [resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php) untuk pola layout dan asset frontend.

**Batasan**
- Hanya membuat dokumentasi spesifikasi.
- Tidak membuat implementasi dashboard, migration, dependency baru, atau route tambahan.
- Bagian CodeIgniter akan dihapus karena repository ini menggunakan Laravel.