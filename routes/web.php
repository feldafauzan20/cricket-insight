<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// dummy route for single news page development
Route::get('/single-news', function () {
    return view('single-news');
});
