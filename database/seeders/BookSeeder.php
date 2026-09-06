<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            // Kategori: Fiksi
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Laskar+Pelangi',
                'price' => 75000,
                'category' => 'Fiksi',
                'description' => 'Novel tentang kisah inspiratif pelajar di sebuah sekolah marginal di Belitong.',
                'isbn' => '978-9793068-51-6',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(5),
                'sold_count' => 5000,
                'view_count' => 12000,
                'wishlist_count' => 450,
            ],
            [
                'title' => 'Negeri Para Bedebah',
                'author' => 'Tere Liye',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Negeri+Para+Bedebah',
                'price' => 68000,
                'category' => 'Fiksi',
                'description' => 'Cerita tentang Negeri Belan yang dipimpin oleh para bedebah politisi.',
                'isbn' => '978-9793689-23-1',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(4),
                'sold_count' => 4500,
                'view_count' => 10500,
                'wishlist_count' => 380,
            ],
            [
                'title' => 'Tenggelamnya Kapal Van Der Wijck',
                'author' => 'Hamka',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Tenggelamnya+Kapal',
                'price' => 62000,
                'category' => 'Fiksi',
                'description' => 'Kisah cinta tragis di tengah perjalanan laut yang penuh gejolak.',
                'isbn' => '978-9793068-01-1',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(3),
                'sold_count' => 3800,
                'view_count' => 8900,
                'wishlist_count' => 320,
            ],
            [
                'title' => 'Pulang',
                'author' => 'Leila S. Chudori',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Pulang',
                'price' => 72000,
                'category' => 'Fiksi',
                'description' => 'Novel yang menceritakan tentang pencarian identitas dan kepulangan.',
                'isbn' => '978-9793689-56-9',

                'is_popular' => false,
                'is_bestseller' => false,
                'published_at' => now()->subYears(2),
                'sold_count' => 2200,
                'view_count' => 5100,
                'wishlist_count' => 180,
            ],
            [
                'title' => 'Aku Adalah Kamu',
                'author' => 'Iwan Setyawan',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Aku+Adalah+Kamu',
                'price' => 68000,
                'category' => 'Fiksi',
                'description' => 'Cerita fiksi ilmiah tentang teknologi transfer kesadaran.',
                'isbn' => '978-9793689-78-1',

                'is_popular' => true,
                'is_bestseller' => false,
                'published_at' => now()->subMonths(2),
                'sold_count' => 1500,
                'view_count' => 4200,
                'wishlist_count' => 240,
            ],

            // Kategori: Sastra/Puisi
            [
                'title' => 'Kumpulan Puisi Chairil Anwar',
                'author' => 'Chairil Anwar',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Chairil+Anwar',
                'price' => 55000,
                'category' => 'Sastra',
                'description' => 'Koleksi lengkap puisi-puisi klasik dari penyair revolusioner.',
                'isbn' => '978-9793068-12-7',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(3),
                'sold_count' => 2800,
                'view_count' => 6500,
                'wishlist_count' => 210,
            ],
            [
                'title' => 'Rindu',
                'author' => 'Tere Liye',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Rindu',
                'price' => 65000,
                'category' => 'Sastra',
                'description' => 'Kumpulan puisi tentang cinta, kehilangan, dan nostalgia.',
                'isbn' => '978-9793689-34-7',

                'is_popular' => false,
                'is_bestseller' => false,
                'published_at' => now()->subYears(1),
                'sold_count' => 1200,
                'view_count' => 3100,
                'wishlist_count' => 95,
            ],

            // Kategori: Self-Help/Pengembangan Diri
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Atomic+Habits',
                'price' => 95000,
                'category' => 'Self-Help',
                'description' => 'Panduan praktis untuk membangun kebiasaan baik dan mengubah hidup.',
                'isbn' => '978-9793689-45-3',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(2),
                'sold_count' => 3200,
                'view_count' => 7800,
                'wishlist_count' => 350,
            ],
            [
                'title' => 'Mindset',
                'author' => 'Carol S. Dweck',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Mindset',
                'price' => 85000,
                'category' => 'Self-Help',
                'description' => 'Mengubah cara berpikir untuk mencapai kesuksesan sejati.',
                'isbn' => '978-9793689-67-5',

                'is_popular' => true,
                'is_bestseller' => false,
                'published_at' => now()->subYears(2),
                'sold_count' => 2100,
                'view_count' => 5200,
                'wishlist_count' => 270,
            ],
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'author' => 'Stephen Covey',
                'cover_image' => 'https://via.placeholder.com/200x300?text=7+Habits',
                'price' => 92000,
                'category' => 'Self-Help',
                'description' => 'Tujuh kebiasaan untuk menjadi orang yang sangat efektif.',
                'isbn' => '978-9793689-12-5',

                'is_popular' => false,
                'is_bestseller' => false,
                'published_at' => now()->subYears(3),
                'sold_count' => 1800,
                'view_count' => 4100,
                'wishlist_count' => 150,
            ],
            [
                'title' => 'Digital Detox',
                'author' => 'Tara Marshall',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Digital+Detox',
                'price' => 78000,
                'category' => 'Self-Help',
                'description' => 'Panduan membatasi penggunaan teknologi untuk hidup lebih sehat.',
                'isbn' => '978-9793689-88-0',

                'is_popular' => true,
                'is_bestseller' => false,
                'published_at' => now()->subMonths(3),
                'sold_count' => 900,
                'view_count' => 2800,
                'wishlist_count' => 185,
            ],

            // Kategori: Biografi
            [
                'title' => 'Soekarno: Hidup, Perjuangan, Visi Masa Depan',
                'author' => 'Cindy Adams & Benedictus Widarsono',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Soekarno',
                'price' => 110000,
                'category' => 'Biografi',
                'description' => 'Biografi lengkap kehidupan Bapak Proklamator Indonesia.',
                'isbn' => '978-9793068-33-3',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(4),
                'sold_count' => 2000,
                'view_count' => 4600,
                'wishlist_count' => 120,
            ],
            [
                'title' => 'Steve Jobs: Kisah Hidup Visioner Apple',
                'author' => 'Walter Isaacson',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Steve+Jobs',
                'price' => 105000,
                'category' => 'Biografi',
                'description' => 'Biografi resmi Steve Jobs, founder Apple Inc.',
                'isbn' => '978-9793689-56-1',

                'is_popular' => false,
                'is_bestseller' => false,
                'published_at' => now()->subYears(3),
                'sold_count' => 1100,
                'view_count' => 2900,
                'wishlist_count' => 87,
            ],

            // Kategori: Non-Fiksi/Sejarah
            [
                'title' => 'Sejarah Indonesia Singkat',
                'author' => 'Hermanto Sofyan',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Sejarah+Indonesia',
                'price' => 88000,
                'category' => 'Sejarah',
                'description' => 'Panduan komprehensif tentang sejarah bangsa Indonesia.',
                'isbn' => '978-9793689-71-4',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(2),
                'sold_count' => 2600,
                'view_count' => 5800,
                'wishlist_count' => 230,
            ],
            [
                'title' => 'Perang Dunia II: Kronologi Lengkap',
                'author' => 'Dr. Budi Santoso',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Perang+Dunia+II',
                'price' => 125000,
                'category' => 'Sejarah',
                'description' => 'Dokumentasi detail lengkap tentang Perang Dunia kedua.',
                'isbn' => '978-9793689-99-8',

                'is_popular' => false,
                'is_bestseller' => false,
                'published_at' => now()->subMonths(1),
                'sold_count' => 450,
                'view_count' => 1200,
                'wishlist_count' => 65,
            ],

            // Kategori: Anak-anak
            [
                'title' => 'Petualangan Si Kancil',
                'author' => 'Suwardi M.D.',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Si+Kancil',
                'price' => 45000,
                'category' => 'Anak-anak',
                'description' => 'Kumpulan cerita rakyat tentang si Kancil yang cerdik.',
                'isbn' => '978-9793068-44-9',

                'is_popular' => true,
                'is_bestseller' => true,
                'published_at' => now()->subYears(5),
                'sold_count' => 4200,
                'view_count' => 8200,
                'wishlist_count' => 310,
            ],
            [
                'title' => 'Dongeng Sebelum Tidur',
                'author' => 'Bambang Sugihartono',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Dongeng',
                'price' => 52000,
                'category' => 'Anak-anak',
                'description' => 'Kumpulan dongeng indah untuk anak-anak sebelum tidur.',
                'isbn' => '978-9793689-22-4',

                'is_popular' => false,
                'is_bestseller' => false,
                'published_at' => now()->subYears(2),
                'sold_count' => 1600,
                'view_count' => 3800,
                'wishlist_count' => 140,
            ],
            [
                'title' => 'Pengetahuan Alam untuk Anak-anak',
                'author' => 'Prof. Ridwan M.',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Pengetahuan+Alam',
                'price' => 68000,
                'category' => 'Anak-anak',
                'description' => 'Panduan sains menyenangkan untuk anak-anak dengan ilustrasi.',
                'isbn' => '978-9793689-43-9',

                'is_popular' => true,
                'is_bestseller' => false,
                'published_at' => now()->subMonths(2),
                'sold_count' => 800,
                'view_count' => 2200,
                'wishlist_count' => 95,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
