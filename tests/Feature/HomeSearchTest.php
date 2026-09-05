<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class HomeSearchTest extends TestCase
{
    use DatabaseMigrations;

    public function test_home_search_filters_books_by_title_author_or_category(): void
    {
        Book::factory()->create([
            'title' => 'Buku Pencarian Interlude',
            'author' => 'Penulis Utama',
            'category' => 'Sastra',
            'is_new' => true,
            'is_popular' => true,
            'is_bestseller' => true,
        ]);
        Book::factory()->create([
            'title' => 'Buku Lainnya',
            'author' => 'Penulis Lain',
            'category' => 'Fiksi',
            'is_new' => true,
            'is_popular' => true,
            'is_bestseller' => true,
        ]);

        $response = $this->get('/?q=Interlude');

        $response->assertOk()
            ->assertSee('Buku Pencarian Interlude')
            ->assertDontSee('Buku Lainnya')
            ->assertSee('Hasil pencarian untuk:');
    }

    public function test_search_page_displays_book_details_for_matching_results(): void
    {
        Book::factory()->create([
            'title' => 'Detail Buku Interlude',
            'author' => 'Penulis Detail',
            'category' => 'Biografi',
            'description' => 'Deskripsi lengkap untuk hasil pencarian.',
            'isbn' => '978-979-1234-56-7',
        ]);

        $response = $this->get('/search?q=Detail');

        $response->assertOk()
            ->assertSee('Detail Buku Interlude')
            ->assertSee('Penulis Detail')
            ->assertSee('Deskripsi lengkap untuk hasil pencarian.')
            ->assertSee('978-979-1234-56-7')
            ->assertSee('bookImageModal')
            ->assertSee('data-bs-toggle="modal"', false);
    }

    public function test_search_page_paginates_results_and_preserves_the_search_query(): void
    {
        foreach (range(1, 16) as $number) {
            Book::factory()->create([
                'title' => "Pagination Book {$number}",
                'author' => 'Pagination Author',
                'category' => 'Pagination',
                'published_at' => now()->subDays($number),
            ]);
        }

        $response = $this->get('/search?q=Pagination');

        $response->assertOk()
            ->assertSee('page=2')
            ->assertSee('Pagination Book 1');

        $secondPage = $this->get('/search?q=Pagination&page=2');

        $secondPage->assertOk()
            ->assertSee('Pagination Book 16');
    }
}
