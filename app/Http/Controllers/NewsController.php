<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar semua berita
     */
    public function index()
    {
        // Mengambil semua berita yang sudah published, diurutkan terbaru
        $articles = Article::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
            
        return view('news.index', compact('articles'));
    }

    /**
     * Menampilkan detail satu berita
     */
    public function show($slug)
    {
        // Mencari artikel berdasarkan slug, jika tidak ketemu akan menampilkan error 404
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // Mengirim data ke view 'single-news'
        return view('single-news', compact('article'));
    }
}