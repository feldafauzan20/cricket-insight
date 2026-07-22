<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterviewsController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TournamentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/archive', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/interview', function () {
    return view('interview');
});

Route::get('/match-centre', function () {
    return view('match-centre');
});

Route::get('/tournaments', [TournamentsController::class, 'index'])->name('tournaments.index');
Route::get('/api/tournaments', [TournamentsController::class, 'apiIndex'])->name('tournaments.api.index');
Route::get('/api/tournaments/{slug}', [TournamentsController::class, 'apiShow'])->name('tournaments.api.show');
Route::get('/api/matches', [MatchesController::class, 'apiIndex'])->name('matches.api.index');
Route::get('/api/matches/{slug}', [MatchesController::class, 'apiShow'])->name('matches.api.show');
Route::get('/api/interviews', [InterviewsController::class, 'apiIndex'])->name('interviews.api.index');
Route::get('/api/interviews/{slug}', [InterviewsController::class, 'apiShow'])->name('interviews.api.show');

Route::get('/ping', function () {
    return response('pong', 200);
});
