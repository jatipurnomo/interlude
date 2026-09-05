<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);
        $searchTerm = trim($validated['q'] ?? '');

        $books = Book::query()
            ->when($searchTerm !== '', function (Builder $query) use ($searchTerm): void {
                $query->where(function (Builder $query) use ($searchTerm): void {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('search.index', [
            'books' => $books,
            'searchTerm' => $searchTerm,
        ]);
    }
}
