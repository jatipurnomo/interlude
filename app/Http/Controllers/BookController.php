<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display the public book detail page.
     */
    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }
}
