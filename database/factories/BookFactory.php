<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'cover_image' => fake()->imageUrl(200, 300, 'books'),
            'price' => fake()->randomFloat(2, 20000, 150000),
            'category' => fake()->randomElement(['Fiksi', 'Sastra', 'Self-Help', 'Biografi']),
            'description' => fake()->paragraph(),
            'isbn' => fake()->unique()->numerify('978-979-####-##-#'),
            'is_new' => false,
            'is_popular' => false,
            'is_bestseller' => false,
            'published_at' => fake()->dateTimeBetween('-5 years', 'now'),
            'sold_count' => 0,
            'view_count' => 0,
            'wishlist_count' => 0,
        ];
    }
}
