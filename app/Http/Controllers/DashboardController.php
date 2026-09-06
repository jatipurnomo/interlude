<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalSold = Book::sum('sold_count');
        $totalViews = Book::sum('view_count');
        $totalWishlist = Book::sum('wishlist_count');
        $totalRevenue = Book::sum(DB::raw('price * sold_count'));

        $popularBooks = Book::orderBy('wishlist_count', 'desc')->take(5)->get();
        $bestsellerBooks = Book::orderBy('sold_count', 'desc')->take(5)->get();
        $mostViewedBooks = Book::orderBy('view_count', 'desc')->take(5)->get();

        $categoryStats = Category::withCount('books')
            ->orderBy('books_count', 'desc')
            ->take(5)
            ->get();

        $recentBooks = Book::latest()->take(5)->get();

        return view('dashboard.index', [
            'user' => $user,
            'userInitials' => $user->initials(),
            'userRole' => data_get($user, 'role', 'Administrator'),
            'statistics' => [
                ['label' => 'Total Buku', 'value' => number_format($totalBooks), 'icon' => 'bi-book', 'color' => 'primary'],
                ['label' => 'Total Kategori', 'value' => number_format($totalCategories), 'icon' => 'bi-folder', 'color' => 'info'],
                ['label' => 'Total Terjual', 'value' => number_format($totalSold), 'icon' => 'bi-cart-check', 'color' => 'success'],
                ['label' => 'Total Pendapatan', 'value' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'), 'icon' => 'bi-currency-dollar', 'color' => 'warning'],
                ['label' => 'Total Dilihat', 'value' => number_format($totalViews), 'icon' => 'bi-eye', 'color' => 'secondary'],
                ['label' => 'Total Disukai', 'value' => number_format($totalWishlist), 'icon' => 'bi-heart', 'color' => 'danger'],
            ],
            'popularBooks' => $popularBooks,
            'bestsellerBooks' => $bestsellerBooks,
            'mostViewedBooks' => $mostViewedBooks,
            'categoryStats' => $categoryStats,
            'recentBooks' => $recentBooks,
        ]);
    }
}
