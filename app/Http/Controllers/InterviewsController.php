<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PageSlot;
use App\Models\Video;
use Illuminate\Http\Request;

class InterviewsController extends Controller
{
    public function index(Request $request)
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        $categoryFilter = function ($query) {
            $query->where('category_id', 6)
                ->orWhereHas('category', function ($q) {
                    $q->where('slug', 'Interviews')
                        ->orWhere('slug', 'interviews')
                        ->orWhere('id', 6);
                });
        };

        $bestInterviews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where($categoryFilter)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        $regionOptions = [
            'Indonesia' => 'Indonesia',
            'Global' => 'Global',
        ];

        $region = $request->query('region', 'Indonesia');

        $interviews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where($categoryFilter)
            ->where('status', 'published')
            ->where('region', $region)
            ->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString();

        // 1. Fetch Main Highlight Video slot for Interview page
        $mainHighlightSlot = PageSlot::with(['video.uploader', 'video.category'])
            ->where('page_key', 'interview')
            ->where('section_key', 'main_highlight')
            ->first();

        $highlightVideo = null;
        if ($mainHighlightSlot?->video) {
            $highlightVideo = $mainHighlightSlot->video;
            if (!empty($mainHighlightSlot->embed_link)) {
                $highlightVideo->video_url = $mainHighlightSlot->embed_link;
            }
        } elseif (!empty($mainHighlightSlot?->embed_link)) {
            $highlightVideo = (object) [
                'id' => $mainHighlightSlot->id,
                'title' => $mainHighlightSlot->label ?? 'Interview Highlight Video',
                'thumbnail' => null,
                'video_url' => $mainHighlightSlot->embed_link,
                'uploader' => (object) ['name' => 'ADMIN'],
                'category' => (object) ['name' => 'Video'],
                'published_at' => $mainHighlightSlot->updated_at ?? now(),
                'created_at' => $mainHighlightSlot->created_at ?? now(),
            ];
        }

        // 2. Fetch Featured Video Slots (1-10) for Interview page
        $videoSlots = PageSlot::with(['video.uploader', 'video.category'])
            ->where('page_key', 'interview')
            ->where('section_key', 'like', 'featured_video_interview_%')
            ->where(function ($query) {
                $query->whereNotNull('video_id')
                    ->orWhereNotNull('embed_link');
            })
            ->orderBy('id')
            ->get();

        $interviewVideos = collect();

        foreach ($videoSlots as $slot) {
            if ($slot->video) {
                $v = $slot->video;
                if (!empty($slot->embed_link)) {
                    $v->video_url = $slot->embed_link;
                }
                $interviewVideos->push($v);
            } elseif (!empty($slot->embed_link)) {
                $interviewVideos->push((object) [
                    'id' => $slot->id,
                    'title' => $slot->label ?? 'Featured Video',
                    'thumbnail' => null,
                    'video_url' => $slot->embed_link,
                    'uploader' => (object) ['name' => 'ADMIN'],
                    'category' => (object) ['name' => 'Video'],
                    'published_at' => $slot->updated_at ?? now(),
                    'created_at' => $slot->created_at ?? now(),
                ]);
            }
        }

        // Fallback: If no slot videos configured, load active videos from database
        if ($interviewVideos->isEmpty()) {
            $interviewVideos = Video::query()
                ->with(['category', 'uploader'])
                ->where('is_active', true)
                ->latest()
                ->get();
        }

        // Fallback for highlightVideo if not explicitly configured
        if (!$highlightVideo && $interviewVideos->isNotEmpty()) {
            $highlightVideo = $interviewVideos->first();
        }

        $data = [
            'interviews' => $interviews,
            'bestInterviews' => $bestInterviews,
            'highlightVideo' => $highlightVideo,
            'interviewVideos' => $interviewVideos,
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null,
            'regionOptions' => $regionOptions,
            'filters' => ['region' => $region],
        ];

        return view('interview', $data);
    }

    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where(function ($query) {
                $query->where('category_id', 6)
                    ->orWhereHas('category', function ($q) {
                        $q->where('slug', 'Interviews')
                            ->orWhere('slug', 'interviews')
                            ->orWhere('id', 6);
                    });
            })
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('interview', compact('article'));
    }
}

