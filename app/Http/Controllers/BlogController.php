<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display the blog landing page.
     */
    public function index(): View
    {
        return view('blog.index');
    }
}
