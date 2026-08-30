<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('author');
            $table->string('cover_image')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->text('description')->nullable();
            $table->string('isbn')->unique()->nullable();
            $table->boolean('is_new')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_bestseller')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->integer('sold_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('wishlist_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
