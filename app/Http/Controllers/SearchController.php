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
            'collection' => ['nullable', 'string', 'in:bestseller,populer'],
        ]);
        $searchTerm = trim($validated['q'] ?? '');
        $collection = $validated['collection'] ?? null;

        $books = Book::query()
            ->when($collection === 'bestseller', fn (Builder $query) => $query->where('is_bestseller', true))
            ->when($collection === 'populer', fn (Builder $query) => $query->where('is_popular', true))
            ->when($searchTerm !== '', function (Builder $query) use ($searchTerm): void {
                $query->where(function (Builder $query) use ($searchTerm): void {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('author', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            })
            ->when($collection === 'bestseller', fn (Builder $query) => $query->orderBy('sold_count', 'desc'), fn (Builder $query) => $collection === 'populer' ? $query->orderBy('wishlist_count', 'desc') : $query->orderBy('id', 'desc'))
            ->paginate(10)
            ->withQueryString();

        return view('search.index', [
            'books' => $books,
            'searchTerm' => $searchTerm,
            'collection' => $collection,
        ]);
    }
}
