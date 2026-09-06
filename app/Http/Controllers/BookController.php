<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    /**
     * Increment the sold count and redirect to WhatsApp checkout.
     */
    public function buy(Book $book): RedirectResponse
    {
        $book->increment('sold_count');

        return redirect()->away(
            'https://wa.me/6282281572158?text='.urlencode('Halo Kak, saya ingin membeli buku "'.$book->title.'" karya '.$book->author.'.')
        );
    }

    /**
     * Toggle the book in the wishlist and redirect back.
     */
    public function wishlist(Request $request, Book $book): RedirectResponse|JsonResponse
    {
        $wished = session()->get('wishlist', []);

        if (in_array($book->id, $wished, true)) {
            $book->decrement('wishlist_count');
            session()->put('wishlist', array_values(array_diff($wished, [$book->id])));
            $nowWished = false;
        } else {
            $book->increment('wishlist_count');
            session()->push('wishlist', $book->id);
            $nowWished = true;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'wished' => $nowWished,
                'wishlist_count' => $book->fresh()->wishlist_count,
            ]);
        }

        return back();
    }
}
