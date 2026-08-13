<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BbiWbbiSetting;
use Illuminate\Http\Request;

class BbiWbbiController extends Controller
{
    public function index()
    {
        $setting = BbiWbbiSetting::with([
            'article1', 'article2', 'article3',
            'brandStory1', 'brandStory2', 'brandStory3'
        ])->first();

        $latestBbiArticles = Article::whereHas('category', function ($query) {
            $query->where('slug', 'bbi-wbbi');
        })->latest('published_at')->latest('created_at')->take(3)->get();

        return view('bbi-wbbi', compact('setting', 'latestBbiArticles'));
    }
}
