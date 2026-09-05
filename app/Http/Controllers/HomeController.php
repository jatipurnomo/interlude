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

        // Get newest books (8)
        $newBooks = Book::where('is_new', true)
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        // Get popular books (8)
        $popularBooks = Book::where('is_popular', true)
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        // Get bestselling books (8) with ranking
        $bestsellerBooks = Book::where('is_bestseller', true)
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        return view('home.index', [
            'newBooks' => $newBooks,
            'popularBooks' => $popularBooks,
            'bestsellerBooks' => $bestsellerBooks,
            'searchTerm' => $searchTerm,
        ]);
    }
}
