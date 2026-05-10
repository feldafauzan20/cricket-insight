<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// dummy route for single news page development
Route::get('/single-news', function () {
    return view('single-news');
});

Route::get('/archive', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/interview', function () {
    return view('interview');
});
