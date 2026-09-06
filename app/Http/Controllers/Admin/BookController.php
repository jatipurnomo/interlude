<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Book::class);

        $categories = Book::distinct()->pluck('category')->filter()->sort()->values();

        $books = Book::query()
            ->when($request->string('search')->trim()->isNotEmpty(), function ($query) use ($request): void {
                $search = $request->string('search')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%");
                });
            })
            ->when($request->string('category')->trim()->isNotEmpty(), function ($query) use ($request): void {
                $query->where('category', $request->string('category')->trim()->toString());
            })
            ->when($request->string('collection')->trim()->isNotEmpty(), function ($query) use ($request): void {
                $collection = $request->string('collection')->trim()->toString();
                if ($collection === 'popular') {
                    $query->where('is_popular', true);
                } elseif ($collection === 'bestseller') {
                    $query->where('is_bestseller', true);
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.books.index', [
            'books' => $books,
            'search' => $request->string('search')->trim()->toString(),
            'categories' => $categories,
            'selectedCategory' => $request->string('category')->trim()->toString(),
            'selectedCollection' => $request->string('collection')->trim()->toString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('create', Book::class);

        $categories = \App\Models\Category::orderBy('name')->pluck('name');

        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        $bookData = $this->normalizeCollectionFlags($request->validated(), $request);

        if ($request->hasFile('cover_image')) {
            $bookData['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        Book::create($bookData);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        Gate::authorize('view', $book);

        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        Gate::authorize('update', $book);

        $categories = \App\Models\Category::orderBy('name')->pluck('name');

        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $bookData = $this->normalizeCollectionFlags($request->validated(), $request);

        if ($request->hasFile('cover_image')) {
            $oldCover = $book->cover_image;
            $bookData['cover_image'] = $request->file('cover_image')->store('books', 'public');
            $this->deleteStoredCover($oldCover);
        }

        $book->update($bookData);

        return redirect()->route('admin.books.show', $book)->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        Gate::authorize('delete', $book);

        $this->deleteStoredCover($book->cover_image);
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }

    private function normalizeCollectionFlags(array $bookData, Request $request): array
    {
        foreach (['is_popular', 'is_bestseller'] as $flag) {
            $bookData[$flag] = $request->boolean($flag);
        }

        return $bookData;
    }

    private function deleteStoredCover(?string $coverPath): void
    {
        if ($coverPath !== null && ! Str::startsWith($coverPath, ['http://', 'https://'])) {
            Storage::disk('public')->delete($coverPath);
        }
    }
}
