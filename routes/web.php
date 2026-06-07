<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman daftar semua berita
Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// Halaman detail berita (dinamis berdasarkan slug)
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/archive', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/interview', function () { return view('interview'); });