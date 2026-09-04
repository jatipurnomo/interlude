<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<BookFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'cover_image',
        'price',
        'category',
        'description',
        'isbn',
        'is_new',
        'is_popular',
        'is_bestseller',
        'published_at',
        'sold_count',
        'view_count',
        'wishlist_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_new' => 'boolean',
        'is_popular' => 'boolean',
        'is_bestseller' => 'boolean',
        'published_at' => 'datetime',
        'price' => 'decimal:2',
    ];
}
