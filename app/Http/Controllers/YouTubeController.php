<?php

namespace App\Http\Controllers;

use App\Services\YouTubeService;
use Illuminate\View\View;

class YouTubeController extends Controller
{
    /**
     * Display the YouTube gallery page.
     */
    public function index(YouTubeService $youtube): View
    {
        $videos = collect($youtube->getLatestVideos(9));

        return view('youtube.index', compact('videos'));
    }
}
