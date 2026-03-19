<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of news with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        // Paginate news with 10 items per page
        // This creates 10 pages with 100 records, perfect for testing all 4 pagination scenarios
        $news = News::orderBy('published_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // Preserve other query parameters

        return view('news', [
            'news' => $news,
        ]);
    }
}
