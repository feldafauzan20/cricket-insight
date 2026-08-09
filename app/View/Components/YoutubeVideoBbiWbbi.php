<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YoutubeVideoBbiWbbi extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.youtube-video-bbi-wbbi');
    }

    /**
     * Normalize any YouTube URL (watch, youtu.be, mobile, shorts) into an
     * embeddable /embed/ URL. Regular YouTube pages send
     * X-Frame-Options: sameorigin, which blocks them from being iframed —
     * only /embed/ URLs allow it. Non-YouTube URLs (e.g. direct MP4 links)
     * are returned unchanged.
     */
    public static function toEmbedUrl(?string $url): ?string
    {
        if (empty($url)) {
            return $url;
        }

        $host = parse_url($url, PHP_URL_HOST);

        if (empty($host) || !str_contains($host, 'youtu')) {
            return $url;
        }

        if (str_contains($host, 'youtube.com') && str_contains((string) parse_url($url, PHP_URL_PATH), '/embed/')) {
            return $url;
        }

        $videoId = null;

        if (str_contains($host, 'youtu.be')) {
            $videoId = trim((string) parse_url($url, PHP_URL_PATH), '/');
        } elseif (preg_match('#/shorts/([^/?]+)#', $url, $matches)) {
            $videoId = $matches[1];
        } else {
            parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;
        }

        if (empty($videoId)) {
            return $url;
        }

        return 'https://www.youtube.com/embed/' . $videoId;
    }
}
