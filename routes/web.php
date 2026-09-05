<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admin/books', BookController::class)
        ->names('admin.books')
        ->except(['index', 'create', 'show', 'edit']);
    Route::get('/admin/books', [BookController::class, 'index'])->name('admin.books.index');
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::get('/admin/books/{book}', [BookController::class, 'show'])->name('admin.books.show');
    Route::get('/admin/books/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
