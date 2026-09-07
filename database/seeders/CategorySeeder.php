<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel dan cerita fiksi'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku berdasarkan fakta dan pengetahuan'],
            ['name' => 'Pendidikan', 'description' => 'Buku teks dan materi pembelajaran'],
            ['name' => 'Agama', 'description' => 'Buku tentang spiritualitas dan keagamaan'],
            ['name' => 'Self Help', 'description' => 'Buku pengembangan diri'],
            ['name' => 'Bisnis', 'description' => 'Buku tentang kewirausahaan dan manajemen'],
            ['name' => 'Teknologi', 'description' => 'Buku tentang sains dan teknologi'],
            ['name' => 'Sejarah', 'description' => 'Buku tentang sejarah dan budaya'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                $category
            );
        }
    }
}
