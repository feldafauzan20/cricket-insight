<?php

use App\Http\Controllers\DebugController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterviewsController;
use App\Http\Controllers\MagazineGallery\MagazineController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TournamentsController;
use Illuminate\Support\Facades\Route;

Route::get('/dd', [DebugController::class, 'index'])->name('debug.dd');
Route::get('/debug-data', [DebugController::class, 'index'])->name('debug.data');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/archive', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/load-more', [GalleryController::class, 'loadMore'])->name('gallery.load-more');
Route::get('/magazines/load-more', [MagazineController::class, 'loadMore'])->name('magazines.load-more');

Route::get('/interview', [InterviewsController::class, 'index'])->name('interviews.index');
Route::get('/interview/{slug}', [InterviewsController::class, 'show'])->name('interviews.show');

Route::get('/match-centre', [MatchesController::class, 'index'])->name('matches.index');
Route::get('/match-centre/{slug}', [MatchesController::class, 'show'])->name('matches.show');

Route::get('/tournaments', [TournamentsController::class, 'index'])->name('tournaments.index');
Route::get('/tournaments/{slug}', [TournamentsController::class, 'show'])->name('tournaments.show');

Route::get('/bbi-wbbi', function () {
    return view('bbi-wbbi');
});
