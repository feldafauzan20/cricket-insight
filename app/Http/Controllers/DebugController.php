<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MagazineGallery\MagazineController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    /**
     * Dump all controller data for debugging and inspection.
     * Visit /dd or /debug-data in browser.
     * Optionally pass ?controller=GalleryController (or NewsController, etc.) to inspect a specific controller.
     */
    public function index(Request $request)
    {
        $target = $request->query('controller');

        // 1. GalleryController Data
        $galleryData = GalleryController::initialData();

        // 2. MagazineController Data
        $magazineData = MagazineController::initialData();

        // 3. HomeController Data
        $liveScoreController = new LiveScoreController();
        $homeMatchesData = $liveScoreController->getMatches(10);
        
        $featuredVideos = Video::with(['uploader', 'category'])
            ->where('is_active', true)
            ->latest()
            ->limit(8)
            ->get();

        $homeData = [
            'matches' => $homeMatchesData['data'] ?? [],
            'hasError' => !$homeMatchesData['success'],
            'error' => $homeMatchesData['error'] ?? null,
            'featuredVideos' => $featuredVideos->toArray(),
        ];

        // 4. NewsController Data
        $newsArticles = Article::with(['category', 'tags'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $newsCategories = Category::whereHas('articles')->orderBy('name')->get(['name', 'slug']);
        $newsTags = Tag::whereHas('articles')->orderBy('name')->get(['name', 'slug']);

        $newsData = [
            'news' => $newsArticles,
            'categories' => $newsCategories,
            'tags' => $newsTags,
        ];

        // 5. TournamentsController Data
        $tournamentsData = Article::with(['category', 'tags'])
            ->where('category_id', 2)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        // 6. InterviewsController Data
        $interviewsData = Article::with(['category', 'tags'])
            ->where('category_id', 6)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        // 7. MatchesController Data
        $matchesData = Article::with(['category', 'tags'])
            ->where('category_id', 5)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        // 8. LiveScoreController Data
        $liveScoreData = $homeMatchesData;

        $allControllersData = [
            'GalleryController' => [
                'galleries' => $galleryData['galleries'],
                'galleriesHasMore' => $galleryData['hasMore'],
            ],
            'MagazineController' => [
                'magazines' => $magazineData['magazines'],
                'magazinesHasMore' => $magazineData['hasMore'],
            ],
            'HomeController' => $homeData,
            'NewsController' => [
                'news' => $newsArticles->toArray(),
                'categories' => $newsCategories->toArray(),
                'tags' => $newsTags->toArray(),
            ],
            'TournamentsController' => [
                'tournaments' => $tournamentsData->toArray(),
            ],
            'InterviewsController' => [
                'interviews' => $interviewsData->toArray(),
            ],
            'MatchesController' => [
                'matches' => $matchesData->toArray(),
            ],
            'LiveScoreController' => $liveScoreData,
        ];

        if ($target && isset($allControllersData[$target])) {
            dd([
                'controller' => $target,
                'data' => $allControllersData[$target],
            ]);
        }

        dd([
            'info' => 'All Controller Data Sent to Views / APIs',
            'available_controllers' => array_keys($allControllersData),
            'usage' => 'Filter specific controller with ?controller=GalleryController (or NewsController, etc.)',
            'controllers_data' => $allControllersData,
        ]);
    }
}
