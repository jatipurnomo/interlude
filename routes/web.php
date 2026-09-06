<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/buku/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/beli/{book}', [BookController::class, 'buy'])->name('books.buy');
Route::match(['get', 'post'], '/wishlist/{book}', [BookController::class, 'wishlist'])->name('books.wishlist');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('admin/books', AdminBookController::class)
        ->names('admin.books')
        ->except(['index', 'create', 'show', 'edit']);
    Route::get('/admin/books', [AdminBookController::class, 'index'])->name('admin.books.index');
    Route::get('/admin/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
    Route::get('/admin/books/{book}', [AdminBookController::class, 'show'])->name('admin.books.show');
    Route::get('/admin/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
