<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return View
     */
    public function index()
    {
        // Get newest books (10)
        $newBooks = Book::where('is_new', true)
            ->latest()
            ->take(10)
            ->get();

        // Get popular books (10)
        $popularBooks = Book::where('is_popular', true)
            ->orderBy('view_count', 'desc')
            ->take(10)
            ->get();

        // Get bestselling books (10) with ranking
        $bestsellerBooks = Book::where('is_bestseller', true)
            ->orderBy('sold_count', 'desc')
            ->take(10)
            ->get();

        return view('home.index', [
            'newBooks' => $newBooks,
            'popularBooks' => $popularBooks,
            'bestsellerBooks' => $bestsellerBooks,
        ]);
    }
}
