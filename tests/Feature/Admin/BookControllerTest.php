<?php

namespace Tests\Feature\Admin;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.books.index'));

        $response->assertRedirectToRoute('login');
    }

    public function test_non_admin_cannot_access_book_management(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('admin.books.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_create_update_and_delete_book(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $bookData = [
            'title' => 'The Quiet Library',
            'author' => 'Mara Ellis',
            'price' => 85000,
            'category' => 'Fiksi',
            'description' => 'A story about books and belonging.',
            'isbn' => '978-1234-5678-90-1',
            'published_at' => '2026-09-04 10:00',
            'is_new' => true,
            'is_popular' => false,
            'is_bestseller' => false,
        ];

        $createResponse = $this->actingAs($admin)->post(route('admin.books.store'), $bookData);
        $book = Book::query()->where('isbn', $bookData['isbn'])->firstOrFail();

        $createResponse->assertRedirectToRoute('admin.books.index');
        $this->assertSame('The Quiet Library', $book->title);
        $this->assertSame(0, $book->sold_count);
        $this->assertSame(0, $book->view_count);
        $this->assertSame(0, $book->wishlist_count);

        $updateResponse = $this->actingAs($admin)->put(route('admin.books.update', $book), [
            ...$bookData,
            'title' => 'The Quiet Library Updated',
            'isbn' => $book->isbn,
            'sold_count' => 999999,
            'view_count' => 999999,
            'wishlist_count' => 999999,
        ]);

        $updateResponse->assertRedirectToRoute('admin.books.show', $book);
        $this->assertSame('The Quiet Library Updated', $book->refresh()->title);
        $this->assertSame(0, $book->sold_count);

        $deleteResponse = $this->actingAs($admin)->delete(route('admin.books.destroy', $book));

        $deleteResponse->assertRedirectToRoute('admin.books.index');
        $this->assertModelMissing($book);
    }

    public function test_invalid_book_data_is_rejected(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('admin.books.store'), [
            'title' => 'x',
            'author' => '',
            'price' => -1,
            'category' => '',
            'cover_image' => UploadedFile::fake()->create('cover.gif', 100, 'image/gif'),
        ]);

        $response->assertSessionHasErrors(['title', 'author', 'price', 'category', 'cover_image']);
    }

    public function test_admin_can_upload_replace_and_delete_book_cover(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $bookData = [
            'title' => 'A Book With A Cover',
            'author' => 'Mara Ellis',
            'price' => 85000,
            'category' => 'Fiksi',
            'cover_image' => UploadedFile::fake()->image('first-cover.jpg'),
        ];

        $this->actingAs($admin)->post(route('admin.books.store'), $bookData);
        $book = Book::query()->where('title', $bookData['title'])->firstOrFail();
        $oldCover = $book->cover_image;

        Storage::disk('public')->assertExists($oldCover);
        $this->assertSame('/storage/'.$oldCover, $book->cover_image_url);

        $this->actingAs($admin)->put(route('admin.books.update', $book), [
            'title' => $book->title,
            'author' => $book->author,
            'price' => $book->price,
            'category' => $book->category,
            'cover_image' => UploadedFile::fake()->image('replacement-cover.png'),
        ]);

        $newCover = $book->refresh()->cover_image;
        $this->assertNotSame($oldCover, $newCover);
        Storage::disk('public')->assertMissing($oldCover);
        Storage::disk('public')->assertExists($newCover);

        $this->actingAs($admin)->delete(route('admin.books.destroy', $book));

        Storage::disk('public')->assertMissing($newCover);
    }

    public function test_admin_can_search_books(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Book::factory()->create(['title' => 'Searchable Title']);
        Book::factory()->create(['title' => 'Another Book']);

        $response = $this->actingAs($admin)->get(route('admin.books.index', ['search' => 'Searchable']));

        $response->assertOk();
        $response->assertSee('Searchable Title');
        $response->assertDontSee('Another Book');
    }

    public function test_book_list_renders_bootstrap_pagination(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Book::factory()->count(11)->create();

        $response = $this->actingAs($admin)->get(route('admin.books.index'));

        $response->assertOk();
        $response->assertSee('book-pagination');
        $response->assertSee('page-link');
        $response->assertSee('rel="next"', false);
    }
}
