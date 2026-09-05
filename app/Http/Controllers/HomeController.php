<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(Request $request): View
    {
        $searchTerm = trim((string) $request->query('q', ''));

        // Get newest books (10)
        $newBooks = Book::where('is_new', true)
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->latest()
            ->take(10)
            ->get();

        // Get popular books (10)
        $popularBooks = Book::where('is_popular', true)
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->orderBy('view_count', 'desc')
            ->take(10)
            ->get();

        // Get bestselling books (10) with ranking
        $bestsellerBooks = Book::where('is_bestseller', true)
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->orderBy('sold_count', 'desc')
            ->take(10)
            ->get();

        return view('home.index', [
            'newBooks' => $newBooks,
            'popularBooks' => $popularBooks,
            'bestsellerBooks' => $bestsellerBooks,
            'searchTerm' => $searchTerm,
        ]);
    }
}
