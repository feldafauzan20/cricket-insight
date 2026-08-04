<?php

use App\Http\Controllers\BbiWbbiController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterviewsController;
use App\Http\Controllers\MagazineGallery\MagazineController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OngoingTournamentController;
use App\Http\Controllers\PointsTableController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TournamentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home', ['locale' => app()->getLocale()]);
});

Route::get('/api/series', [SeriesController::class, 'index'])->name('api.series');

Route::get('/api/series-details', [SeriesController::class, 'details'])->name('api.series-details');

Route::get('/api/teams', [TeamsController::class, 'index'])->name('api.teams');

Route::get('/api/matches', [MatchesController::class, 'getMatchesApi'])->name('api.matches');

Route::get('/api/points-table', [PointsTableController::class, 'getPointsTableApi'])->name('api.points-table');

Route::get('/api/player-stats', [PointsTableController::class, 'getPlayerStatsApi'])->name('api.player-stats');

Route::prefix('{locale}')
    ->whereIn('locale', config('app.available_locales'))
    ->middleware('setlocale')
    ->group(function () {
        Route::get('/dd', [DebugController::class, 'index'])->name('debug.dd');
        Route::get('/debug-data', [DebugController::class, 'index'])->name('debug.data');
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

        Route::get('/archive', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/load-more', [GalleryController::class, 'loadMore'])->name('gallery.load-more');
        Route::get('/magazines/load-more', [MagazineController::class, 'loadMore'])->name('magazines.load-more');

        Route::get('/bbi-wbbi', [BbiWbbiController::class, 'index'])->name('bbi-wbbi');

        Route::get('/ongoing-tournaments', [OngoingTournamentController::class, 'index'])->name('ongoing-tournaments.index');
        Route::get('/ongoing-tournaments/{id}', [OngoingTournamentController::class, 'show'])->name('ongoing-tournaments.show');

        Route::get('/test-locale', function () {
            dd(app()->getLocale(), __('navbar.home'));
        });

        Route::get('/interview', [InterviewsController::class, 'index'])->name('interviews.index');
        Route::get('/interview/{slug}', [InterviewsController::class, 'show'])->name('interviews.show');

        Route::get('/match-centre', [MatchesController::class, 'index'])->name('matches.index');
        Route::get('/match-centre/{slug}', [MatchesController::class, 'show'])->name('matches.show');

        Route::get('/tournaments', [TournamentsController::class, 'index'])->name('tournaments.index');
        Route::get('/tournaments/{slug}', [TournamentsController::class, 'show'])->name('tournaments.show');

        Route::get('/bbi-wbbi', [BbiWbbiController::class, 'index'])->name('bbi-wbbi');
    });
